<!-- leaflet required -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- STYLE -->
<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>

<!-- HTML -->
<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row">

        <!-- form -->
        <div class="col-6">

            <!-- coordinates -->
            <label for="" class="form-label small-font mb-0">Coordinates</label>
            <input type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text" style="font-size: 0.6rem;">Seperate latitude and longitude with a comma ( , )</div>

            <!-- street -->
            <label for="" class="form-label small-font mb-0">Street</label>
            <input type="text" class="form-control">

            <!-- barangay -->
            <label for="" class="form-label small-font mb-0">Barangay</label>
            <select name="" id="" class="form-select">
                <option value=""></option>
                <option value="">Alegria</option>
                <option value="">Baluntay</option>
                <option value="">Bagacay</option>
                <option value="">Concepcion</option>
                <option value="">Datal Anggas</option>
                <option value="">Domolok</option>
                <option value="">Glanville</option>
                <option value="">Kawas</option>
                <option value="">Ladol</option>
                <option value="">Mabini</option>
                <option value="">Maribulan</option>
                <option value="">New Glamorgan</option>
                <option value="">Pag-asa</option>
                <option value="">Paraiso</option>
                <option value="">Poblacion</option>
                <option value="">Spring</option>
                <option value="">Tokawal</option>
            </select>

            <!-- Municipality -->
            <label for="" class="form-label small-font mb-0">Municipality</label>
            <select name="" id="" class="form-select">
                <option value=""></option>
                <option value="">Alabel</option>
                <option value="">Glan</option>
                <option value="">Kiamba</option>
                <option value="">Maasim</option>
                <option value="">Maitum</option>
                <option value="">Malapatan</option>
                <option value="">Malungon</option>
            </select>

            <!-- Province -->
            <label for="" class="form-label small-font mb-0">Province</label>
            <input type="text" class="form-control" value="Sarangani" readonly>
        </div>

        <!-- map -->
        <div id="map" class="col rounded">
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    const map = L.map('map').setView([6.1536, 124.953086], 9); //starting position
    L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
        tileSize: 512,
        maxZoom: 16,
        zoomOffset: -1,
        minZoom: 9,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        crossOrigin: true
    }).addTo(map);
</script>