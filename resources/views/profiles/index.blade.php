@extends('layouts.app')

@section('app-content')
    <header class="mb-6 relative">
        <img 
            src="{{ asset('images/default-profile-banner.jpg') }}" 
            alt="Profile Banner"
            class="rounded-lg w-full mb-2"
        >

        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="font-bold text-2xl">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex ml-1">

                @if (auth()->user()->is($user))
                    <a 
                        href=""
                        class="rounded-full border border-gray-300 py-2 px-6 text-black text-sm"
                    >
                        Edit Profile
                    </a>
                @endif
                
                @unless (auth()->user()->is($user))
                    <form action="{{ route('follow', $user->name) }}" method="POST">
                        @csrf
                        <button 
                            type="submit"
                            class="bg-blue-500 rounded-full shadow py-2 px-6 text-white text-sm"
                        >
                            {{ auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me' }}
                        </button>
                    </form>
                @endunless
                
            </div>
        </div>

        <p class="text-sm text-center">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil deserunt beatae est deleniti tempore architecto ab corrupti autem magni ullam dolor, atque aliquam maiores harum, porro dicta sint numquam maxime quisquam error neque odio culpa sit eaque? Aliquam, sapiente reprehenderit!
        </p>

        <img
            src="{{ $user->avatar }}"
            alt="Avatar"
            class="rounded-full absolute"
            style="width: 125px; left: 50%; transform: translateX(-50%); top:145px"
        >
        
    </header>

    @include('_timeline', [
        'tweets' => $user->tweets
    ])
@endsection
