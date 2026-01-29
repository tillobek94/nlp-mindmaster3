@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Yangi yangilik</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <h5>Xatolar:</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Sarlavha *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required placeholder="Yangilik sarlavhasini kiriting">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Qisqacha tavsif</label>
                            <textarea class="form-control" id="short_description" name="short_description" 
                                      rows="3" placeholder="Qisqacha tavsif...">{{ old('short_description') }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Kontent *</label>
                            <textarea class="form-control" id="content" name="content" 
                                      rows="15" required placeholder="Yangilik kontentini kiriting...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="image" class="form-label">Rasm (ixtiyoriy)</label>
                            <input type="file" class="form-control" id="image" name="image" 
                                   accept="image/*">
                            <small class="form-text text-muted">Format: jpg, png, gif. Maksimum: 2MB</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="published_date" class="form-label">Chiqarish sanasi *</label>
                            <input type="date" class="form-control" id="published_date" 
                                   name="published_date" value="{{ old('published_date', date('Y-m-d')) }}" required>
                            @error('published_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" 
                                   name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Chop etish</label>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-save"></i> Saqlash
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Orqaga
                            </a>
                            
                            <!-- Тест тугмаси -->
                            <button type="button" class="btn btn-warning" onclick="fillTestData()">
                                <i class="fas fa-vial"></i> Test ma'lumotlari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== NEWS FORM LOADED ===');
    
    // Автомат тўлдиришни ОЧИРИШ!
    // Фақат қўлда тўлдириш ёки тест тугмаси орқали
    
    const form = document.getElementById('newsForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Form submit handler
    form.addEventListener('submit', function(e) {
        console.log('=== FORM SUBMIT STARTED ===');
        
        // Майдонларни текшириш
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        
        console.log('Title:', title);
        console.log('Content length:', content.length);
        
        // Валидация
        if (title.length < 3) {
            alert('Sarlavha kamida 3 ta harf bo\'lishi kerak!');
            e.preventDefault();
            return false;
        }
        
        if (content.length < 10) {
            alert('Kontent juda qisqa! Kamida 10 ta harf kiriting.');
            e.preventDefault();
            return false;
        }
        
        // Сабмит тугмасини блоклаш
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saqlanmoqda...';
        
        return true;
    });
});

// Тест учун маълумотларни тўлдириш функцияси
function fillTestData() {
    const now = new Date();
    const titleInput = document.getElementById('title');
    const contentTextarea = document.getElementById('content');
    const descTextarea = document.getElementById('short_description');
    
    // Маълумотларни тўлдириш
    titleInput.value = 'Yangi yangilik - ' + now.toLocaleDateString('uz-UZ');
    descTextarea.value = 'Bu yangilikning qisqacha tavsifi';
    contentTextarea.value = 'Ushbu yangilikda quyidagi mavzular yoritiladi:\n\n' +
                           '• Birinchi mavzu\n' +
                           '• Ikkinchi mavzu\n' +
                           '• Uchinchi mavzu\n\n' +
                           'Yangilikning asosiy qismi bu yerda davom etadi.\n' +
                           'Qo\'shimcha ma\'lumotlar va tafsilotlar.\n\n' +
                           'Yangilik ' + now.toLocaleDateString('uz-UZ') + ' sanasida chop etildi.';
    
    alert('Test ma\'lumotlari to\'ldirildi! Endi "Saqlash" tugmasini bosing.');
}
</script>
@endsection