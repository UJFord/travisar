// map center coordinates
let latOnLoad = 5.901882;
let lngOnLoad = 125.070641;
let zoomOnLoad = 10;
// set map center on load
let map = L.map('map').setView([latOnLoad, lngOnLoad], zoomOnLoad);

// draw map
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    minZoom: 9,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

// icons
let icons = {
        "Corn": L.icon({
            iconUrl: 'img/corn-circle.png',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
        }),
        "Rice": L.icon({
            iconUrl: 'img/rice-circle.png',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
        }),
        "Root Crop": L.icon({
            iconUrl: 'img/carrot-circle.png',
            // iconUrl: 'img/kiamba.jpg',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
        })
    };


// show icon
let latlng = document.querySelector('.latlng-container').getAttribute('latlng');
let categ = document.querySelector('#crop-categ').innerText;
let addr = document.querySelector('#addr').innerText;

if (latlng) {
    let [lat, lng] = latlng.split(',').map(coord => parseFloat(coord.trim()));

    // Check if latitude and longitude values are valid
    if (!isNaN(lat) && !isNaN(lng)) {
        // Choose icon based on category
        let icon = icons[categ];

        // Create marker and add to map
        if (icon) {
            L.marker([lat, lng], { icon: icon })
                .bindPopup(addr)
                .addTo(map);
        } else {
            console.error(`Icon for category "${category}" is not defined.`);
        }
    }
}

// IMAGE MODAL HANDLING
    document.querySelectorAll('.view-crop-image').forEach(function(image) {
        image.addEventListener('click', function() {
            var fullsizeImageUrl = this.src; // Get the source of the clicked image
            var modalImage = document.getElementById('modalImage');
            modalImage.src = fullsizeImageUrl;
            $('#imageModal').modal('show');
        });
    });

    // Initialize panzoom on the modal image when the modal is shown
    var panzoomInstance;
    $('#imageModal').on('shown.bs.modal', function () {
        var modalImage = document.getElementById('modalImage');
        panzoomInstance = Panzoom(modalImage, {
            maxScale: 5,
            minScale: 1,
            contain: 'outside'
        });

        modalImage.addEventListener('wheel', panzoomInstance.zoomWithWheel);

        // Add double-click event for zooming
        modalImage.addEventListener('dblclick', function(event) {
            // Check the current scale
            var currentScale = panzoomInstance.getScale();
            // Determine the new scale
            var newScale = currentScale === 1 ? 2 : 1; // Toggle between 1 and 2
            panzoomInstance.zoomToPoint(newScale, { clientX: event.clientX, clientY: event.clientY });
        });
    });

    // Optional: Reset panzoom when the modal is hidden
    $('#imageModal').on('hidden.bs.modal', function () {
        if (panzoomInstance) {
            panzoomInstance.destroy();
            panzoomInstance = null;
        }
    });