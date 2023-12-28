@extends('layout')

@section('content')
    <div class="w-full h-48 flex px-48 gap-12">
        <div class="group relative">
            <img 
                class="border-2 w-48 h-48 rounded-full"
                src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
                alt="User Profile Picture"
            >

            <div class="hidden absolute border-2 top-0 rounded-full w-full h-full bg-neutral-500/50 flex group-hover:block">
                <button href="#" onclick="openEditProfilePictureModal()"><i class='bx bxs-edit text-2xl absolute top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4'></i></button>
            </div>
        </div>
        <div class="self-center">
            <h1 class="text-white text-4xl font-semibold">{{auth()->user()->name}}</h1>
            <p class="text-gray-500">Placeholder for something IG</p>
        </div>
    </div>

    <div class="border-2 mt-12 h-1/2">

    </div>

    @include('user.modal.edit_profile_picture')
@endsection