@extends('layout')

@section('content')
    <div class="w-full h-48 flex px-48 gap-12">
        <img 
            class="border-2 w-48 h-48 rounded-full"
            src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
            alt="User Profile Picture"
        >
        <div class="self-center">
            <h1 class="text-white text-4xl font-semibold">{{auth()->user()->name}}</h1>
            <p class="text-gray-500">Placeholder for something IG</p>
        </div>
    </div>

    <div class="border-2 mt-12 h-1/2">

    </div>
@endsection