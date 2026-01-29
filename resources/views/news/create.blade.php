@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Янги янгилик</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Орқага
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Сарлавҳа *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required 
                                   placeholder="Янгилик сарлавҳасини киритинг">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Қисқача тавсиф</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" name="short_description" rows="3"
                                      placeholder="Қисқача тавсиф (ихтиёрий)">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Мазмун *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="10" required
                                      placeholder="Янгилик мазмунини киритинг">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Расм</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Расм юклаш</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    <div class="form-text">Қуйидаги форматлар: jpg, png, gif, webp. Максимум ҳажми: 2MB</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div id="imagePreviewContainer" class="image-preview-container" style="display: none;">
                                    <img id="previewImage" src="" alt="Расм preview" class="preview-image">
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()">
                                            <i class="fas fa-trash"></i> Расмни ўчириш
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Созламалар</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="published_date" class="form-label">Чоп этиш санаси *</label>
                                    <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                           id="published_date" name="published_date" 
                                           value="{{ old('published_date', date('Y-m-d')) }}" required>
                                    @error('published_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               id="is_published" name="is_published" value="1"
                                               {{ old('is_published', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Чоп этиш (актив)
                                        </label>
                                    </div>
                                    @error('is_published')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i> Сақлаш
                            </button>
                            <button type="reset" class="btn btn-secondary" onclick="resetForm()">
                                <i class="fas fa-undo"></i> Тозаш
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .image-preview-container {
        border: 2px dashed #ddd;
        border-radius: 5x;
        padding: 10px;
        text-align: center;
        background: #f8f9fa;
        margin-top: 5px;
        min-height: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .preview-image {
        max-width: 10%;
        max-height: 50px;
        width: auto;
        height: auto;
        border-radius: 5px;
        object-fit: contain;
    }
    
    .btn-submit-loading .spinner-border {
        margin-right: 5px;
    }
    
    /* CKEditor custom style */
    .ck-editor__editable {
        min-height: 100px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // CKEditor ni ишга tushirish
    let editor;
    
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'alignment', 'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'ru',
            placeholder: 'Янгилик мазмунини киритинг...'
        })
        .then(newEditor => {
            editor = newEditor;
            
            // Agar oldingi маълумот бўлса, қайта тиклаш
            const oldContent = @json(old('content', ''));
            if (oldContent) {
                editor.setData(oldContent);
            }
        })
        .catch(error => {
            console.error('CKEditor xatosi:', error);
            // CKEditor ишламаса, oddiy textarea қўллаш
            document.getElementById('content').style.height = '300px';
        });
    
    // Расм preview функцияси
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Файл ҳажмини текшириш
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (file.size > maxSize) {
                alert('Расм ҳажми 2MB дан ошмаслиги керак!');
                this.value = '';
                return;
            }
            
            // Файл форматини текшириш
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Фақат расм файллари (jpg, png, gif, webp) юкланиши мумкин!');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('imagePreviewContainer');
                const previewImage = document.getElementById('previewImage');
                
                previewImage.src = e.target.result;
                previewContainer.style.display = 'flex';
                
                // Расм yuklangandan keyin o'lchamini sozlash
                previewImage.onload = function() {
                    if (this.naturalHeight > 400) {
                        this.style.maxHeight = '400px';
                    }
                };
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Расмни ўчириш
    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreviewContainer').style.display = 'none';
        document.getElementById('previewImage').src = '';
    }
    
    // Формани тозаш
    function resetForm() {
        if (editor) {
            editor.setData('');
        }
        removeImage();
    }
    
    // Form submit вақтида
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        // CKEditor мазмунини textarea-га сақлаш
        if (editor) {
            const editorData = editor.getData();
            if (editorData.trim() === '') {
                e.preventDefault();
                alert('Илтимос, янгилик мазмунини киритинг!');
                document.getElementById('content').focus();
                return false;
            }
            document.getElementById('content').value = editorData;
        }
        
        // Form маълумотларини текшириш
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const publishedDate = document.getElementById('published_date').value;
        
        if (!title) {
            e.preventDefault();
            alert('Илтимос, янгилик сарлавҳасини киритинг!');
            document.getElementById('title').focus();
            return false;
        }
        
        if (!content) {
            e.preventDefault();
            alert('Илтимос, янгилик мазмунини киритинг!');
            return false;
        }
        
        if (!publishedDate) {
            e.preventDefault();
            alert('Илтимос, чоп этиш санасини киритинг!');
            document.getElementById('published_date').focus();
            return false;
        }
        
        // Тугмани блоклаш ва loading қилиш
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-submit-loading');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Сақланилмоқда...';
        
        return true;
    });
    
    // Санани текшириш
    document.getElementById('published_date').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Вақтни 00:00:00 қилиш
        
        if (selectedDate > today) {
            if (!confirm('Сиз келгуси санани танладингиз. Давом этишни истайсизми?')) {
                this.value = today.toISOString().split('T')[0];
            }
        }
    });
    
    // DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {
        // Сана майдонини автозаполнение қилиш
        const dateField = document.getElementById('published_date');
        if (!dateField.value) {
            const today = new Date();
            dateField.value = today.toISOString().split('T')[0];
        }
        
        // Хатолар мавжуд бўлса
        @if ($errors->any())
            const errors = @json($errors->all());
            if (errors.length > 0) {
                let errorMessage = 'Қуйидаги хатолар аникланди:\n\n';
                errors.forEach((error, index) => {
                    errorMessage += `${index + 1}. ${error}\n`;
                });
                
                // Bootstrap modal ёки toast-да кўрсатиш яхширок
                // Ундирма учун alert қўллаймиз
                setTimeout(() => {
                    alert(errorMessage);
                }, 500);
            }
        @endif
    });
</script>
@endpush