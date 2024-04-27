// FILTER MODAL
// open on load
// document.addEventListener("DOMContentLoaded", function() {
//     var myModal = new bootstrap.Modal(document.getElementById('filter-modal'));
//     myModal.show();
// });

// crop type
const cropButtons = document.querySelectorAll('.filter-crop-type');

cropButtons.forEach(button => {
    button.addEventListener('click', function() {
        const radioId = `crop_${this.textContent.toLowerCase()}`;
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
    
    // bindPopup
    let popup=`
        <div class="container">
            <h6 class="row d-flex justify-content-center fw-semibold">${variety}</h6>
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
                L.marker([lat, lng], {icon: icon})
                    .bindPopup(popup)
                    .addTo(map);
            } else {
                console.error(`Icon for category "${category}" is not defined.`);
            }
        }
    }
});

// make rows clickable
$(document).ready(function(){
    // Add click event to table rows
    $('#crop-list-tbody tr[data-href]').on("click", function() {
        // Get the URL from the data-href attribute
        var url = $(this).attr('data-href');
        // Navigate to the URL
        window.location = url;
    });
});



