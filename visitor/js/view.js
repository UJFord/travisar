// map center coordinates
let latOnLoad = 5.901882;
let lngOnLoad = 125.070641;
let zoomOnLoad = 10;
// set map center on load
let map = L.map('map').setView([latOnLoad, lngOnLoad], zoomOnLoad);

// draw map
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

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


// show icon
document.querySelector('.latlng-container').getAttrbute('latlng')