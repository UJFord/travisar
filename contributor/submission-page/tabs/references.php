<!-- References -->
<div class="fade tab-pane" id="references-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">
    <!-- Links -->
    <h6 class="fw-semibold mt-4 mb-3">Links</h6>

    <div id="new-url-container" class="mb-4">
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="text-primary">
                <i class="fa-solid fa-circle-plus me-1"></i>
                <a href="javascript:void(0)" id="add-new-reference" class="link-underline-primary">New Reference</a>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('cultural', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
        </div>
    </div>
</div>

<script>
    let referenceNumbers = []; // Tracks all used reference numbers

    const newUrlContainer = document.getElementById('new-url-container');
    const addNewReference = document.getElementById('add-new-reference');

    addNewReference.addEventListener('click', function() {
        const urlListItem = document.createElement('div');
        urlListItem.classList.add('url-list-item-edit', 'mb-2');

        // Find the first unused reference number (avoiding duplicates)
        let referenceNumber = 1;
        while (referenceNumbers.includes(referenceNumber)) {
            referenceNumber++;
        }
        referenceNumbers.push(referenceNumber); // Track used number

        const inputWrapper = document.createElement('div');
        inputWrapper.classList.add('d-flex');

        // Description input
        // const descriptionInput = document.createElement('input');
        // descriptionInput.type = 'text';
        // descriptionInput.id = 'references-desc_' + referenceNumber;
        // descriptionInput.name = 'references_desc_' + referenceNumber;
        // descriptionInput.style = 'width: 30%;';
        // descriptionInput.classList.add('form-control', 'small-font', 'me-1', 'col-3', 'mb-2');
        // descriptionInput.placeholder = 'Title...';

        // Reference URL input
        const urlInput = document.createElement('input');
        urlInput.type = 'text';
        urlInput.id = 'references-id_' + referenceNumber;
        urlInput.name = 'references_' + referenceNumber;
        urlInput.classList.add('form-control', 'small-font');
        urlInput.placeholder = 'ex. https://www.google.com/';

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-link');
        removeButton.innerHTML = '<i class="fa-solid fa-circle-minus fs-5 text-danger"></i>';

        removeButton.addEventListener('click', function() {
            urlListItem.remove();
            renumberExistingReferences(); // Renumber remaining items after deletion
        });

        inputWrapper.appendChild(urlInput);
        inputWrapper.appendChild(removeButton);

        //urlListItem.appendChild(descriptionInput);
        urlListItem.appendChild(inputWrapper);

        // Error message div
        const errorMessage = document.createElement('div');
        errorMessage.id = `reference-error_${referenceNumber}`;
        errorMessage.classList.add('text-danger', 'small-font', 'mt-1');
        urlListItem.appendChild(errorMessage);

        newUrlContainer.appendChild(urlListItem);

        // Access the input after it's created
        const url_Input = document.getElementById('references-id_' + referenceNumber);

        url_Input.addEventListener('blur', function() {
            const url = url_Input.value.trim();
            const errorMessage = document.getElementById(`reference-error_${referenceNumber}`);
            if (isValidURL(url)) {
                // Valid URL
                errorMessage.textContent = ''; // Clear error message
            } else {
                // Invalid URL
                errorMessage.textContent = 'Invalid URL'; // Display error message
            }
        });
    });

    function renumberExistingReferences() {
        const existingReferences = newUrlContainer.querySelectorAll('.url-list-item');
        let currentNumber = 1;
        existingReferences.forEach((item, index) => {
            const itemLabel = item.querySelector('label');
            // Check if reference number needs update based on current index (sequence)
            if (referenceNumbers[index] !== currentNumber) {
                referenceNumbers[index] = currentNumber; // Update used numbers array
            }
            itemLabel.textContent = `Reference ${currentNumber}`;
            currentNumber++;
        });
    }

    function isValidURL(url) {
        // Regular expression for validating URL format
        const urlPattern = /^(https?:\/\/)?([\w\d-]+\.)+[\w\d]{2,}(\/.*)*$/i;
        return urlPattern.test(url);
    }
</script>