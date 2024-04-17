
<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="view-item-modal-partners" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">View Contributor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="#" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">

                    <div class="container">
                        <div id="UserData">
                            <!-- First and Last name, gender -->
                            <div class="row mb-3 location-brgy">
                                <!-- first name -->
                                <div class="col-5">
                                    <label for="first_nameView" class="form-label small-font"><strong>First Name:</strong></label>
                                    <h6 id="first_nameView"></h6>
                                </div>

                                <!-- last name -->
                                <div class="col-5">
                                    <label for="last_nameView" class="form-label small-font"><strong>Last Name:</strong></label>
                                    <h6 id="last_nameView"></h6>
                                </div>
                            </div>

                            <!-- Gender, Email, and Affiliation name -->
                            <div class="row mb-3 location-brgy">
                                <!-- Gender -->
                                <div class="col-5">
                                    <label for="genderView" class="form-label small-font"><strong>Gender:</strong></label>
                                    <h6 id="genderView"></h6>
                                </div>

                                <!-- Email -->
                                <div class="col-5">
                                    <label for="emailView" class="form-label small-font"><strong>Email:</strong></label>
                                    <h6 id="emailView"></h6>
                                </div>
                            </div>
                            <!-- Affiliation -->
                            <div class="col-5">
                                <label for="affiliationView" class="form-label small-font"><strong>Affiliation:</strong></label>
                                <h6 id="affiliationView"></h6>
                            </div>
                        </div>

                        <div id="ContributedData">
                            <h2><Label>Contributed</Label></h2>

                            <table id="" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col text-dark-emphasis small-font" scope="col">Crop ID</th>
                                        <th class="col-4 text-dark-emphasis small-font" scope="col">Variety Name</th>
                                        <th class="col-4 text-dark-emphasis small-font" scope="col">Crop unique ID</th>
                                        <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider fw-bold overflow-scroll" id="ContributedData">
                                    <!-- data for the contributed crops here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <!-- <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="save" onclick="validateAndSubmitForm()" class="btn btn-success">Save</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                </div> -->
            </form>
        </div>
    </div>
</div>