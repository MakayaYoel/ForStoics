@php
    $user = \App\Models\User::find($author);
@endphp

<p class="text-white flex gap-2">
    Created By: 
    <span class="inline-block h-6 w-6 rounded-full border-2">
        <a href="/user/{{$user->id}}"><img
            class="h-full w-full rounded-full"
            src="{{$user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
            alt="User Profile Picture"
            >
        </a>
    </span> <a class="font-bold" href="/user/{{$user->id}}">{{$user->name}}</a>
</p>