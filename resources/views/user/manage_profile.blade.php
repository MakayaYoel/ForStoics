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
        <div class="self-center flex flex-col gap-2">
            <h1 class="text-white text-4xl font-semibold">{{auth()->user()->name}}</h1>
            <p class="text-gray-500"><span class="inline-block bg-red-500 w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white">✦ Admin</span></p>
            <div class="w-96 h-8 bg-neutral-700 rounded-full">
                <div class="w-32 h-full rounded-full bg-lime-600"></div>
            </div>
            
        </div>
    </div>

    <div class="border-2 mt-12 h-1/2">

    </div>

    @include('user.modal.edit_profile_picture')
@endsection