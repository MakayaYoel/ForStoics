@if ($user->hasAnyAccess(array_keys(\Orchid\Support\Facades\Dashboard::getAllowAllPermission()->toArray())))
    <p class="text-gray-500 mb-1"><span class="inline-block bg-red-500 w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white">✦ Admin</span></p>
@endif
<p class="text-gray-500"><span class="inline-block w-max px-4 h-6 flex justify-center items-center rounded-full font-bold text-white" style="background-color: {{$rankData["rank_color"]}}">
    ✦ {{$rankData['rank_name']}}
</span></p>