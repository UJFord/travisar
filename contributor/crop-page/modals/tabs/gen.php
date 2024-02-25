<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-container {
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

    .remove-image {
        position: absolute;
        top: 0;
        right: 0;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .image-preview {
        position: relative;
        display: inline-block;
        margin-right: 10px;
    }

    /* hiding the scrollbar */
    #previewContainer {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">

    <!-- para ma empty lang ang data sa db dili ra sya ma null -->
    <input type="hidden" name="crop_local_name">
    <input type="hidden" name="field_id" value="1">
    <input type="hidden" name="cultural_significance">
    <input type="hidden" name="spiritual_significance">
    <input type="hidden" name="cultural_importance_and_traditional_knowledge">
    <input type="hidden" name="cultural_use">
    <input type="hidden" name="threats">

    <!-- to get the user_id of the logged in user -->
    <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                                                    echo $_SESSION['USER']['user_id'];
                                                } ?>">

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col-6">
            <label for="Variety-Name" class="form-label small-font">Name<span style="color: red;">*</span></label>
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control">
        </div>

        <!-- Category -->
        <div class="col-6">
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
        </div>
    </div>

    <!-- IMAGE -->
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <button type="submit" name="submit">Upload</button>
    </form>
    <div id="preview"></div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <!-- //! gi comment out nako ni kay pag human og redirect ma adto ka sa try.php sa form ata ni sya sa action="try.php". -->
    <!-- <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc',this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div> -->
</div>

<!-- SCRIPT -->
<script defer>
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#preview').empty();
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').append('<div class="image-preview"><img src="' + e.target.result + '" width="100"/><button class="remove-image" data-index="' + i + '">x</button></div>');
                }
                reader.readAsDataURL(file);
            });
        });

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
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            $(this).parent().remove();
        });
    });

    // next button
    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Get the tab content elements
        var tabPanes = document.querySelectorAll('.tab-pane');
        // Click the tab with id 'loc-tab'
        document.getElementById('loc-tab').click();
    }
</script>