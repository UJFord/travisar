// FILTER MODAL
// open on load
// document.addEventListener("DOMContentLoaded", function() {
//     var myModal = new bootstrap.Modal(document.getElementById('filter-modal'));
//     myModal.show();
// });

// crop type
const cropButtons = document.querySelectorAll('.filter-crop-type');

cropButtons.forEach(button => {
    button.addEventListener('click', function () {
        const radioId = this.getAttribute('for');
        const radio = document.getElementById(radioId);
        radio.checked = true;

        // Update button styles based on selection
        cropButtons.forEach(otherButton => {
            otherButton.classList.remove('bg-dark');
            otherButton.classList.add('bg-white');
            otherButton.classList.remove('text-light');
            otherButton.classList.add('text-dark');
        });
        this.classList.remove('bg-white');
        this.classList.add('bg-dark');
        this.classList.remove('text-dark');
        this.classList.add('text-light');
    });
});

// Function to fetch and populate the barangay filter based on the selected category
function populateBarangayFilter(municipalityid) {
    let barangayFilter = document.getElementById('brgy-filters');
    if (municipalityid !== '') {
        // Fetch varieties based on the selected category using AJAX
        fetch('fetch/fetch_filter-brgy.php?municipality_id=' + municipalityid)
            .then(response => response.json())
            .then(data => {
                // Clear existing options
                barangayFilter.innerHTML = '';
                // Populate options
                data.forEach(barangay => {
                    barangayFilter.innerHTML += `
                            <div class="collapse show w-100 mb-2">
                                <input class="form-check-input brgy-filter" type="checkbox" id="barangay${barangay.barangay_id}" value="${barangay.barangay_id}">
                                <label for="barangay${barangay.barangay_id}">${barangay.barangay_name}</label>
                            </div>
                        `;
                });
                // Show the barangay filter
                barangayFilter.classList.add('show');
            })
            .catch(error => console.error('Error:', error));
    } else {
        // Hide the barangay filter if no category is selected
        barangayFilter.classList.remove('show');
    }
}
// Add event listeners to category checkboxes
document.querySelectorAll('.municipality-filter').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            populateBarangayFilter(this.value);
        }
    });
});

// Function to apply filters and update the table
function applyFilters() {
    let searchCondition = ''; // Initialize searchCondition here

    const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
    const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);
    const selectedVarieties = Array.from(document.querySelectorAll('.variety-filter:checked')).map(checkbox => checkbox.value);
    const selectedTerrain = Array.from(document.querySelectorAll('.terrain-filter:checked')).map(checkbox => checkbox.value);
    const selectedBrgy = Array.from(document.querySelectorAll('.brgy-filter:checked')).map(checkbox => checkbox.value);
    const selectedPest = Array.from(document.querySelectorAll('.pest-filter:checked')).map(checkbox => checkbox.value);
    const selectedDisease = Array.from(document.querySelectorAll('.disease-filter:checked')).map(checkbox => checkbox.value);
    const selectedAbiotic = Array.from(document.querySelectorAll('.abiotic-filter:checked')).map(checkbox => checkbox.value);

    // Build the search condition based on selected categories, municipalities, and the search value
    if (selectedCategories.length > 0) {
        searchCondition += `&categories=${selectedCategories.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedMunicipalities.length > 0) {
        searchCondition += `&municipalities=${selectedMunicipalities.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedVarieties.length > 0) {
        searchCondition += `&varieties=${selectedVarieties.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedTerrain.length > 0) {
        searchCondition += `&terrains=${selectedTerrain.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedBrgy.length > 0) {
        searchCondition += `&barangay=${selectedBrgy.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedPest.length > 0) {
        searchCondition += `&pest=${selectedPest.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedDisease.length > 0) {
        searchCondition += `&disease=${selectedDisease.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }
    if (selectedAbiotic.length > 0) {
        searchCondition += `&abiotic=${selectedAbiotic.join(',')}`;
        console.log(searchCondition);
        console.log('Filter applied');
    }

    // Reload the table with the new filters
    window.location.href = window.location.pathname + '?search=' + searchCondition;
}
// Modify the search function to store the search query in a session or URL parameter
function search() {
    var searchInput = document.getElementById("searchInput").value;
    // Store the search query in a session or URL parameter
    // For example, you can use localStorage to store the search query
    localStorage.setItem('searchQuery', searchInput);
    // Reload the page with the search query as a parameter
    window.location.href = window.location.pathname + "?search=" + searchInput;
}

const searchInput = document.getElementById('searchInput');
const clearButton = document.getElementById('clearButton');

// Add a keyup event listener to the search input field
searchInput.addEventListener('keyup', function (event) {
    // Check if the Enter key is pressed (key code 13)
    if (event.keyCode === 13) {
        // Call the search function
        search();
    }
});
// Function to clear the search and hide the clear button
function clearSearch() {
    searchInput.value = '';
    window.location.href = window.location.pathname;
}

// MAP

// map center coordinates
let latOnLoad = 5.901882;
let lngOnLoad = 125.070641;
let zoomOnLoad = 10;
// set map center on load
let map = L.map('map').setView([latOnLoad, lngOnLoad], zoomOnLoad);

// icons
let icons = {
    "Corn": L.icon({
        iconUrl: 'img/corn-svgrepo-com.svg',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
    }),
    "Rice": L.icon({
        iconUrl: 'img/rice-grain-svgrepo-com.svg',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
    }),
    "Root": L.icon({
        iconUrl: 'img/carrot-svgrepo-com.svg',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
    })
};


// draw map
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

// draw markers
// loop through each table row and draw markers
// Iterate over each table row
document.querySelectorAll('#crop-list-tbody tr').forEach(row => {
    // Extract category and variety
    let category = row.querySelector('.category').textContent.trim();
    let variety = row.querySelector('.variety').textContent.trim();
    let viewLink = row.getAttribute('data-href');
    let date_created = row.querySelector('.date_created').value.trim();

    // bindPopup
    let popup = `
        <div class="container">
            <h6 class="row d-flex justify-content-center fw-semibold">${variety}</h6>
            <h6 class="row d-flex justify-content-center fw-semibold">${date_created}</h6>
            <div class="row d-flex justify-content-end"><a class="small-font w-auto" href="${viewLink}">See More...</a></div>
        </div>
    `;

    // Extract latitude and longitude from latlng attribute
    let latLng = row.getAttribute('latlng');
    if (latLng) {
        let [lat, lng] = latLng.split(',').map(coord => parseFloat(coord.trim()));

        // Check if latitude and longitude values are valid
        if (!isNaN(lat) && !isNaN(lng)) {
            // Choose icon based on category
            let icon = icons[category];

            // Create marker and add to map
            if (icon) {
                L.marker([lat, lng], { icon: icon })
                    .bindPopup(popup)
                    .addTo(map);
            } else {
                console.error(`Icon for category "${category}" is not defined.`);
            }
        }
    }
});

// make rows clickable
$(document).ready(function () {
    // Add click event to table rows
    $('#crop-list-tbody tr[data-href]').on("click", function () {
        // Get the URL from the data-href attribute
        var url = $(this).attr('data-href');
        // Navigate to the URL
        window.location = url;
    });
});



