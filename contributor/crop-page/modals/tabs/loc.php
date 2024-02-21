<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>

<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row">

        <div class="col-6 ">

        </div>

        <div id="map" class="col rounded">
        </div>
    </div>

</div>

<script>
    // map tiler api key
    // const key = 'nEVXtMGf5Q4NUT81g14m';
    const map = L.map('map').setView([6.1536, 124.953086], 10); //starting position
    L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
        tileSize: 512,
        maxZoom: 16,
        zoomOffset: -1,
        minZoom: 10,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        crossOrigin: true
    }).addTo(map);
</script>