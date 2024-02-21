<!-- GENERAL TAB -->
<div class="fade tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col">
            <label for="Name" class="form-label small-font">Variety Name <span style="color: red;">*</span></label>
            <input id="Name" type="text" class="form-control" placeholder="Ex. Sinandomeng">
        </div>
        <!-- locall name -->
        <div class="col">
            <label for="Name" class="form-label small-font">Local Name <span style="color: red;">*</span></label>
            <input type="text" class="form-control" placeholder="Ex. Bugas">
        </div>
    </div>

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- type -->
        <div class="col">
            <label for="Type" class="form-label small-font">What type of crop is this? <span style="color: red;">*</span></label>
            <select name="" id="Type" class="form-select" placeholder="Ex. Rice">
                <option value="">Rice</option>
                <option value="">Corn</option>
                <option value="">Carrot</option>
            </select>
        </div>
        <!-- crop field -->
        <div class="col">
            <label for="CropField" class="form-label small-font">Where is this crop planted? <span style="color: red;">*</span></label>
            <select name="" id="CropField" class="form-select">
                <option value="">Lowland</option>
                <option value="">Upland</option>
                <option value="">Rice Field</option>
            </select>
        </div>
    </div>

    <!-- IMAGE -->
    <div class="row mb-3">
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Image <span style="color: red;">*</span></span>
                </label>
                <!-- image input -->
                <input class="mb-1 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" multiple>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border py-2" id="previewContainer"></div>
            </div>
        </div>
    </div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="" class="form-label small-font">Description</label>
            <textarea name="" id="" rows="2" class="form-control" placeholder="Description ..."></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>

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

    /* hiding the scrollbar */
    #previewContainer {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>


<!-- SCRIPT -->
<script defer>
    // handling to show all image inputs
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.querySelector('.preview-container');

    imageInput.addEventListener('change', (event) => {
        // Clear existing previews
        previewContainer.innerHTML = '';

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mx-2'); // Add Bootstrap styling
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');

    function checkForContent() {
        if (previewContainer.hasChildNodes()) {
            previewContainer.classList.add('border');
        } else {
            previewContainer.classList.remove('border');
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainer.addEventListener('DOMNodeInserted', checkForContent);
    previewContainer.addEventListener('DOMNodeRemoved', checkForContent);


    // next button
    function switchTab(tabName) {
        document.getElementById(tabName + '-tab').click();
        console.log(document.querySelector(tabName + '-tab'))
    }
</script>