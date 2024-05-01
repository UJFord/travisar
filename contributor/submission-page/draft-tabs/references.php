<!-- refernces -->
<div class="fade tab-pane" id="draft-references-tab-pane" role="tabpanel" aria-labelledby="draft-gen-tab" tabindex="0">
    <!-- Links -->
    <h6 class="fw-semibold mt-4 mb-3">Links</h6>

    <div id="new-url-containerDraft" class="mb-4">
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="text-primary">
                <i class="fa-solid fa-circle-plus me-1"></i>
                <a href="javascript:void(0)" id="add-new-referenceDraft" class="link-underline-primary">New Reference</a>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('draft-cultural', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
        </div>
    </div>
</div>

<script>
    let referenceNumbersDraft = []; // Tracks all used reference numbers

    const newUrlContainerDraft = document.getElementById('new-url-containerDraft');
    const addNewReferenceDraft = document.getElementById('add-new-referenceDraft');

    addNewReferenceDraft.addEventListener('click', function() {
        const urlListItem = document.createElement('div');
        urlListItem.classList.add('url-list-item-draft', 'mb-2');

        const label = document.createElement('label');
        label.classList.add('form-label', 'small-font');

        // Find the first unused reference number (avoiding duplicates)
        let referenceNumber = 1;
        while (referenceNumbersDraft.includes(referenceNumber)) {
            referenceNumber++;
        }
        referenceNumbersDraft.push(referenceNumber); // Track used number
        label.textContent = `Reference ${referenceNumber}`;

        const inputWrapper = document.createElement('div');
        inputWrapper.classList.add('d-flex');

        const urlInput = document.createElement('input');
        urlInput.type = 'text';
        urlInput.name = 'references_' + referenceNumber;
        urlInput.classList.add('form-control', 'small-font');
        urlInput.placeholder = 'ex. https://www.google.com/';

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-link');
        removeButton.innerHTML = '<i class="fa-solid fa-circle-minus fs-5 text-danger"></i>';

        removeButton.addEventListener('click', function() {
            urlListItem.remove();
            const removedNumber = parseInt(label.textContent.split(' ')[1]); // Extract reference number
            referenceNumbersDraft = referenceNumbersDraft.filter(num => num !== removedNumber); // Remove used number
            renumberExistingReferencesDraft(); // Renumber remaining items after deletion
        });

        inputWrapper.appendChild(urlInput);
        inputWrapper.appendChild(removeButton);

        urlListItem.appendChild(label);
        urlListItem.appendChild(inputWrapper);

        newUrlContainerDraft.appendChild(urlListItem);
    });

    function renumberExistingReferencesDraft() {
        const existingReferences = newUrlContainerDraft.querySelectorAll('.url-list-item');
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
</script>