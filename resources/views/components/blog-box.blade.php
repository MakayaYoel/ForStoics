@php
    $post = \App\Models\Post::find($id);
@endphp

<div class="border-2 border-black rounded-lg" style="width: 17.5rem; height: 17rem;">
    <a href="/posts/{{$id}}">
        <img class="w-full border-b-2 border-black rounded-lg rounded-b-none" style="height:191.8px" src="{{$post->cover_image ? asset('storage/' . $post->cover_image) : asset('website_images/no-photo-available.png')}}" alt="No Photo Available">
    </a>
    
    <div class="mt-1 flex flex-col gap-2">
        <a href="/posts/{{$id}}"><h1 class="text-white text-center font-bold text-lg">{{$post->title}}</h1></a>
        <div class="self-center">
            <x-created-by :author="$post->user->id" />
        </div>
    </div>
</div>