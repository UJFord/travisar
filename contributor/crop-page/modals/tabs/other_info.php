<!-- Other info TAB -->
<div class="fade tab-pane" id="other_info-tab-pane" role="tabpanel" aria-labelledby="other_info-tab" tabindex="0">
    <!-- Type, Name and Description-->
    <div id="otherData">
        <div class="row mb-4 other-info">
            <!-- Type -->
            <div class="col-4">
                <label for="Type" class="form-label small-font">Type</label>
                <input id="Type" type="text" name="other_info_type_1" class="form-control">
            </div>

            <!-- Aroma -->
            <div class="col-4">
                <label for="Other-Name" class="form-label small-font">Name</label>
                <input id="Other-Name" type="text" name="other_info_name_1" class="form-control">
            </div>

            <!-- button to add new row -->
            <div class="col-2" style="margin-left: 110px; padding-top: 25px;">
                <button type="button" id="add-row-other" class="btn btn-secondary" style="background-color: var(--mainBrand);">Add</button>
            </div>

            <!-- Other info Desc -->
            <div class="col-12 mb-2">
                <label for="Other-Info-Desc" class="form-label small-font">Description</label>
                <textarea name="other_info_desc_1" id="Other-Info-Desc" cols="30" rows="2" class="form-control"></textarea>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open more tab" onclick="switchTab('more', this)">Previous</button>
        </div>
    </div>
</div>
<!-- script for adding new row of data -->
<script>
    // for adding and removing rows dynamically
    // i set the names for each input field to be unique name attribute 
    // (province_name_1, municipality_name_1, province_name_2, municipality_name_2, and so on)
    // for when the form is submitted hiwalay ang pag save
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButton = document.getElementById('add-row-other');
        const otherData = document.getElementById('otherData');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'other-info');
            newRow.innerHTML = `
                <!-- Type -->
                <div class="col-4">
                    <label for="Type" class="form-label small-font">Type</label>
                    <input id="Type" type="text" name="other_info_type_${rowCounter}" class="form-control">
                </div>

                <!-- Aroma -->
                <div class="col-4">
                    <label for="Other-Name" class="form-label small-font">Name</label>
                    <input id="Other-Name" type="text" name="other_info_name_${rowCounter}" class="form-control">
                </div>

                <div class="col-2" style="margin-left: 110px; padding-top: 25px;">
                    <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
                </div>

                <!-- Other info Desc -->
                <div class="col-12 mb-2">
                    <label for="Other-Info-Desc" class="form-label small-font">Description</label>
                    <textarea name="other_info_desc_${rowCounter}" id="Other-Info-Desc" cols="30" rows="2" class="form-control"></textarea>
                </div>
            `;
            otherData.appendChild(newRow);
        });

        otherData.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.other-info').remove();
            }
        });

        window.addEventListener('beforeunload', function(e) {
            // Reset the form data here
            otherData.innerHTML = '';
            rowCounter = 1; // Reset the row counter
        });
    });
</script>