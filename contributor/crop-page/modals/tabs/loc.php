<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<!-- LOCATION TAB -->
<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row">
        <!-- form -->
        <div class="col-6 border">
            <!-- Municipality and province -->
            <div class="row">
                <!-- Province -->
                <div class="col-6">
                    <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
                    <input id="Province" type="text" class="form-control" placeholder="Ex. South Cotabato">
                </div>
                <!-- Municipality -->
                <div class="col-6">
                    <label for="Municipality" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
                    <input id="Municipality" type="text" class="form-control" placeholder="Ex. Glan">
                </div>
            </div>

            <!-- latitude and longitude -->
            <div class="row">
                <!-- Latitude -->
                <div class="col-6">
                    <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
                    <input id="Province" type="text" class="form-control" placeholder="Ex. South Cotabato">
                </div>
                <!-- longitude -->
                <div class="col-6">
                    <label for="Municipality" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
                    <input id="Municipality" type="text" class="form-control" placeholder="Ex. Glan">
                </div>
            </div>
        </div>
        <!-- map -->
        <div id="map" class="col border">
        </div>
    </div>
</div>

<!-- STYLES -->
<style>
    #map {
        height: 400px;
    }
</style>

<!-- leaflet requirement -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script defer>
    // initialize the map on the "map" div with a given center and zoom
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>