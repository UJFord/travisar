<!-- LIST -->
<div class="col border">
    <div class="continer">
        <!-- heading -->
        <div class="d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">All Crops</h4>
            <!-- add button -->
            <div class="z-1 dropdown">
                <!-- dropdown -->
                <button id="add-crop-btn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    New
                </button>
                <!-- list -->
                <ul class="dropdown-menu dropdown-menu-end p-0">
                    <!-- add item -->
                    <li class="p-0">
                        <button type="button" class="dropdown-item p-2" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                            <i class="fa-solid fa-file-circle-plus me-2"></i>Item
                        </button>

                    </li>
                </ul>
            </div>
        </div>


        <!-- table -->
        <table class="table table-hover">
            <!-- table head -->
            <thead>
                <tr>
                    <th class="col-1 thead-item" scope="col">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label text-dark-emphasis small-font">
                            All
                        </label>
                    </th>
                    <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                    <th class="col-4 text-dark-emphasis small-font" scope="col">Contributor</th>
                    <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>

                </tr>
            </thead>
            <!-- table body -->
            <tbody class="table-group-divider fw-bold overflow-scroll">
                <tr id="row1" data-target="#dataModal" data-name="Malgas" data-type="Corn" data-contributor="Alex Miller">
                    <!-- checkbox -->
                    <th scope="row"><input class="form-check-input" type="checkbox"></th>
                    <td>
                        <!-- scientific name -->
                        <a href="">Malgas</a>
                        <!-- crop type -->
                        <h6 class="text-secondary small-font m-0">Corn</h6>
                    </td>
                    <!-- contributor -->
                    <td class="small-font"><span class="py-1 px-2 rounded indiv">Alex Miller</span></td>
                    <!-- ellipsis menu butn -->
                    <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                </tr>
                <tr id="row2" data-target="#dataModal" data-name="Lagfisan" data-type="Rice" data-contributor="TechStar">
                    <th scope="row"><input class="form-check-input" type="checkbox"></th>
                    <td>
                        <!-- scientific name -->
                        <a href="">Lagfisan</a>
                        <!-- crop type -->
                        <h6 class="text-secondary small-font m-0">Rice</h6>
                    </td>
                    <td class="small-font"><span class="py-1 px-2 rounded org">TechStar</span></td>
                    <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                </tr>
                <tr id="row3" data-target="#dataModal" data-name="Moradu" data-type="Rice" data-contributor="Ethan Campbell">
                    <th scope="row"><input class="form-check-input" type="checkbox"></th>
                    <td>
                        <!-- scientific name -->
                        <a href="">Moradu</a>
                        <!-- crop type -->
                        <h6 class="text-secondary small-font m-0">Rice</h6>
                    </td>
                    <td class="small-font"><span class="py-1 px-2 rounded indiv">Ethan Campbell</span></td>
                    <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                </tr>
                <tr>
                    <th scope="row"><input class="form-check-input" type="checkbox"></th>
                    <td>
                        <!-- scientific name -->
                        <a href="">Masipag</a>
                        <!-- crop type -->
                        <h6 class="text-secondary small-font m-0">Kamote</h6>
                    </td>
                    <td class="small-font"><span class="py-1 px-2 rounded self">Me</span></td>
                    <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>