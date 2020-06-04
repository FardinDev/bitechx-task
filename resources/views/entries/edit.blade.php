@extends('layouts.main')
@section('title', 'Edit')
@section('content')

<form class="mx-auto pt-5" style="max-width:700px;" action="{{route('entry.update', $entry->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{old('email') ? old('email') : $entry->email}}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password (Leave Empty if you don't want to change)</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>File:</label>
        <a href="{{asset('storage/files/'.$entry->file)}}" target="_blank"
            rel="noopener noreferrer">{{asset('storage/files/'.$entry->file)}}</a>

    </div>

    <label>Upload new file (Previous file will be overwritten)</label>
    <div class="custom-file">
        <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror">
        <label class="custom-file-label">Choose file</label>
        @error('file')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <a href="{{ URL::previous() }}" class="btn btn-secondary mt-4">Cancel</a>
    <button type="submit" class="btn btn-primary mt-4">Update</button>
</form>
@endsection
