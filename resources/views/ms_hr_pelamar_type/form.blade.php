@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-3">@if(isset($item)) Edit @else Tambah @endif Tipe Pelamar</h2>
    <form method="POST" action="@if(isset($item)){{ route('ms_hr_pelamar_type.update', $item->ms_hr_pelamar_type_id) }}@else{{ route('ms_hr_pelamar_type.store') }}@endif">
        @csrf
        @if(isset($item)) @method('PUT') @endif
        <div class="mb-3">
            <label for="ms_hr_pelamar_type_id" class="form-label">ID Tipe</label>
            <input type="text" name="ms_hr_pelamar_type_id" id="ms_hr_pelamar_type_id" class="form-control" value="{{ old('ms_hr_pelamar_type_id', $item->ms_hr_pelamar_type_id ?? '') }}" @if(isset($item)) readonly @endif required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="type_desc" class="form-label">Deskripsi</label>
            <input type="text" name="type_desc" id="type_desc" class="form-control" value="{{ old('type_desc', $item->type_desc ?? '') }}" maxlength="50">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('ms_hr_pelamar_type.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
