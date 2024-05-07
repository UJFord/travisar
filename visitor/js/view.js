// map center coordinates
let latOnLoad = 5.901882;
let lngOnLoad = 125.070641;
let zoomOnLoad = 9;
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
            shadowUrl: 'img/marker-shadow.png',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
            shadowSize: [30, 30],
            shadowAnchor:[30, 30],
        }),
        "Rice": L.icon({
            iconUrl: 'img/rice-circle.png',
            shadowUrl: 'img/marker-shadow.png',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
            shadowSize: [30, 30],
            shadowAnchor:[30, 30],
        }),
        "Root": L.icon({
            iconUrl: 'img/carrot-circle.png',
            shadowUrl: 'img/marker-shadow.png',
            iconSize: [30, 30],
            iconAnchor: [20, 20],
            shadowSize: [30, 30],
            shadowAnchor:[30, 30],
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