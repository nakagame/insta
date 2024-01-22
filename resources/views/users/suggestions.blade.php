@extends('layouts.app')

@section('title', 'Suggested User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5">
            <h3 class="text-muted text-center">Suggested</h3>
            @foreach ($suggested_all_users as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col">
                        <div class="col p-0 m-0 text-truncate">
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                            @if ($user->isFollowingMe())
                                <p class="text-muted mb-0 xsmall">Follows you</p>
                            @elseif ($user->followers->count() == 0)
                                <p class="text-muted mb-0 xsmall">No followers yet</p>
                            @else
                                <p class="text-muted mb-0 xsmall">{{ $user->followers->count() }} {{ $user->followers->count() == 1 ? 'follower' : 'followers'}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-auto align-self-center">
                        <form action="{{ route('follow.store', $user->id) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $suggested_all_users->links() }}
    </div>
@endsection
