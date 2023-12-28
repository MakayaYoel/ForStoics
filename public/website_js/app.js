function openEditProfilePictureModal() {
    let modal = document.getElementById("edit_profile_picture_modal");
    
    let edit_pfp_file_input = document.getElementById("edit_pfp_file");

    edit_pfp_file_input.value = null; 

    modal.classList.remove('hidden');
};

function closeEditProfilePictureModal() {
    let modal = document.getElementById("edit_profile_picture_modal");

    modal.classList.add('hidden');
};

function editProfilePictureModal_onUpload(){
    let edit_pfp_canvas = document.getElementById("edit_pfp_canvas");
    let edit_pfp_file_input = document.getElementById("edit_pfp_file");
    let edit_pfp_form_uploaded_image = new SimpleImage(edit_pfp_file_input);
    edit_pfp_form_uploaded_image.drawTo(edit_pfp_canvas);
};