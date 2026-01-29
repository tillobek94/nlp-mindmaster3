@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Yangilikni tahrirlash</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Orqaga
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">"{{ $news->title }}" yangiligini tahrirlash</h5>
        </div>
        
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Sarlavha *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $news->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (URL)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $news->slug) }}">
                            <div class="form-text">Agar bo'sh qoldirsangiz, sarlavhadan avtomatik yaratiladi</div>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Qisqacha tavsif</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" name="short_description" rows="3">{{ old('short_description', $news->short_description) }}</textarea>
                            <div class="form-text">Maksimum 500 belgi</div>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Kontent *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="15" required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Rasm</h6>
                            </div>
                            <div class="card-body text-center">
                                @if($news->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $news->image) }}" 
                                             alt="{{ $news->title }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 200px;">
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $news->image) }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-external-link-alt"></i> Ko'rish
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-3 text-muted">
                                        <i class="fas fa-image fa-3x"></i>
                                        <p class="mt-2">Rasm yuklanmagan</p>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="image" class="form-label">Yangi rasm yuklash</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    <div class="form-text">Formati: jpg, png, gif, webp. Maksimum: 2MB</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                @if($news->image)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        <i class="fas fa-trash"></i> Rasmni o'chirish
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Sozlamalar</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="published_date" class="form-label">Chiqarish sanasi *</label>
                                    <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                           id="published_date" name="published_date" 
                                           value="{{ old('published_date', $news->published_date->format('Y-m-d')) }}" required>
                                    @error('published_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Holati</label>
                                    <select class="form-select @error('is_published') is-invalid @enderror" 
                                            id="status" name="is_published">
                                        <option value="1" {{ old('is_published', $news->is_published) ? 'selected' : '' }}>
                                            Aktiv (Chop etilgan)
                                        </option>
                                        <option value="0" {{ !old('is_published', $news->is_published) ? 'selected' : '' }}>
                                            Noaktiv (Qoralama)
                                        </option>
                                    </select>
                                    @error('is_published')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Yaratilgan sana</label>
                                    <p class="form-control-plaintext">{{ $news->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Yangilangan sana</label>
                                    <p class="form-control-plaintext">{{ $news->updated_at->format('d.m.Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('admin.news.show', $news->id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Ko'rish
                        </a>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Qayta yuklash
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Saqlash
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .img-preview {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-top: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // CKEditor ni ishga tushirish
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
            language: 'ru'
        })
        .catch(error => {
            console.error(error);
        });
    
    // Sarlavhadan slug avtomatik yaratish
    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.value === '{{ $news->slug }}') {
            const title = this.value
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-')
                .trim();
            slugInput.value = title;
        }
    });
    
    // Rasm preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('image-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'image-preview';
                    preview.className = 'img-preview';
                    document.querySelector('[for="image"]').after(preview);
                }
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Rasm o'chirish checkbox bo'lsa, file input ni disabled qilish
    document.getElementById('remove_image')?.addEventListener('change', function() {
        const fileInput = document.getElementById('image');
        if (this.checked) {
            fileInput.disabled = true;
            fileInput.value = '';
            const preview = document.getElementById('image-preview');
            if (preview) preview.remove();
        } else {
            fileInput.disabled = false;
        }
    });
</script>
@endpush