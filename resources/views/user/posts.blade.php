@extends('layout')

@section('content')
    <div class="min-h-screen max-h-max">
        <div class="flex flex-col gap-24 items-center mb-12">
            <h1 class="text-white font-bold text-5xl">{{$user->name}}'s Posts</h1>
            <div class="px-32 flex justify-center flex-wrap gap-8">
                @if(count($user->posts) == 0) <h1 class="font-bold text-white text-4xl">There are no posts.</h1> @endif
                @foreach ($user->posts->sortByDesc('updated_at') as $post)
                    <x-blog-box :id="$post->id" />
                @endforeach
            </div>
        </div>
    </div>
@endsection