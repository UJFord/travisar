<!-- GENERAL TAB -->
<div class="fade show active" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">


    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- name -->
        <div class="col">
            <label for="Name" class="form-label small-font">Name</label>
            <input type="text" class="form-control">
        </div>
        <!-- type -->
        <div class="col">
            <label for="Type" class="form-label small-font">What type of crop is this?</label>
            <select name="" id="" class="form-select">
                <option value=""></option>
                <option value="">Rice</option>
                <option value="">Corn</option>
                <option value="">Carrot</option>
            </select>
        </div>
    </div>

    <!-- IMAGE -->
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Image</span>
                </label>
                <!-- image input -->
                <input class="mb-1" type="file" id="imageInput" accept="image/*" multiple>
                <!-- image preview -->
                <div class="preview-container border overflow-scroll rounded p-2 col"></div>
            </div>

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
</style>


<!-- SCRIPT -->
<script>
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
</script>