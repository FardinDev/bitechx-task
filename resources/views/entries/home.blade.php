@extends('layouts.main')
@section('title', 'Home')
@section('content')
<form class="mx-auto pt-5" style="max-width:700px;" action="{{route('entry.store')}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label>Upload file</label>
    <div class="custom-file">
        <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror">
        <label class="custom-file-label">Choose file</label>
        @error('file')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
@if ($entries->count() > 0)
<table class="table table-striped table-bordered mx-auto mt-5" style="width:100%;max-width:700px;">
    <thead>
        <tr>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    <tbody>
        @foreach ($entries as $entry)
        <tr>
            <td>{{$entry->email}}</td>
            <td><a href="{{route('entry.edit', $entry->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{route('entry.delete', $entry->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
    </thead>
</table>
@else
<h3 class="text-center mt-5">No Entries Found</h3>
@endif
@endsection
