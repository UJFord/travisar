$(document).ready(function () {
    let mapState = false;
    let mapToggler = document.querySelector('#map-toggler');

    // get url parameters
    const urlParams = new URLSearchParams(window.location.search);
    // get value of map in url
    let toggleMap = urlParams.get('map') == 'open';

    // map toggle function
    let mapToggle = () => {
        mapState = !mapState;

        // toggle the map parameter
        if (mapState) {
            urlParams.set('map', 'open');
        } else {
            urlParams.set('map', 'close');
        }

        // Replace the current URL with the modified parameters
        window.history.replaceState({}, '', `${window.location.pathname}?${urlParams}`);

        $('#crop-list-map').toggleClass('d-none');

        // when map is toggled
        if (mapState) {
            $('#crop-list-table').addClass('d-none');
            $('#view-type-button .bi-list-ul').removeClass('d-none');
        } else {
            $('#crop-list-table').removeClass('d-none');
            $('#view-type-button .bi-grid-fill').addClass('d-none');
        }

        $('#map-toggler .list-toggle').toggleClass('d-none');
        $('#map-toggler .map-toggle').toggleClass('d-none');
        $('#view-type-button').toggleClass('d-none');

        // set category filters link "map" parameter to the map state
        let newMapValue = mapState ? 'open' : 'close';
        $('.bar-filter-categ').each(function () {
            let hrefValue = $(this).attr('href');
            hrefValue = hrefValue.replace(/(\?|&)map=[^&]*/, `$1map=${newMapValue}`);
            console.log(hrefValue);
            $(this).attr('href', hrefValue);
        });
    };

    // open map if url's map value is open
    if (toggleMap) {
        mapToggle();
    }

    // map or list toggler
    $(mapToggler).on("click", mapToggle);

    // LIST TABLE
    // make rows clickable
    // Add click event to table rows
    $('#crop-list-tbody tr[data-href]').on("click", function () {
        // Get the URL from the data-href attribute
        var url = $(this).attr('data-href');
        // Navigate to the URL
        window.location = url;
    });

    // map
    // map center coordinates
    let latOnLoad = 5.901882;
    let lngOnLoad = 125.070641;
    let zoomOnLoad = 10;
    // set map center on load
    let map = L.map('mapList').setView([latOnLoad, lngOnLoad], zoomOnLoad);

    // Add tile layer to the map
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        minZoom: 10,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    // Create a marker cluster group without spiderfyOnMaxZoom option
    let markers = L.markerClusterGroup();

    // Icons
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
            iconSize: [30, 30],
            iconAnchor: [20, 20],
        })
    };

    // Iterate over each table row and create markers
    document.querySelectorAll('#crop-list-tbody tr').forEach(row => {
        let category = row.querySelector('.category').textContent.trim();
        let variety = row.querySelector('.variety').textContent.trim();
        let viewLink = row.getAttribute('data-href');
        let popup = `
            <div class="container">
                <h6 class="row d-flex justify-content-center fw-semibold">${variety}</h6>
                <div class="row d-flex justify-content-center"><a class="small-font w-auto" href="${viewLink}">View Crop</a></div>
            </div>
        `;
        let latLng = row.getAttribute('latlng');
        if (latLng) {
            let [lat, lng] = latLng.split(',').map(coord => parseFloat(coord.trim()));
            if (!isNaN(lat) && !isNaN(lng)) {
                let icon = icons[category];
                if (icon) {
                    let marker = L.marker([lat, lng], { icon: icon }).bindPopup(popup);
                    markers.addLayer(marker);
                } else {
                    console.error(`Icon for category "${category}" is not defined.`);
                }
            }
        }
    });

    // Add marker cluster group to the map
    map.addLayer(markers);

    // Add an event listener to spiderfy clusters
    markers.on('clustermouseover', function(event) {
        event.layer.spiderfy();
    });

    // Ensure spiderfy is triggered on clusters after markers have been added
    setTimeout(function () {
        map.eachLayer(function (layer) {
            if (layer instanceof L.MarkerClusterGroup) {
                layer._featureGroup.eachLayer(function (cluster) {
                    if (cluster instanceof L.MarkerCluster) {
                        cluster.spiderfy();
                    }
                });
            }else{
                if (layer instanceof L.MarkerCluster) {
                layer.fire('mouseover');
            }
            }
        });
    }, 1000); // Adjust the delay time as needed


    // send resize event to browser to load map tiles
    setInterval(function () {
        window.dispatchEvent(new Event("resize"));
    }, 1000);
});
