
@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-xs bg-white rounded-2xl shadow-xl p-6 mx-2 flex flex-col items-center">
        <img src="/logo.png" alt="Logo" class="h-12 mb-3 mt-2">
        <h1 class="text-xl font-bold text-gray-800 mb-2">Register HRD Admin</h1>
        <form method="POST" action="{{ route('register') }}" class="w-full space-y-3">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-sm">Username</label>
                <input type="text" name="username" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                @error('username')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-medium text-sm">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                @error('email')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-medium text-sm">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                @error('password')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-medium text-sm">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg text-base transition">Register</button>
        </form>
        <div class="flex flex-col gap-2 w-full mt-5 text-sm">
            <a href="{{ route('login') }}" class="w-full text-center text-blue-600 hover:underline">Sudah punya akun? Login</a>
        </div>
    </div>
</div>
@endsection
