<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Алоқа Хабарлари - Келажак инсонлари академияси</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --dark: #0f172a;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background-color: var(--dark);
            min-height: 100vh;
            color: white;
            padding: 0;
            position: fixed;
            width: 250px;
        }
        
        .sidebar-brand {
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .nav-link {
            color: #cbd5e1;
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            text-decoration: none;
            position: relative;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(99, 102, 241, 0.2);
            border-left: 3px solid var(--primary);
        }
        
        .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #eef2f7;
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .table th {
            font-weight: 600;
            color: #475569;
            border-top: none;
        }
        
        .status-new {
            background-color: #dc3545;
            color: white;
        }
        .status-read {
            background-color: #ffc107;
            color: #000;
        }
        .status-replied {
            background-color: #28a745;
            color: white;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 15px 0;
            margin-bottom: 20px;
        }
        
        .user-dropdown img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
        
        .badge-notification {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.7rem;
            padding: 2px 6px;
        }
        
        .message-content {
            white-space: pre-line;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-brain me-2"></i>
                Келажак инсонлари академияси
            </div>
            <div class="sidebar-menu">
                <ul class="nav flex-column">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Дашбоард
                        </a>
                    </li>
                    
                    <!-- Content Management -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.features.*') ? 'active' : '' }}" href="{{ route('admin.features.index') }}">
                            <i class="fas fa-star"></i> Хусусиятлар
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
                            <i class="fas fa-comment"></i> Шарҳлар
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}" href="{{ route('admin.statistics.index') }}">
                            <i class="fas fa-chart-bar"></i> Статистика
                        </a>
                    </li>
                    
                    <!-- Pages -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                            <i class="fas fa-file-alt"></i> Саҳифалар
                        </a>
                    </li>
                    
                    <!-- User Management -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i>Рўйхатдан Ўтганлар
                        </a>
                    </li>
                    
                    <!-- Contact Messages -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                            <i class="fas fa-envelope"></i> Алоқа Хабарлари
                        </a>
                    </li>
                    
                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog"></i> Созламалар
                        </a>
                    </li>
                    
                    <!-- Divider -->
                    <li class="nav-item mt-4"></li>
                    
                    <!-- External Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Сайтни Кўриш
                        </a>
                    </li>
                    
                    <!-- Logout -->
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Чиқиш
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-brand">
                        <h5 class="mb-0">Алоқа Хабарлари - Хабар №{{ $contact->id }}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown user-dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="ms-2">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Дашбоард</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> Созламалар</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Чиқиш
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Contact Details -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Хабар маълумотлари</h6>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Ортга
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Исми:</label>
                                        <p class="form-control-plaintext fw-bold">{{ $contact->name }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Email:</label>
                                        <p class="form-control-plaintext">{{ $contact->email }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Телефон:</label>
                                        <p class="form-control-plaintext">{{ $contact->phone ?? 'Кўрсатилмаган' }}</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Мавзу:</label>
                                        <p class="form-control-plaintext">{{ $contact->subject }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Холати:</label>
                                        <div>
                                            <span class="badge status-{{ $contact->status }}">
                                                @if($contact->status == 'new')
                                                    Янги
                                                @elseif($contact->status == 'read')
                                                    Ўқилган
                                                @else
                                                    Жавоб берилган
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Келган сана:</label>
                                        <p class="form-control-plaintext">{{ $contact->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Message -->
                            <div class="mb-4">
                                <label class="form-label text-muted small">Хабар матни:</label>
                                <div class="border rounded p-3 bg-light message-content">
                                    {{ $contact->message }}
                                </div>
                            </div>
                            
                            <!-- Admin Notes -->
                            @if($contact->admin_notes)
                            <div class="mb-4">
                                <label class="form-label text-muted small">Админ изоҳи:</label>
                                <div class="border rounded p-3 bg-light message-content">
                                    {{ $contact->admin_notes }}
                                </div>
                            </div>
                            @endif
                            
                            <!-- Actions -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Рўйхатга қайтиш
                                    </a>
                                </div>
                                
                                <div>
                                    @if($contact->status != 'replied')
                                    <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="replied">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Жавоб берилган деб белгилаш
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <!-- Delete button -->
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Хабарни ўчиришни хоҳлайсизми?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Ўчириш
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Highlight active menu item
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            
            navLinks.forEach(function(link) {
                const href = link.getAttribute('href');
                if (href && currentPath.startsWith(href.replace('{{ route('admin.dashboard') }}', ''))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>