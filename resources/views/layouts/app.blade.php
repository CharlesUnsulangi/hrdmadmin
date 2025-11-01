<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo_hr.png') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('logo_hr.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap 5 & Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            @if(Auth::check())
                <!-- Sidebar -->
                <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col min-h-screen">
                    <div class="h-16 flex items-center justify-center border-b">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="h-10 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <nav class="flex-1 px-4 py-6 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100 {{ request()->routeIs('dashboard') ? 'bg-blue-50 font-bold' : '' }}">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6" /></svg>
                            Dashboard
                        </a>
                        <a href="{{ url('/pelamar') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Manajemen Pelamar
                        </a>
                        <a href="{{ url('/kandidat') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-indigo-100 font-semibold">
                            <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" /></svg>
                            Kandidat
                        </a>
                        <a href="{{ url('/interview') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Interview
                        </a>
                        <a href="{{ url('/karyawan') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75" /></svg>
                            Karyawan
                        </a>
                        <a href="{{ url('/driver') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6" /></svg>
                            Driver
                        </a>
                        <a href="{{ url('/kenek') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-8-4h8" /></svg>
                            Kenek
                        </a>
                        <a href="{{ url('/pkwtt') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" /></svg>
                            PKWTT
                        </a>
                        <a href="{{ url('/assesment') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Assessment
                        </a>
                        <a href="{{ url('/payroll') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 10c-4.41 0-8-1.79-8-4V6c0-2.21 3.59-4 8-4s8 1.79 8 4v8c0 2.21-3.59 4-8 4z" /></svg>
                            Payroll
                        </a>
                        <a href="{{ url('/berita-acara') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-8-4h8M4 6h16M4 6v12a2 2 0 002 2h12a2 2 0 002-2V6" /></svg>
                            Berita Acara
                        </a>
                        <a href="{{ url('/master') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                            <svg class="h-5 w-5 mr-2 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                            Master
                        </a>
                        
                        @if(Auth::check() && Auth::user() instanceof App\Models\MsHrUser && Auth::user()->role === 'Admin')
                            <a href="{{ url('/setting-user') }}" class="flex items-center px-3 py-2 rounded text-black hover:bg-blue-100">
                                <svg class="h-5 w-5 mr-2 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                Setting User
                            </a>
                        @endif
                    </nav>
                    <div class="mt-auto px-4 pb-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-3 py-2 rounded text-black hover:bg-red-100">
                                <svg class="h-5 w-5 mr-2 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" /></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </aside>
            @endif
            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <!-- Page Content -->
                <main class="flex-1 p-4 md:p-8">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        @stack('scripts')
    </body>
</html>
