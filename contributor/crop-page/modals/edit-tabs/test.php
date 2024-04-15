<!-- IMAGE -->
<div class="row mb-2">
    <div class="col">
        <div class="d-flex flex-column image-upload-container">
            <!-- label -->
            <label for="imageInputEdit" class="d-flex align-items-center rounded small-font mb-2">
                <i class="fa-solid fa-image me-2"></i>
                <span>Image <span style="color: red;">*</span></span>
            </label>
            <!-- old/current image -->
            <input type="hidden" name="old_image" id="oldImageInput">
            <!-- image input -->
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputEdit" accept="image/jpeg,image/png" name="crop_image[]" multiple>
            <!-- current images -->
            <div id="previewEdit" class="preview-containerEdit custom-scrollbar overflow-scroll rounded border p-1"></div>
        </div>
    </div>
</div>

<!-- SCRIPT for edit tab for the image-->
<script defer>
    // handling to show all image inputs
    const imageInputEdit = document.getElementById('imageInputEdit');
    const previewContainerEdit = document.querySelector('.preview-containerEdit');
    let oldImage = ''; // Variable to store the old image URL or filename

    // Function to fetch the old image when editing an item
    function fetchOldImage(image) {
        oldImage = image; // Store the old image URL or filename
    }

    // Function to add the old image file to the files array at the end
    function addOldImageFile(oldImageFilename) {
        var dataTransfer = new DataTransfer();
        Array.from(imageInputEdit.files).forEach(function(file) {
            dataTransfer.items.add(file);
        });
        var oldImageFile = new File([null], oldImageFilename, {
            type: 'image/png'
        });
        dataTransfer.items.add(oldImageFile);
        imageInputEdit.files = dataTransfer.files;
    }

    // function to display and remove the image selected
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#previewEdit').empty();

            // Loop through the files and append them to the preview container
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-image" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            // If there's an old image, append it to the preview container and set the value of the hidden input field
            if (oldImage) {
                var oldImageFilenames = oldImage.split(',');
                oldImageFilenames.forEach(function(filename, index) {
                    $('#previewEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="crop-page/modals/img/' + filename.trim() + '" class="img-thumbnail"/><button class="remove-image" data-index="' + (files.length + index) + '"><i class="fa-solid fa-xmark"></i></button></div>');

                    // Add the old image file to the files array
                    addOldImageFile(filename.trim());
                });
            }

            console.log("Remaining images after change:", imageInputEdit.files);
            checkForContent();
        });

        //* if you input multiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transferred to another array and is considered as a new input
        $(document).on("click", ".remove-image", function() {
            var index = $(this).data("index");
            console.log("Removing image at index:", index);

            var newFiles = Array.from(imageInputEdit.files).filter((_, i) => i !== index);
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            // Update the input files and reset the indexes
            imageInputEdit.files = dataTransfer.files;
            $('#previewEdit').empty();
            Array.from(imageInputEdit.files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-image" data-index="' + index + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            console.log("New files array after removal:", imageInputEdit.files);
            checkForContent();
        });

        // Add event listener for the hidden.bs.modal event
        $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
            imageInputEdit.value = ''; // Reset file input
            $('#previewEdit').empty(); // Clear preview container
            checkForContent();
        });
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');
    function checkForContent() {
        if (previewContainerEdit.hasChildNodes()) {
            previewContainerEdit.classList.add('border');
        } else {
            previewContainerEdit.classList.remove('border');
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainerEdit.addEventListener('DOMNodeInserted', checkForContent);
    previewContainerEdit.addEventListener('DOMNodeRemoved', checkForContent);
</script>