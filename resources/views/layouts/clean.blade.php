<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - HRD Admin</title>

        <!-- Bootstrap 5 & Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            @if(Auth::check())
                <!-- Sidebar -->
                <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col min-h-screen">
                    <div class="h-16 flex items-center justify-center border-b">
                        <a href="{{ route('dashboard') }}">
                            <h4 class="text-primary mb-0">HRD Admin</h4>
                        </a>
                    </div>
                    <nav class="flex-1 px-4 py-6 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100 {{ request()->routeIs('dashboard') ? 'bg-blue-50 font-bold' : '' }}">
                            <i class="fas fa-tachometer-alt me-2 text-blue-500"></i>
                            Dashboard
                        </a>
                        <a href="{{ url('/pelamar') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <i class="fas fa-users me-2 text-green-500"></i>
                            Manajemen Pelamar
                        </a>
                        <a href="{{ url('/kandidat') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-indigo-100 font-semibold">
                            <i class="fas fa-user-check me-2 text-indigo-500"></i>
                            Kandidat
                        </a>
                        <a href="{{ route('berita-acara.index') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-yellow-100 {{ request()->routeIs('berita-acara.*') ? 'bg-yellow-50 font-bold' : '' }}">
                            <i class="fas fa-file-alt me-2 text-yellow-500"></i>
                            Berita Acara
                        </a>
                        <a href="{{ url('/user') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-purple-100">
                            <i class="fas fa-user-cog me-2 text-purple-500"></i>
                            User Management
                        </a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <div class="flex-1 flex flex-col">
                    <!-- Top Navigation -->
                    <header class="bg-white border-b h-16 flex items-center justify-between px-6">
                        <div class="md:hidden">
                            <button type="button" class="text-gray-600 hover:text-gray-900">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Welcome, {{ Auth::user()->username ?? Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main class="flex-1 p-6">
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </main>
                </div>
            @else
                <!-- Not authenticated - redirect to login -->
                <script>
                    window.location.href = "{{ route('login') }}";
                </script>
            @endif
        </div>

        <!-- Scripts -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        
        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        @yield('scripts')
    </body>
</html>