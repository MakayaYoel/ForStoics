@extends('layout')

@section('content')
    <div class="h-screen">
        <div class="w-full h-48 flex px-48 gap-12">
            <div class="group relative">
                <img 
                    class="border-2 w-48 h-48 rounded-full"
                    src="{{$user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
                    alt="User Profile Picture"
                >

                @if (auth()->user()->id == $user->id)
                    <div class="hidden absolute border-2 top-0 rounded-full w-full h-full bg-neutral-500/50 flex group-hover:block">
                        <button href="#" onclick="openEditProfilePictureModal()"><i class='bx bxs-edit text-2xl absolute top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4'></i></button>
                    </div>
                @endif
            </div>
            <div class="self-center flex flex-col gap-2">
                <h1 class="text-white text-4xl font-semibold">{{$user->name}}</h1>
                <div class="flex gap-1">
                    <!-- <p class="text-gray-500"><span class="inline-block bg-red-500 w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white">✦ Admin</span></p> !-->
                    <p class="text-gray-500"><span class="inline-block w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white" style="background-color: {{$rank_data["rank_color"]}}">
                        ✦ {{$rank_data['rank_name']}}
                    </span></p>
                </div>
                <div class="relative w-96 h-8 bg-neutral-500 border-2 border-black">
                    @php
                        $xp = ($user->xp > 10000 ? 10000 : $user->xp);
                        $percent = $xp / 10000 * 100;
                    @endphp

                    <div class="relative h-full bg-lime-500 cursor-pointer group" style="width:{{$percent}}%;">
                        <div class="hidden rounded-sm absolute top-10 w-32 bg-black/50 text-xs text-white text-center group-hover:block">{{number_format($user->xp)}}xp</div>
                    </div>
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="absolute w-0.5 h-full bg-black bottom-0" style="left:{{20 * $i}}%"></div>
                    @endfor
                </div>
                
            </div>
        </div>

        <div class="mt-6 h-1/2 ">
            <div class="w-full h-1/4 flex items-center justify-center">
                <h1 class="text-white text-4xl text-center font-bold">Recent Posts</h1>
            </div>
            <div class="w-full h-2/3 flex justify-around items-center">
                @foreach ($user->posts->sortByDesc('updated_at')->take(5) as $post)
                    <div class="w-64 h-64 border-2 border-black rounded-lg">
                        <a href="/posts/{{$post->id}}">
                            <img class="border-b-2 border-black rounded-lg rounded-b-none" src="{{asset('website_images/no-photo-available.png')}}" alt="No Photo Available">
                        </a>
                        
                        <div class="flex flex-1 justify-center items-center">
                            <a href="/posts/{{$post->id}}"><h1 class="text-white text-center font-bold text-xl">{{$post->title}}</h1></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full flex justify-center items-center">
                <a class="text-center text-white text-4xl font-bold underline" href="/user/{{$user->id}}/posts">See all posts</a>
            </div>
        </div>

        @include('user.modal.edit_profile_picture')
    </div>
@endsection
