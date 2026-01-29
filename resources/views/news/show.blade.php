<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - Келажак инсонлари академияси</title>
    
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
            --dark: #0f172a;
            --light: #f8fafc;
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
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        /* Article Container */
        .article-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .article-header {
            margin-bottom: 40px;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .back-link:hover {
            color: var(--primary-dark);
        }
        
        .article-date {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        
        .article-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }
        
        .article-content p {
            margin-bottom: 25px;
        }
        
        .article-content h2, .article-content h3 {
            color: var(--dark);
            margin: 40px 0 20px;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 30px 0;
        }
        
        .article-footer {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .share-buttons {
            display: flex;
            gap: 15px;
        }
        
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
            color: white;
        }
        
        .share-btn.facebook:hover { background: #1877f2; }
        .share-btn.telegram:hover { background: #0088cc; }
        .share-btn.twitter:hover { background: #1da1f2; }
        
        /* Related News */
        .related-news {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 40px;
            text-align: center;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .related-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }
        
        .related-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }
        
        .related-content {
            padding: 20px;
        }
        
        .related-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .related-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .related-link:hover {
            color: var(--primary-dark);
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
            max-width: 1200px;
            margin: 0 auto 40px;
            padding: 0 20px;
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
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            font-size: 0.9rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-links {
                gap: 15px;
            }
            
            .article-title {
                font-size: 2rem;
            }
            
            .article-image {
                height: 250px;
            }
            
            .article-footer {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
            }
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
                <li><a href="{{ route('news.index') }}">Янгиликлар</a></li>
                <li><a href="{{ route('contact') }}">Боғланиш</a></li>
                @auth
                <li><a href="{{ route('admin.dashboard') }}">Админ</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    
    <!-- Main Article -->
    <div class="article-container">
        <a href="{{ route('news.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Барча янгиликлар
        </a>
        
        <div class="article-header">
            <div class="article-date">
                <i class="far fa-calendar"></i>
                {{ $news->published_date->format('d.m.Y') }}
            </div>
            
            <h1 class="article-title">{{ $news->title }}</h1>
            
            <div class="article-meta">
                <span><i class="far fa-clock"></i> {{ $news->created_at->format('H:i') }}</span>
                <span><i class="far fa-eye"></i> Кўрилди: 0</span>
            </div>
        </div>
        
        @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="article-image">
        @endif
        
        <div class="article-content">
            {!! $news->content !!}
        </div>
        
        @if($news->short_description)
        <div class="alert alert-light mt-4">
            <strong>Қисқача тавсиф:</strong> {{ $news->short_description }}
        </div>
        @endif
        
        <div class="article-footer">
            <a href="{{ route('news.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Барча янгиликларга қайтиш
            </a>
            
            <div class="share-buttons">
                <a href="#" class="share-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="share-btn telegram">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="#" class="share-btn twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Related News -->
    @php
        $relatedNews = \App\Models\News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderBy('published_date', 'desc')
            ->take(3)
            ->get();
    @endphp
    
    @if($relatedNews->count() > 0)
    <div class="related-news">
        <h2 class="section-title">Шунингдек ўқишингиз мумкин</h2>
        
        <div class="related-grid">
            @foreach($relatedNews as $related)
            <div class="related-card">
                @if($related->image)
                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="related-image">
                @else
                <div class="related-image d-flex align-items-center justify-content-center bg-primary">
                    <i class="fas fa-newspaper fa-2x text-white"></i>
                </div>
                @endif
                
                <div class="related-content">
                    <h3 class="related-title">{{ Str::limit($related->title, 70) }}</h3>
                    <a href="{{ route('news.show', $related->slug) }}" class="related-link">
                        Батафсил ўқиш <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Footer -->
    <footer class="news-footer">
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
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Share buttons functionality
        document.addEventListener('DOMContentLoaded', function() {
            const shareButtons = document.querySelectorAll('.share-btn');
            const currentUrl = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            
            shareButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    let shareUrl = '';
                    if (this.classList.contains('facebook')) {
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;
                    } else if (this.classList.contains('telegram')) {
                        shareUrl = `https://t.me/share/url?url=${currentUrl}&text=${title}`;
                    } else if (this.classList.contains('twitter')) {
                        shareUrl = `https://twitter.com/intent/tweet?url=${currentUrl}&text=${title}`;
                    }
                    
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                });
            });
            
            // Update copyright year
            const yearElement = document.querySelector('.copyright p');
            if (yearElement) {
                const currentYear = new Date().getFullYear();
                yearElement.innerHTML = yearElement.innerHTML.replace('{{ date("Y") }}', currentYear);
            }
        });
    </script>
</body>
</html>