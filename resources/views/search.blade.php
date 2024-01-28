@extends('layout')

@section('content')
    <div class="min-h-screen max-h-max flex flex-col">
        <div class="flex flex-col gap-24 items-center mb-12">
            @if(count($users) !== 0)
                <div class="flex flex-col justify-center items-center gap-4">
                    <h1 class="text-white font-bold text-4xl">Users</h1>
                    <div class="px-32 py-4 flex justify-center flex-wrap gap-8">
                        @foreach ($users as $user)
                            <x-user-box :user="$user" />
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($posts) !== 0)
                <div class="flex flex-col justify-center items-center gap-4">
                    <h1 class="text-white font-bold text-4xl">Posts</h1>
                    <div class="px-32 flex justify-center flex-wrap gap-8">
                        @foreach ($posts as $post)
                            <x-blog-box :id="$post->id" />
                        @endforeach
                    </div>
                </div>
            @endif

            @if (count($posts) == 0 && count($users) == 0)
                <h1 class="text-white font-bold text-5xl">No results found.</h1>
            @endif
        </div>
    </div>
@endsection