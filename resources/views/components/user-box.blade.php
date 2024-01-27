<div class="w-48 h-48 flex flex-col items-center justify-center gap-2">
    <a class="inline-block w-1/2" href="/user/{{$user->id}}">
        <img class="border-2 w-full rounded-full" src="{{$user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('/website_images/default-profile-picture.png')}}" alt="">
    </a>
    
    
    <div class="flex flex-col justify-center items-center">
        <a href="/user/{{$user->id}}"><h1 class="text-white text-2xl font-bold">{{$user->name}}</h1></a>
        @php   
            $user = \App\Models\User::find($user->id);
            $rankData = \App\Models\User::find($user->id)->getRankData();
        @endphp
        <x-rank-tag :user="$user" :rankData="$rankData" />
    </div>

</div>