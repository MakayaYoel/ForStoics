@extends('layout')

@section('content')
    <div class="h-screen flex justify-center">
        <div class="self-center h-4/6 w-1/4 flex flex-col mb-12">
            <h1 class="text-center text-white font-bold text-3xl mt-4">Register</h1>
            <form action="/register" method="POST" class="flex flex-col self-center w-full font-serif mt-6">
                @csrf

                <div class="mb-6">
                    <label for="name" class="text-white text-2xl">Enter your username:</label>
                    <input type="text" id="name" name="name" class="w-full h-8 bg-transparent border-2 rounded pl-2 text-white" autocomplete="off" value="{{old('username')}}">
                    @error('name')
                        <p class='text-red-400'>{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="text-white text-2xl">Enter your E-mail:</label>
                    <input type="email" id="email" name="email" class="w-full h-8 bg-transparent border-2 rounded pl-2 text-white" autocomplete="off" value="{{old('email')}}">
                    @error('email')
                        <p class='text-red-400'>{{$message}}</p>
                    @enderror
                </div>
                

                <div class="mb-6">
                    <label for="password" class="text-white text-2xl">Enter your password:</label>
                    <input type="password" id="password" name="password" class="w-full h-8 bg-transparent border-2 rounded pl-2 text-white" autocomplete="off">
                    @error('password')
                        <p class='text-red-400'>{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="Register" class="w-full border-2 rounded h-12 text-white text-xl hover:bg-neutral-700 cursor-pointer">
            </form>
        </div>
    </div>
@endsection