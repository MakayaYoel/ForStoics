@extends('layout')

@section('content')
    <div class="min-h-screen max-h-content mb-8">
        <div class="w-full flex flex-col pt-4 px-48 font-serif">
            <h1 class="text-center text-white text-5xl mb-4 font-semibold">{{$post->title}}</h1>
            <img src="{{$post->cover_image ? asset('storage/' . $post->cover_image) : null}}"  alt="" class="w-1/3 self-center mb-4">
            <div class="mb-4 flex justify-between items-center">
                @php
                    $userid = $post->user->id;
                @endphp
                <x-created-by :author="$userid" />
    
                <div class="text-white flex gap-4">
                    <div class="flex gap-4">
                        <form action="/posts/{{$post->id}}/like" method="POST" class="relative bottom-0.5">
                            @csrf
                            <span class="@if(auth()->check() && auth()->user()->hasLiked($post)) text-amber-400 @endif">
                                <button type="submit"><i class="fa-solid fa-thumbs-up"></i></button>
                                {{count($post->likes)}}
                            </span>
                        </form>
                    </div>

                    <button onclick="openReportModal()"><i class='bx bxs-flag text-xl'></i></button>
                    
                    <!-- If they're the owner of the blog page !-->
                    @if (auth()->check() && auth()->user()->id == $post->user->id)
                        <a href="/posts/{{$post->id}}/edit"><i class='bx bxs-edit text-xl'></i></a>
                        <form action="/posts/{{$post->id}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button><a href="/posts/{{$post->id}}"><i class='bx bx-trash text-xl'></i></a></button>
                        </form>
                    @endif
                </div>
    
            </div>
            <div class="w-full border bg-neutral-600"></div>
            <div class=" pt-8 text-white text-lg leading-7">
                <p class="break-words w-full">
                    @php
                        echo nl2br($post->content, false);
                    @endphp
                </p>
            </div>
        </div>
    </div>
    @include('posts.modal.report_modal')
@endsection