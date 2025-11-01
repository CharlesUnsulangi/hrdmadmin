@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Perusahaan</h2>
    <form action="{{ route('ms-company.update', $company->company_code) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="company_code" class="form-label">Kode Perusahaan</label>
            <input type="text" name="company_code" id="company_code" class="form-control" value="{{ $company->company_code }}" readonly>
        </div>
        <div class="mb-3">
            <label for="company_desc" class="form-label">Nama Perusahaan</label>
            <input type="text" name="company_desc" id="company_desc" class="form-control" maxlength="100" value="{{ old('company_desc', $company->company_desc) }}">
            @error('company_desc') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('ms-company.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
