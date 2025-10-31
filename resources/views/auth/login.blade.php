
@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-xs bg-white rounded-2xl shadow-xl p-6 mx-2 flex flex-col items-center">
        <img src="/logo.png" alt="Logo" class="h-12 mb-3 mt-2">
        <h1 class="text-xl font-bold text-gray-800 mb-2">Login HRD Admin</h1>
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4 w-full text-center text-sm">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-3">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-sm">Username atau Email</label>
                <input type="text" name="login" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 text-sm" required autofocus>
                @error('login')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-medium text-sm">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 text-sm" required>
                @error('password')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-base transition">Login</button>
        </form>
        <div class="flex flex-col gap-2 w-full mt-5 text-sm">
            <a href="{{ route('register') }}" class="w-full text-center text-blue-600 hover:underline">Belum punya akun? Register</a>
            <a href="{{ route('password.request') }}" class="w-full text-center text-gray-600 hover:underline">Lupa Password?</a>
        </div>
    </div>
</div>
@endsection
