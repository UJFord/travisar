<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>
<!-- <style>
    #map {
        aspect-ratio: 1/1;
    }
</style> -->

<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row">

        <div class="col-6 border">

        </div>

        <div id="map" class="col border rounded">
        </div>
    </div>

</div>

<script>
    const key = 'nEVXtMGf5Q4NUT81g14m';
    const map = L.map('map').setView([6.1536, 124.993086], 9); //starting position
    L.tileLayer(`https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=${key}`, { //style URL
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        crossOrigin: true
    }).addTo(map);
</script>