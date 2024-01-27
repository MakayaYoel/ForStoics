<nav class="w-full h-28 flex items-center p-6 text-2xl text-white">
    <div class="w-full h-full flex justify-between font-serif">
        <h1 class="w-1/3 text-center self-center"><a href="/">ForStoics</a></h1>

        <div class="w-1/3 flex justify-center self-center">
            <ul class="flex gap-8">
                <li><a href="/">Home</a></li>
                <li><a href="/posts">Blogs</a></li>
                <li><a href="#">Contact</a></li>
                <li>@include('partials._search')</li>
            </ul>
        </div>

        @auth
            <div class="w-1/3 flex justify-center gap-4 self-center">
                <a href="/posts/create" class="inline-block flex items-center justify-center"><button class="mr-4 h-12 p-2 border-solid border-2 rounded text-xl hover:bg-neutral-700">New post</button></a>

                <div class="border-2 rounded-full h-12 w-12 overflow-hidden">
                    
                    <a href="/user/manage-profile">
                        <img
                            class="h-full w-full rounded-full"
                            src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('website_images/default-profile-picture.png')}}" 
                            alt="User Profile Picture"
                        >
                    </a>
                </div>
                <button class="ml-4 h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a class="inline-block w-full h-full flex justify-center items-center" href="/logout">Logout</a></button>
            </div>
        @else
            <div class="w-1/3 flex justify-center gap-4 self-center">
                <button class="h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a class="inline-block w-full h-full flex justify-center items-center" href="/login">Login</a></button> 
                <!-- Not a fan of the flex anchor tag just so then I can center a text... !-->
                <button class="h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a class="inline-block w-full h-full flex justify-center items-center"  href="/register">Register</a></button>
            </div>
        @endauth
    </div>
</nav>