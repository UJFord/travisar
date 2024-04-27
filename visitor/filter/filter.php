<div class="container-fluid border-bottom d-flex justify-content-center p-3">
    <!-- search -->
    <div class="input-group w-25 me-4">
        <input type="text" class="form-control bg-light">
        <button id="search-btn" class="input-group-text btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <!-- filter -->
    <!-- filter trigger -->
    <button id="filter-trigger" type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#filter-modal">
        <i class="fa-solid fa-sliders small-font me-2"></i>Filter
    </button>

    <!-- filter modal -->
    <div id="filter-modal" class="modal fade" tabindex="-1" aria-labelledby="filter-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- head -->
                <div class="modal-header d-flex justify-content-center position-relative">
                    <h1 class="modal-title small-font fw-bold" id="exampleModalLabel">FILTERS</h1>
                    <button id="close-filter-btn" type="button" class="btn-close position-absolute small-font" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- content -->
                <div class="modal-body">

                    <!-- crop type -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Crop Type</h5>
                        <div class="d-flex justify-content-center mb-2">
                            <div class="rounded d-flex flex-row overflow-hidden border">
                                <input type="radio" name="crop_type" id="crop_corn" class="d-none">
                                <label for="crop_corn" class="filter-crop-type bg-dark bg-gradient text-light fw-semibold py-3 px-5 border-0">Corn</label>

                                <input type="radio" name="crop_type" id="crop_rice" class="d-none">
                                <label for="crop_rice" class="filter-crop-type bg-white bg-gradient text-dark fw-semibold py-3 px-5 border border-top-0 border-bottom-0">Rice</label>

                                <input type="radio" name="crop_type" id="crop_other" class="d-none">
                                <label for="crop_other" class="filter-crop-type bg-white bg-gradient text-dark fw-semibold py-3 px-5 border-0">Other</label>
                            </div>
                        </div>
                    </div>


                    <!-- municipality -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Location</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- alabel -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Alabel</label>
                                </div>
                                <!-- Malapatan -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Malapatan</label>
                                </div>
                                <!-- Glan -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Glan</label>
                                </div>
                                <!-- Kiamba -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Kiamba</label>
                                </div>
                                <!-- Malungon -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Malungon</label>
                                </div>
                                <!-- Maasim -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Maasim</label>
                                </div>
                                <!-- Maitum -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Maitum</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terrain -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Terrain</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Flat -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Flat</label>
                                </div>
                                <!-- Hillside -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Hillside</label>
                                </div>
                                <!-- Rolling -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Rolling</label>
                                </div>
                                <!-- Sloping -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Sloping</label>
                                </div>
                                <!-- Steep -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Steep</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- barangay -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Barangay</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Alegria -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Alegria</label>
                                </div>
                                <!-- Bagacay -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Bagacay</label>
                                </div>
                                <!-- Baluntay -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Baluntay</label>
                                </div>
                                <!-- Datak Angas -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Datak Angas</label>
                                </div>
                                <!-- Domolok -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Domolok</label>
                                </div>
                                <!-- Kawas -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Kawas</label>
                                </div>
                                <!-- Ladol -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Ladol</label>
                                </div>
                                <!-- Maribulan -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Maribulan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pest resistance -->
                    <div class="container border-bottom pb-w mb-4">
                        <h5 class="filter-title">Pest Resistance</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Ants -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Ants</label>
                                </div>
                                <!-- Army Worms -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Army Worms</label>
                                </div>
                                <!-- Birds -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Birds</label>
                                </div>
                                <!-- Black Bugs -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Black Bugs</label>
                                </div>
                                <!-- Borers -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Borers</label>
                                </div>
                                <!-- Cut Worms -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Cut Worms</label>
                                </div>
                                <!-- Earthworms -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Earthworms</label>
                                </div>
                                <!-- Flea Beetles -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Flea Beetles</label>
                                </div>
                                <!-- Hoppers -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Hoppers</label>
                                </div>
                                <!-- Leaf Aphids -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Leaf Aphids</label>
                                </div>
                                <!-- Leaf Folder -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Leaf Folder</label>
                                </div>
                                <!-- Rats -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Rats</label>
                                </div>
                                <!-- Root-knot Nematodes -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Root-knot Nematodes</label>
                                </div>
                                <!-- Root Aphids -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Root Aphids</label>
                                </div>
                                <!-- Snails -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Snails</label>
                                </div>
                                <!-- Spider Mites -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Spider Mites</label>
                                </div>
                                <!-- Stink Bug -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Stink Bug</label>
                                </div>
                                <!-- Termites -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Termites</label>
                                </div>
                                <!-- Weevils -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Weevils</label>
                                </div>
                                <!-- White Grubs -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">White Grubs</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- disease ressistance -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Disease Resistance</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Bacterial -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Bacterial</label>
                                </div>
                                <!-- Fungus -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Fungus</label>
                                </div>
                                <!-- Viral -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Viral</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- resistance to abiotic stress -->
                    <div class="container pb-2">
                        <h5 class="filter-title">Resistance to Abiotic Stress</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Drought -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Drought</label>
                                </div>
                                <!-- Harmful Radiation -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Harmful Radiation</label>
                                </div>
                                <!-- Heat -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Heat</label>
                                </div>
                                <!-- Salinty -->
                                <div class="form-check mb-2 w-25">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label">Salinty</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- actions -->
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn border btn-light bg-gradient">Clear All</button>
                    <button type="button" class="btn btn-success bg-gradient">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
</div>