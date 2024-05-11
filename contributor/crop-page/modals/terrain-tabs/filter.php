<style>
    .hidden {
        display: none;
    }
</style>
<div class="col col-3">
    <div class="d-flex flex-column align-items-start rounded border overflow-hidden">

        <!-- title -->
        <div class="border-bottom d-flex align-items-center w-100 py-1 px-3 bg-light">
            <h6 class="fw-semibold fs-6 m-0 me-auto">FILTERS</h6>
            <!-- help -->
            <a href="#" class="">
                <i class="bi bi-question-circle"></i>
            </a>
        </div>

        <!-- filter actions -->
        <div class="d-flex py-3 px-3">
            <!-- search -->
            <div class="input-group">
                <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control small-font" placeholder="Search Terrain" aria-label="Search" aria-describedby="filter-search">
                <!-- Add a clear button -->
                <button id="clearButton" class="btn btn-secondary" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to show or hide the clear button based on selected filters and search input
    function toggleClearButtonVisibility() {
        let clearButton = document.getElementById('clearButton');
        let searchInput = document.getElementById('searchInput').value.trim();

        if (searchInput !== '') {
            // Show the clear button
            clearButton.classList.remove('hidden');
        } else {
            // Hide the clear button
            clearButton.classList.add('hidden');
        }
    }

    // Add event listener to search input
    document.getElementById('searchInput').addEventListener('input', toggleClearButtonVisibility);

    // Check if any filters or search input are already populated on page load
    toggleClearButtonVisibility();
</script>