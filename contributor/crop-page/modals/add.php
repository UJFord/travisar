<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <div class="modal-body">
                <div class="container">

                    <!-- NAME AND TYPE -->
                    <div class="row mb-3">
                        <!-- name -->
                        <div class="col">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <!-- type -->
                        <div class="col">
                            <label for="Type" class="form-label">What type of crop is this?</label>
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
                        <div class="col-6">
                            <div class="d-flex flex-wrap justify-content-center align-items-center image-upload-container">
                                <label for="imageInput" class="d-flex justify-content-center align-items-center p-2 rounded border">
                                    <i class="fa-solid fa-image me-2"></i>
                                    <span>Choose Image</span>
                                    <input type="file" id="imageInput" accept="image/*" multiple>
                                </label>
                                <div class="preview-container"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="">
                    <button type="button" class="btn btn-success">Save</button>
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                </div>
                <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
            </div>
        </div>
    </div>
</div>

<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        width: 400px;
        height: 100px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .preview-container {
        /* Adjust style of preview container */
        display: flex;
        flex-wrap: wrap;
    }

    .img-thumbnail {
        /* Customize styling of preview images */
        max-width: 100px;
        max-height: 100px;
    }
</style>

<!-- SCRIPT -->
<script>
    // keep the modal on
    window.onload = function() {
        const dataModal = new bootstrap.Modal(document.getElementById('add-item-modal'), {
            keyboard: false
        });
        dataModal.show();
    };


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
                img.classList.add('img-thumbnail', 'm-2'); // Add Bootstrap styling
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    });
</script>