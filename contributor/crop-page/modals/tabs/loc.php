<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<!-- STYLE -->
<style>
    #map {
        aspect-ratio: 1/1;
    }

    /* accordion header size */
    .accordion-header button {
        font-size: 0.8rem;
        /* Adjust the font size as needed */
    }

    /* dashed border */
    .border-dashed {
        border: 2px #d4d7d9 dashed;
    }

    /* cursor pointer */
    .pointer {
        cursor: pointer;
    }

    /* add location */
    #addLoc:hover {
        background: #E9ECEF;
    }
</style>

<!-- LOCATION TAB -->
<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row mb-3">

        <!-- accordion -->
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- Inputs for Accordion Item #1 -->
                        <div class="col">
                            <div class="row">
                                <!-- Province -->
                                <div class="col-6 mb-1">
                                    <label for="" class="form-label small-font mb-0">Province</label>
                                    <input type="text" class="form-control form-text small-font mt-0" value="Sarangani" disabled>
                                </div>
                                <!-- municipality -->
                                <div class="col-6">
                                    <label for="" class="form-label small-font mb-0">Municipality</label>
                                    <input type="text" class="form-control form-text small-font mt-0" value="Alabel" disabled>
                                </div>
                                <!-- barangay -->
                                <div class="col-6">
                                    <label for="" class="form-label small-font mb-0">Barangay</label>
                                    <input type="text" class="form-control form-text small-font mt-0" value="Poblacion" disabled>
                                </div>
                                <!-- Coordinates -->
                                <div class="col-6">
                                    <label for="" class="form-label small-font mb-0">Coordinates</label>
                                    <input type="text" class="form-control form-text small-font mt-0" value="12.213, 31.312" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- Actions for Accordion Item #1 -->
                        <div class="col-3">
                            <!-- Edit Button -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add entries -->
    <div class="row mb-3 px-4">
        <a id="addLoc" class="col-12 border-dashed rounded p-2 text-secondary d-flex flex-column justify-content-center align-items-center pointer text-decoration-none" data-bs-toggle="modal" data-bs-target="#locEditModal">
            <i class="fa-solid fa-earth-asia me-2"></i>
            <span class="small-font">Add Location</span>
        </a>
    </div>


    <button id="addAccordionItemBtn">Add Accordion Item</button>


    <div class="row mb-3">
       
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('gen', this)">Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('more', this)">Next</button>
        </div>
    </div>
</div>

<!-- leaflet requirement -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>


    // Counter to keep track of the number of items added
    let accordionItemCount = 1;

    // Function to generate HTML for new accordion item
    function generateAccordionItem() {
        accordionItemCount++;

        return `
<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${accordionItemCount}" aria-expanded="true" aria-controls="collapse${accordionItemCount}">
            Accordion Item #${accordionItemCount}
        </button>
    </h2>
    <div id="collapse${accordionItemCount}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <!-- Inputs for Accordion Item #${accordionItemCount} -->
            <div class="col">
                <div class="row">
                    <!-- Province -->
                    <div class="col-6 mb-1">
                        <label for="" class="form-label small-font mb-0">Province</label>
                        <input type="text" class="form-control form-text small-font mt-0" value="" disabled>
                    </div>
                    <!-- municipality -->
                    <div class="col-6">
                        <label for="" class="form-label small-font mb-0">Municipality</label>
                        <input type="text" class="form-control form-text small-font mt-0" value="" disabled>
                    </div>
                    <!-- barangay -->
                    <div class="col-6">
                        <label for="" class="form-label small-font mb-0">Barangay</label>
                        <input type="text" class="form-control form-text small-font mt-0" value="" disabled>
                    </div>
                    <!-- Coordinates -->
                    <div class="col-6">
                        <label for="" class="form-label small-font mb-0">Coordinates</label>
                        <input type="text" class="form-control form-text small-font mt-0" value="" disabled>
                    </div>
                </div>
            </div>
            <!-- Actions for Accordion Item #${accordionItemCount} -->
            <div class="col-3">
                <!-- Edit Button -->
            </div>
        </div>
    </div>
</div>
`;
    }

    document.getElementById('addAccordionItemBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission

        console.log("Button clicked!"); // Log to console to verify the button click event

        var accordion = document.getElementById('accordionExample');
        var newAccordionItemHtml = generateAccordionItem();
        console.log("New accordion item HTML: ", newAccordionItemHtml); // Log the generated HTML for the new accordion item

        // Create a temporary div element to hold the generated HTML
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = newAccordionItemHtml;

        // Append the new accordion item to the accordion container
        accordion.innerHTML += tempDiv.innerHTML;
        console.log("Accordion HTML after appending: ", accordion.innerHTML); // Log the HTML content of the accordion container

        // Manually trigger the collapse initialization for the new accordion item
        var newAccordionItem = accordion.querySelector('.accordion-item:last-child');
        new bootstrap.Collapse(newAccordionItem.querySelector('.accordion-collapse'), {
            toggle: false
        });
    });
</script>