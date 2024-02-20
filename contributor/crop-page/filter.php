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
                <input type="text" class="form-control" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
            </div>
        </div>

        <!-- all crops -->
        <div class="py-2 px-3 w-100 border-bottom">
            <div id="crop-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#crop-filters" role="button" aria-expanded="true" aria-controls="crop-filters">
                <i id="cropChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">All Item</a>
            </div>

            <!-- crops filters -->
            <div id="crop-filters" class="collapse show w-100 mb-2">
                <!-- rice -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-bowl-rice col-1"></i><span class="fw-normal col ms-2">Rice</span>
                </a>
                <!-- root -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-carrot col-1"></i><span class="fw-normal col ms-2">Root</span>
                </a>
                <!-- other -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-brands fa-pagelines col-1"></i><span class="fw-normal col ms-2">Other</span>
                </a>
            </div>
        </div>

        <!-- all municipalities -->
        <div class="pt-2 pb-1 px-3 w-100">
            <div id="mun-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#municipality-filters" role="button" aria-expanded="true" aria-controls="municipalty-filters">
                <i id="munChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">All Municipalities</a>
            </div>

            <!-- municipality filters -->
            <div id="municipality-filters" class="collapse show w-100 mb-2">
                <!-- alabel -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Alabel</span>
                </a>
                <!-- glan -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Glan</span>
                </a>
                <!-- kiamba -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Kiamba</span>
                </a>
                <!-- maasim -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Maasim</span>
                </a>
                <!-- maitum -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Maitum</span>
                </a>
                <!-- malapatan -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Malapatan</span>
                </a>
                <!-- malungon -->
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-location-dot col-1"></i><span class="fw-normal col ms-2">Malungon</span>
                </a>
            </div>
        </div>

        <!-- all contributors -->
        <div class="pb-2 px-3 w-100">
            <div id="cont-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#contributor-filters" role="button" aria-expanded="true" aria-controls="contributor-filters">
                <i id="contChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">All Contributors</a>
            </div>

            <!-- crops filters -->
            <div id="contributor-filters" class="collapse show mb-2">
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-user col-1" style="padding-left: 0.9rem;"></i><span class="fw-normal col ms-2">Alex Miller</span>
                </a>
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-users col-1"></i><span class="fw-normal col ms-2">TechStar</span>
                </a>
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-user col-1" style="padding-left: 0.9rem;"></i><span class="fw-normal col ms-2">Ethan Campbell</span>
                </a>
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-user col-1" style="padding-left: 0.9rem;"></i><span class="fw-normal col ms-2">Michael Jones</span>
                </a>
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-users col-1"></i><span class="fw-normal col ms-2">Greenleaf Solutions</span>
                </a>
                <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                    <i class="fa-solid fa-users col-1"></i><span class="fw-normal col ms-2">Cozy Corner Cafe</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
    // chevron toggler
    let cropToggler = document.querySelector('#crop-filter-dropdown-toggler');
    let munToggler = document.querySelector('#mun-filter-dropdown-toggler');
    let contToggler = document.querySelector('#cont-filter-dropdown-toggler');



    let cropChev = document.querySelector('#cropChev');
    let munChev = document.querySelector('#munChev');
    let contChev = document.querySelector('#contChev');

    function toggleChevron(element) {
        element.classList.toggle('rotate-chevron');
    }

    cropToggler.onclick = () => toggleChevron(cropChev);
    munToggler.onclick = () => toggleChevron(munChev);
    contToggler.onclick = () => toggleChevron(contChev);
</script>