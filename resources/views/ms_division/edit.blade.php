@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Divisi</h2>
    <form action="{{ route('ms-division.update', $division->div_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="div_id" class="form-label">ID Divisi</label>
            <input type="text" name="div_id" id="div_id" class="form-control" value="{{ $division->div_id }}" readonly>
        </div>
        <div class="mb-3">
            <label for="div_desc" class="form-label">Nama Divisi</label>
            <input type="text" name="div_desc" id="div_desc" class="form-control" maxlength="50" value="{{ old('div_desc', $division->div_desc) }}">
            @error('div_desc') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('ms-division.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
