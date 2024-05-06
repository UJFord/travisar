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

// Fetch GeoJSON data from GitHub
fetch('https://raw.githubusercontent.com/rukku/ph-province-boundaries/master/PH-SAR/SARANGANI.geojson')
.then(response => response.json())
.then(data => {
    // Create a GeoJSON layer and add it to the map
    L.geoJSON(data).addTo(map);
})
.catch(error => {
    console.error('Error fetching GeoJSON:', error);
});

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
    "Root Crop": L.icon({
        iconUrl: 'img/carrot-svgrepo-com.svg',
        iconSize: [40, 40],
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