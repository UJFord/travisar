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
                                    <label for="first_nameView" class="form-label"><strong>First Name:</strong></label>
                                    <h6 id="first_nameView"></h6>
                                </div>

                                <!-- last name -->
                                <div class="col-5">
                                    <label for="last_nameView" class="form-label"><strong>Last Name:</strong></label>
                                    <h6 id="last_nameView"></h6>
                                </div>
                            </div>

                            <!-- Gender, Email, and Affiliation name -->
                            <div class="row mb-3 location-brgy">
                                <!-- Gender -->
                                <div class="col">
                                    <label for="genderView" class="form-label"><strong>Gender:</strong></label>
                                    <h6 id="genderView"></h6>
                                </div>

                                <!-- Email -->
                                <div class="col">
                                    <label for="emailView" class="form-label"><strong>Email:</strong></label>
                                    <h6 id="emailView"></h6>
                                </div>

                                <!-- contact info -->
                                <div class="col">
                                    <label for="contact_numView" class="form-label"><strong>Contact Number:</strong></label>
                                    <h6 id="contact_numView"></h6>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Affiliation -->
                                <div class="col">
                                    <label for="affiliationView" class="form-label"><strong>Affiliation:</strong></label>
                                    <h6 id="affiliationView"></h6>
                                </div>

                                <!-- Affiliation email -->
                                <div class="col">
                                    <label for="affiliation_emailView" class="form-label"><strong>Affiliated Org Email:</strong></label>
                                    <h6 id="affiliation_emailView"></h6>
                                </div>

                                <!-- Affiliation contact number -->
                                <div class="col">
                                    <label for="affiliation_contact_numView" class="form-label"><strong>Affiliated Org Contact:</strong></label>
                                    <h6 id="affiliation_contact_numView"></h6>
                                </div>
                            </div>
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