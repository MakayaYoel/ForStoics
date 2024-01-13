@if(session()->has('flash-message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed bottom-0 right-0 transform bg-white m-w-80 w-max h-16 text-white px-4 py-3 font-serif flex justify-between items-center border-2 border-black">
        <i class='bx bx-message-dots text-black text-left w-1/3 text-3xl'></i>
        <p class="font-bold text-black text-center m-w-1/3 w-max text-xl">
            {{session('flash-message')}}
        </p>
        <div class="w-1/3"></div>
    </div>
@endif