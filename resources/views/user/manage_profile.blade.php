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
            <h1 class="text-white text-4xl font-semibold">{{$user->name}}</h1>
            <div class="flex gap-1">
                <p class="text-gray-500"><span class="inline-block bg-red-500 w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white">✦ Admin</span></p>
                <p class="text-gray-500"><span class="inline-block w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white" style="background-color: {{$rank_data["rank_color"]}}">
                    ✦ {{$rank_data['rank_name']}}
                </span></p>
            </div>
            <div class="relative w-96 h-8 bg-neutral-500 rounded-full">
                @php
                    $xp = ($user->xp > 10000 ? 10000 : $user->xp);
                    $percent = $xp / 10000 * 100;
                @endphp

                <div class="relative h-full bg-lime-500 rounded-full cursor-pointer group" style="width:{{$percent}}%;">
                    <div class="hidden rounded-sm absolute top-10 w-32 bg-black/50 text-xs text-white text-center group-hover:block">You are currently at {{number_format($user->xp)}}xp</div>
                </div>
                @for ($i = 1; $i <= 4; $i++)
                    <div class="absolute w-0.5 h-8 bg-black bottom-0" style="left:{{20 * $i}}%"></div>
                @endfor
            </div>
            
        </div>
    </div>

    <div class="border-2 mt-12 h-1/2">

    </div>

    @include('user.modal.edit_profile_picture')
@endsection