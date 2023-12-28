<div class="hidden fixed top-0 left-0 h-screen w-screen bg-black/50 flex justify-center items-center font-serif" id="edit_profile_picture_modal">
    <div class="bg-zinc-800 rounded-lg w-1/3 h-64 py-4 flex flex-col">
        <h1 class="text-white text-2xl ml-4 mb-2">Edit profile picture?</h1>
        <div class="w-full border bg-neutral-600 mb-4"></div>

        <div class="w-full px-12 flex items-center gap-8 text-white">
            <canvas id="edit_pfp_canvas" class="profile-picture-showcase border-2 h-36 w-36">

            </canvas>

            <form method="POST" action="/user/manage-profile/profile-picture" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input id="edit_pfp_file" name="profile_picture" type="file" multiple="false" accept="image/png, image/jpeg" onchange="editProfilePictureModal_onUpload()">
                @error('profile_picture')
                    <p class='text-red-400'>{{$message}}</p>
                @enderror

                <div class="mt-4">
                    <button class="bg-red-500 w-16 h-8 rounded text-white hover:cursor-pointer" onclick="closeEditProfilePictureModal()">Close</button>
                    <input class="bg-green-600 w-16 h-8 rounded text-white hover:cursor-pointer" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>