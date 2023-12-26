<nav class="w-full h-28 flex items-center p-6 text-2xl text-white">
    <div class="w-full h-full flex justify-between font-serif">
        <h1 class="w-1/3 text-center self-center"><a href="/">ForStoics</a></h1>

        <div class="w-1/3 flex justify-center self-center">
            <ul class="flex gap-8">
                <li><a href="/">Home</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="#">Feeds</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        @auth
            <div class="w-1/3 flex justify-center gap-4 self-center">
                <p class="self-center">Welcome, {{auth()->user()->name}}</p>
                <i class='bx bxs-user text-white self-center hover:cursor-pointer'></i>
                <button class="h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a href="/logout">Logout</a></button>
            </div>
        @else
            <div class="w-1/3 flex justify-center gap-4 self-center">
                <button class="h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a href="/login">Login</a></button>
                <button class="h-12 w-1/4 border-solid border-2 rounded text-xl hover:bg-neutral-700"><a href="/register">Register</a></button>
            </div>
        @endauth
    </div>
</nav>