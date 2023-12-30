@extends('layout')

@section('content')
    <div class="w-full h-48 flex flex-col pt-4 px-48 font-serif">
        <h1 class="text-center text-white text-5xl mb-4">{{$post->title}}</h1>
        <div class="mb-4">
            <p class="text-white flex gap-2">
                Created By: 
                <span class="inline-block h-6 w-6 rounded-full border-2">
                    <a href=""><img
                        class="h-full w-full rounded-full"
                        src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
                        alt="User Profile Picture"
                        >
                    </a>
                </span> <a class="font-bold" href="#">{{$post->user->name}}</a>
            </p>
        </div>
        <div class="w-full border bg-neutral-600"></div>
        <div class="pt-8 text-white text-lg leading-7">
            @php
                $string = nl2br($post->content, false);

                echo $string; // This has to be done to actually show the spaces???
            @endphp
        </div>
    </div>
@endsection