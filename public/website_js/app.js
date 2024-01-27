
// Opens the edit profile picture modal
function openEditProfilePictureModal() {
    let modal = document.getElementById("edit_profile_picture_modal");
    
    let edit_pfp_file_input = document.getElementById("edit_pfp_file");
    edit_pfp_file_input.value = null; // reset the file input

    let canvas = document.getElementById("edit_pfp_canvas");
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height); // reset the canvas

    // Open the modal
    modal.classList.remove('hidden');
};

// Closes the edit profile picture modal
function closeEditProfilePictureModal() {
    let modal = document.getElementById("edit_profile_picture_modal");

    modal.classList.add('hidden');
};

// Showcase the uploaded image in the edit profile picture modal
function editProfilePictureModal_onUpload(){
    let edit_pfp_canvas = document.getElementById("edit_pfp_canvas"); // The canvas (white box next to file input)
    let edit_pfp_file_input = document.getElementById("edit_pfp_file"); // file input

    // Make a SimpleImage and draw it onto the canvas
    let edit_pfp_form_uploaded_image = new SimpleImage(edit_pfp_file_input); 
    edit_pfp_form_uploaded_image.drawTo(edit_pfp_canvas);
};

// Opens the report modal
function openReportModal() {
    let modal = document.getElementById("report_modal");

    modal.classList.remove('hidden');
}

// Closes the report modal
function closeReportModal() {
    let modal = document.getElementById("report_modal");

    modal.classList.add('hidden');
}