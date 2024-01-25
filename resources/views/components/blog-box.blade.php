@php
    $post = \App\Models\Post::find($id);
@endphp

<div class="w-64 h-64 border-2 border-black rounded-lg">
    <a href="/posts/{{$id}}">
        <img class="w-full border-b-2 border-black rounded-lg rounded-b-none" style="height:191.8px" src="{{$post->cover_image ? asset('storage/' . $post->cover_image) : asset('website_images/no-photo-available.png')}}" alt="No Photo Available">
    </a>
    
    <div class="flex flex-col justify-center items-center">
        <a href="/posts/{{$id}}"><h1 class="text-white text-center font-bold text-lg">{{$post->title}}</h1></a>
        <x-created-by :author="$post->user->id" />
    </div>
</div>