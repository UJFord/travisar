<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-containerEdit {
        /* Adjust style of preview container */
        display: flex;
        /* flex-wrap: wrap; */
    }

    .img-thumbnail {
        /* Customize styling of preview images */
        max-width: 5rem;
        max-height: 5rem;
        aspect-ratio: 1/1;
    }

    /* hiding the scrollbar */
    #previewEdit {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="edit-gen-tab-pane" role="tabpanel" aria-labelledby="edit-gen-tab" tabindex="0">
    <!-- Contributed, Unique Code, and Date Created -->
    <dv class="row mb-3">
        <!-- Contributed By -->
        <div class="col">
            <label for="firstName" class="form-label small-font">Contributed By:</label>
            <h6 name="first_name" id="firstName"></h6>
        </div>

        <!-- Unique Code -->
        <div class="col">
            <label for="firstName" class="form-label small-font">Unique Code:</label>
            <h6 name="unique_code" id="uniqueCode"></h6>
        </div>

        <!-- Date created -->
        <div class="col">
            <label for="input_dateEdit" class="form-label small-font">Date Created:</label>
            <h6 name="input_date" id="input_dateEdit"></h6>
        </div>
    </dv>

    <!-- Categories, Other Category, and Crop Field -->
    <div class="row mb-3">
        <!-- Category -->
        <div class="col">
            <label for="CategoryEdit" class="form-label small-font">Category:</label>
            <h6 name="category_id" id="CategoryEdit"></h6>
            </input>
        </div>

        <!-- other category name if exist -->
        <div class="col" id="otherCategoryInputEdit" style="display: none;">
            <label for="otherCategoryInputEdit" class="form-label small-font">Other Category Name:</label>
            <h6 name="other_category_name" id="otherCategoryEdit"></h6>
        </div>

        <!-- Crop Field -->
        <div class="col">
            <label for="fieldEdit" class="form-label small-font">Crop Field:</label>
            <h6 name="field_id" id="fieldEdit"></h6>
        </div>
    </div>

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- crop_id -->
        <input id="crop_id" type="hidden" name="crop_id" class="form-control">
        <!-- cultural_aspect_id -->
        <input id="cultural_aspect_id" type="hidden" name="cultural_aspect_id" class="form-control">

        <!-- variety name -->
        <div class="col">
            <label for="crop_variety" class="form-label small-font">Variety Name<span style="color: red;">*</span></label>
            <h6 name="crop_variety" id="crop_variety"></h6>
        </div>

        <!-- Rarity -->
        <div class="col mb-2">
            <label for="rarityEdit" class="form-label small-font">Rarity:</label>
            <h6 name="rarity" id="rarityEdit"></h6>
        </div>
    </div>

    <!-- Meaning of name and Rarity -->
    <div class="row mb-3">
        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label small-font">Meaning of Name(if any)</label>
            <h6 name="meaning_of_name" id="nameMeaning"></h6>
        </div>

        <!-- Name Origin -->
        <div class="col mb-2">
            <label for="NameOrigin" class="form-label small-font">Name Origin</label>
            <h6 name="name_origin" id="NameOrigin"></h6>
        </div>
    </div>

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
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInputEdit" accept="image/jpeg,image/png" name="crop_image[]" multiple disabled>
                <!-- current images -->
                <div id="previewEdit" class="preview-containerEdit custom-scrollbar overflow-scroll rounded border p-1"></div>
            </div>
        </div>
    </div>

    <!-- local name AND name origin -->
    <div class="row mb-3">
        <!-- local name -->
        <div class="col-6">
            <label for="LocalName" class="form-label small-font">Local Name</label>
            <h6 name="crop_local_name" id="LocalName"></h6>
        </div>

        <!-- scientific name -->
        <div class="col-6">
            <label for="ScienceName" class="form-label small-font">Scientific Name</label>
            <h6 name="scientific_name" id="ScienceName"></h6>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="description" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="description" rows="2" class="form-control" disabled></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
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