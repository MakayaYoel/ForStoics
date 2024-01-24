@extends('layout')

@section('content')
    <div class="min-h-screen max-h-max flex flex-col items-center relative" style="height: calc(100vh - 90px)">
        <h1 class="text-white font-bold text-4xl">Posts</h1>

        <div class="flex justify-center mt-6 flex flex-wrap">
            @foreach($posts as $post)
                <div class="mr-4 mb-4">
                    <x-blog-box :id="$post->id" />
                </div>
                
            @endforeach
        </div>

        <div class="absolute bottom-0 mb-4">
            {{$posts->links()}}
        </div>
    </div>
@endsection