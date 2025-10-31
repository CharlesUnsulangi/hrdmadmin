@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Lupa Password</h2>
    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            @error('email')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Kirim Link Reset</button>
        <a href="{{ route('login') }}" class="ml-4 text-blue-600">Login</a>
    </form>
    <div class="text-xs text-gray-500 mt-4">Fitur reset password belum diimplementasikan penuh.</div>
</div>
@endsection
