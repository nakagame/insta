@extends('layouts.app')

@section('title', $user->name)

@section('content')
    @include('users.profile.header')

    {{-- show all posts here --}}
    <div class="row" style="margin-top: 100px">
        @if ($user->posts->isNotEmpty())
            @foreach ($user->posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
                    </a>
                </div>
            @endforeach
        @else
            <h3 class="text-muted text-center">No Posts Yet</h3>
        @endif
    </div>
@endsection