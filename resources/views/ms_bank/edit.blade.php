@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Bank</h2>
    <form action="{{ route('ms-bank.update', $bank->Bank_Code) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Bank_Code" class="form-label">Kode Bank</label>
            <input type="text" name="Bank_Code" id="Bank_Code" class="form-control" value="{{ $bank->Bank_Code }}" readonly>
        </div>
        <div class="mb-3">
            <label for="rec_usercreated" class="form-label">User Created</label>
            <input type="text" name="rec_usercreated" id="rec_usercreated" class="form-control" required maxlength="50" value="{{ old('rec_usercreated', $bank->rec_usercreated) }}">
            @error('rec_usercreated') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="rec_userupdate" class="form-label">User Update</label>
            <input type="text" name="rec_userupdate" id="rec_userupdate" class="form-control" required maxlength="50" value="{{ old('rec_userupdate', $bank->rec_userupdate) }}">
            @error('rec_userupdate') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="rec_datecreated" class="form-label">Tanggal Created</label>
            <input type="datetime-local" name="rec_datecreated" id="rec_datecreated" class="form-control" required value="{{ old('rec_datecreated', $bank->rec_datecreated) }}">
            @error('rec_datecreated') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="rec_dateupdate" class="form-label">Tanggal Update</label>
            <input type="datetime-local" name="rec_dateupdate" id="rec_dateupdate" class="form-control" required value="{{ old('rec_dateupdate', $bank->rec_dateupdate) }}">
            @error('rec_dateupdate') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="rec_status" class="form-label">Status</label>
            <input type="text" name="rec_status" id="rec_status" class="form-control" required maxlength="1" value="{{ old('rec_status', $bank->rec_status) }}">
            @error('rec_status') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('ms-bank.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
