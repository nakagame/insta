@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label d-flex fw-bold">
                Category
                <span class="text-muted">(up to 3)</span>
            </label>

            @forelse ($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input name="category[]" class="form-check-input" type="checkbox" id="{{ $category->name }}" value="{{ $category->id }}">
                    <label class="form-check-label" for="{{ $category->name }}">{{ $category->name }}</label>
                </div>
            @empty
                    
            @endforelse
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="What's on your mind">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror 
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div id="image-info" class="form-text">
                Acceptable formats: jpeg, jpg, png, gif only <br>
                Max file size is 1048KB
            </div>
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror    
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>
@endsection