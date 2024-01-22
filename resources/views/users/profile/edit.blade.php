@extends('layouts.app')

@section('title', 'Edit Profile')
    
@section('content')
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card-body bg-white w-75 mx-auto rounded shadow mt-5 p-5">
            <h1 class="h2 fw-light text-secondary mb-3">Update Profile</h1>
        
            <div class="row align-items-end mb-3">
                <div class="col-3">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-autp avatar-lg">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                    @endif
                </div>
                <div class="col-auto">
                    <input type="file" name="avatar" id="avatar" class="form-control" aria-describedby="img-info">
                    <div class="form-text text-secondary" id="img-info">
                        Acceptable formats: jpeg, jpg, png, gif only. <br>
                        Max file size is 1048kB.
                    </div>
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label d-block">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" autofocus>
                @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="introduction" class="form-label">Introduction</label>
                <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself">{{ old('introduction', $user->introduction) }}</textarea>
                @error('introduction')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning px-5">Save</button>
        </div>
    </form>
@endsection