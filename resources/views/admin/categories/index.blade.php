@extends('layouts.app')

@section('title', 'Admin: Category')

@section('content')
    <form action="{{ route('admin.category.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <input type="text" name="category_name" id="category_name" class="form-control d-inline w-25 me-2" value="{{ old('category_name') }}" placeholder="Add a category ..." autofocus>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add
            </button>

            @error('category_name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>
    
    <table class="table table-hover align-middle bg-white border text-secondary text-center w-75">
        <thead class="table-warning small text-secondary">
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>COUNT</th>
                <th>LAST UPDATED</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->categoryPost->count() }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        @include('admin.categories.modal.action')

                        <button class="btn btn-outline-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        @include('admin.categories.modal.action')
                    </td>
                </tr>
            @empty
                <tr>
                    <td  colspan="5" class="lead text-muted text-center">No categories found.</td>
                </tr>
            @endforelse
            <tr>
                <td></td>
                <td class="text-dark">
                    Uncategorized <br>
                    <p class="xsmall mb-0 text-muted">Hiden posts are not included</p>
                </td>
                <td>{{ $uncategorized_count }}</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_categories->links() }}
    </div>
@endsection
