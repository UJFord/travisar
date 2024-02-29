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
<div class="fade show active tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col-6">
            <label for="crop_variety" class="form-label small-font">Name<span style="color: red;">*</span></label>
            <input id="crop_variety" type="text" name="crop_variety" class="form-control">
        </div>

        <!-- Category -->
        <!-- <div class="col-6">
            <label for="Category" class="form-label small-font">What type of crop is this? <span style="color: red;">*</span></label>
            <select name="category_id" id="Category" class="form-select">
                <?php
                // get the data of category from DB
                // gi set ra nako na permi last ang other nga category og ascending sya based sa catgory name
                $queryCategory = "SELECT * FROM category ORDER BY
                CASE
                    WHEN category_name = 'Other' THEN 2
                    ELSE 1
                END, category_name ASC";
                $query_run = pg_query($conn, $queryCategory);
                $query_run = pg_query($conn, $queryCategory);

                $count = pg_num_rows($query_run);

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                ?>
                        <option value="<?= $category_id; ?>"><?= $category_name; ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
        </div> -->
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
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInputEdit" accept="image/jpeg,image/png" name="crop_image[]" multiple>
                <!-- current images -->
                <div id="previewEdit" class="preview-containerEdit custom-scrollbar overflow-scroll rounded border p-1">
                </div>
            </div>
        </div>
    </div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="description" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="description" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <!-- <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div> -->
</div>

<!-- JavaScript to show or hide the input box -->
<script>
    document.getElementById('Category').addEventListener('change', function() {
        var otherCategoryInput = document.getElementById('otherCategoryInput');
        var selectedCategory = document.getElementById('Category').value;
        if (selectedCategory === '3') {
            otherCategoryInput.style.display = 'block';
        } else {
            otherCategoryInput.style.display = 'none';
        }
    });
</script>

<script defer>
    // handling to show all image inputs
    const imageInputEdit = document.getElementById('imageInputEdit');
    const previewContainerEdit = document.querySelector('.preview-containerEdit');

    // function to display and remove the image selected
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#previewEdit').empty();
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-image" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
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