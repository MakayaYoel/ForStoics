@extends('layout')

@section('content')
    <div class="main__container flex justify-between px-8 font-serif" style="height: calc(100vh - 90px)">
        <img 
            class="h-4/5 self-center"
            src="{{asset('website_images/greek_statue.png')}}" alt=""
        >

        <div class="main__text-section self-center mr-32 mb-16 flex flex-col">
            <h1 class="text-white text-8xl tracking-wider">For Stoics</h1>
            <p class="text-gray-500 text-center text-xl">Your average blog/social site about stoicism.</p>
            <a class="block w-1/2 self-center" href="@auth/posts @else/register @endauth"><button class="border-solid border-2 text-white p-2 w-full rounded mt-4 hover:bg-neutral-700">@auth Access the Community @else Join the Community @endauth</button></a>
        </div>
    </div>
@endsection