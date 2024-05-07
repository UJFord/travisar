// LIST
$(document).ready(function () {

    let mapState = false;
    let mapToggler = document.querySelector('#map-toggler');

    // map or list toggler
    $(mapToggler).on("click", function()
    {
        mapState = !mapState;
        $('#crop-list-map').toggleClass('d-none');

        $('#crop-list-grid').addClass('d-none');

        // when map is toggled
        if(mapState){
            $('#crop-list-table').addClass('d-none');

            $('#view-type-button .bi-list-ul').removeClass('d-none')
        }else{
            $('#crop-list-table').removeClass('d-none');

            $('#view-type-button .bi-grid-fill').addClass('d-none');

        }

        $('#map-toggler .list-toggle').toggleClass('d-none');
        $('#map-toggler .map-toggle').toggleClass('d-none');

        $('#view-type-button').toggleClass('d-none');
    });


    // LIST TABLE
    // make rows clickable
    // Add click event to table rows
    $('#crop-list-tbody tr[data-href]').on("click", function () {
        // Get the URL from the data-href attribute
        var url = $(this).attr('data-href');
        // Navigate to the URL
        window.location = url;
    });

    // make grids clickable
    // Add click event to grids
    $('#crop-list-grid .card-container .card[data-href]').on("click", function () {
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
        "Root": L.icon({
            iconUrl: 'img/carrot-circle.png',
            iconSize: [30, 30],
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
        let address = row.querySelector('.addr').textContent.trim();
        let terrain = row.querySelector('.terrain').textContent.trim();
        let viewLink = row.getAttribute('data-href');

        // GRID
        //  transfer values from list to grid
        let cardElement = `
            <div class="card-container col-3 px-2 pb-2">
                <div class="card" data-href="${viewLink}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-truncate">${variety}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">${terrain}</h6>
                        <p class="card-text small-font text-truncate">${address}</p>
                    </div>
                </div>
            </div>
        `;
        // add cardElement
        $('#crop-list-grid').append(cardElement);
        

        // MAP SCRIPTS

        // bindPopup
        let popup = `
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
                    L.marker([lat, lng], { icon: icon })
                        .bindPopup(popup)
                        .addTo(map);
                } else {
                    console.error(`Icon for category "${category}" is not defined.`);
                }
            }
        }
    });

    // send resize event to browser to load map tiles
    setInterval(function() {
        window.dispatchEvent(new Event("resize"));
    }, 1000);
});