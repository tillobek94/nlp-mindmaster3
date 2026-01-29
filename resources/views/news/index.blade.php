<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Янгиликлар - Келажак инсонлари академияси</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --dark: #0f172a;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.7;
        }
        
        /* Header Styles */
        .news-header {
            background: var(--gradient);
            color: white;
            padding: 100px 0 60px;
            margin-bottom: 60px;
            text-align: center;
        }
        
        .news-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .news-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Navigation */
        .news-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        
        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 5px 0;
            position: relative;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .nav-links a.active {
            color: var(--primary);
            font-weight: 600;
        }
        
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradient);
        }
        
        /* News Grid */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        
        .news-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }
        
        .news-image {
            height: 220px;
            width: 70%;
            object-fit: cover;
            background: var(--gradient);
        }
        
        .news-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .news-date {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
            width: fit-content;
        }
        
        .news-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .news-excerpt {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .read-more:hover {
            gap: 12px;
            color: var(--primary-dark);
        }
        
        /* No news message */
        .no-news {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        
        .no-news i {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        
        .pagination {
            display: flex;
            gap: 5px;
        }
        
        .page-item .page-link {
            border: none;
            background: white;
            color: var(--dark);
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .page-item.active .page-link {
            background: var(--gradient);
            color: white;
        }
        
        .page-item:not(.disabled) .page-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }
        
        /* Footer */
        .news-footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .news-header h1 {
                font-size: 2.5rem;
            }
            
            .news-header p {
                font-size: 1rem;
            }
            
            .news-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-links {
                gap: 15px;
            }
        }
        
        /* Back to home button */
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
        }
        
        .back-home:hover {
            color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="news-nav">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-logo">
                <i class="fas fa-brain"></i>
                Келажак инсонлари академияси
            </a>
            
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Асосий</a></li>
                <li><a href="{{ route('news.index') }}" class="active">Янгиликлар</a></li>
                <li><a href="{{ route('contact') }}">Боғланиш</a></li>
                @auth
                <li><a href="{{ route('admin.dashboard') }}">Админ</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    
    <!-- Header -->
    <div class="news-header">
        <div class="container">
            <h1>Янгиликлар</h1>
            <p>Бизнинг сўнгги янгиликлар, эълонлар ва янгиликлар. Дарслар, воркшоплар ва махсус таклифлар ҳақида маълумотлар.</p>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container">
        <a href="{{ url('/') }}" class="back-home">
            <i class="fas fa-arrow-left"></i> Асосий саҳифага қайтиш
        </a>
        
        @if($news->count() > 0)
        <div class="news-grid">
            @foreach($news as $item)
            <div class="news-card">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                @else
                <div class="news-image d-flex align-items-center justify-content-center">
                    <i class="fas fa-newspaper fa-3x text-white"></i>
                </div>
                @endif
                
                <div class="news-content">
                    <div class="news-date">
                        <i class="far fa-calendar"></i>
                        {{ $item->published_date->format('d.m.Y') }}
                    </div>
                    
                    <h3 class="news-title">{{ $item->title }}</h3>
                    
                    <p class="news-excerpt">
                        {{ $item->short_description ?: Str::limit(strip_tags($item->content), 150) }}
                    </p>
                    
                    <a href="{{ route('news.show', $item->slug) }}" class="read-more">
                        Батафсил ўқиш <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($news->hasPages())
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if($news->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $news->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach(range(1, $news->lastPage()) as $page)
                        @if($page == $news->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $news->url($page) }}">{{ $page }}</a>
                        </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($news->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $news->nextPageUrl() }}" rel="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
        
        @else
        <div class="no-news">
            <i class="fas fa-newspaper"></i>
            <h3>Ҳали янгиликлар мавжуд эмас</h3>
            <p>Яқин орада янгиликлар пайдо бўлади. Илтимос, кейинроқ қайта киринг.</p>
        </div>
        @endif
    </div>
    
    <!-- Footer -->
    <footer class="news-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Келажак инсонлари академияси</h3>
                    <p>Шахсий ривожланиш ва НЛП технологиялари бўйича халқаро платформа.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Ҳаволалар</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Асосий</a></li>
                        <li><a href="{{ route('news.index') }}">Янгиликлар</a></li>
                        <li><a href="{{ route('contact') }}">Боғланиш</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Боғланиш</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope me-2"></i> info@mindmaster.uz</li>
                        <li><i class="fas fa-phone me-2"></i> +998 78 555 3007</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Тошкент, Ўзбекистон</li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>© {{ date('Y') }} Келажак инсонлари академияси. Барча ҳуқуқлар ҳимояланган.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Highlight current year in copyright
        document.addEventListener('DOMContentLoaded', function() {
            const yearElement = document.querySelector('.copyright p');
            if (yearElement) {
                const currentYear = new Date().getFullYear();
                yearElement.innerHTML = yearElement.innerHTML.replace('{{ date("Y") }}', currentYear);
            }
        });
    </script>
</body>
</html>