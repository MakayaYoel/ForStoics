@extends('layout')

@section('content')
    <div class="w-full h-48 flex flex-col pt-4 px-48 font-serif">
        <h1 class="text-center text-white text-5xl mb-4 font-semibold">{{$post->title}}</h1>
        <div class="mb-4 flex justify-between items-center">
            <p class="text-white flex gap-2">
                Created By: 
                <span class="inline-block h-6 w-6 rounded-full border-2">
                    <a href=""><img
                        class="h-full w-full rounded-full"
                        src="{{$post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
                        alt="User Profile Picture"
                        >
                    </a>
                </span> <a class="font-bold" href="#">{{$post->user->name}}</a>
            </p>

            <!-- If they're the owner of the blog page !-->
            @if (auth()->user()->id == $post->user->id)
                <div class="text-white flex gap-4">
                    <a href="/posts/{{$post->id}}/edit"><i class='bx bxs-edit text-xl'></i></a>
                    <form action="/posts/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button><a href="/posts/{{$post->id}}"><i class='bx bx-trash text-xl'></i></a></button>
                    </form>
                </div>
            @endif

        </div>
        <div class="w-full border bg-neutral-600"></div>
        <div class=" pt-8 text-white text-lg leading-7">
            <p class="break-words w-full">
                @php
                    echo nl2br($post->content, false);
                @endphp
            </p>
        </div>
    </div>
@endsection