<style>
.remove-image {
        position: absolute;
        top: 0.3;
        right: 0.3rem;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .image-preview {
        position: relative;
        display: inline-block;
        aspect-ratio: 1/1;
    }


    #preview {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- image -->
    <div class="row mb-3">
        <!-- image -->
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Crop Image <span style="color: red;">*</span></span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_image[]" multiple required>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
        </div>
    </div>

<!-- SCRIPT for add tab-->
<script defer>
    // handling to show all image inputs
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.querySelector('.preview-container');

    // function to display and remove the image selected
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#preview').empty();
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').append('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-image" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });
        });

        //* if you input muiltiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transfered to another array and is considered as a new input
        $(document).on("click", ".remove-image", function() {
            var index = $(this).data("index");
            var input = $('input[type="file"]')[0];
            var files = input.files;
            var newFiles = [];
            for (var i = 0; i < files.length; i++) {
                if (i !== index) {
                    newFiles.push(files[i]);
                }
            }
            //* mao ni tung mag transfer sa data to another input
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            $(this).parent().remove();
        });

        // Add event listener for the hidden.bs.modal event
        $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
            // Clear the image input field
            $('#imageInput, #imageInputEdit').val('');
            // Clear the image preview container
            $('#preview, #previewEdit').empty();
        });
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');
    function checkForContent() {
        var previewContainer = document.querySelector('.preview-container');
        if (previewContainer.hasChildNodes()) {
            previewContainer.style.display = 'block'; // Show the preview container
            previewContainer.classList.add('border'); // Add border to the container
        } else {
            previewContainer.style.display = 'none'; // Hide the preview container
            previewContainer.classList.remove('border'); // Remove border from the container
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainer.addEventListener('DOMNodeInserted', checkForContent);
    previewContainer.addEventListener('DOMNodeRemoved', checkForContent);
</script>