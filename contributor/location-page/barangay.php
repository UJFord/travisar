<?php
session_start();
require "../../functions/connections.php";
require "../../functions/functions.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="../../visitor/img/travis-light.svg">

    <!-- title -->
    <title>Travisar</title>

    <!-- STYLESHEETS -->

    <!-- leaflet -->

    <!-- bootstrap -->
    <!-- stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- custom -->

    <!-- global declarations -->
    <link rel="stylesheet" href="../../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="../css/crop-list.css">

    <!-- script for access control -->
    <script src="../../js/access-control.js"></script>
    <!-- script for the window alert -->
    <script src="../../js/window.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>
    <!-- NAV -->
    <?php require "../../nav/nav.php"; ?>

    <?php
    include "../../functions/message.php";
    ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">
            <!-- CSS -->
            <style>
                /* CSS for tabs */
                .tab_box {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-bottom: 2px solid rgba(229, 229, 229);
                    position: relative;
                }

                .tab_box .tab_btn {
                    font-size: 18px;
                    font-weight: 600;
                    color: #919191;
                    background: none;
                    border: none;
                    padding: 18px;
                }

                .add-loc-btn {
                    background: var(--mainBrand);
                    border: none;
                }

                #addBarangay {
                    margin-right: 9vh;
                }
            </style>
            <?php require "modals/brgy-filter.php" ?>
            <!-- LIST -->
            <div class="container col" style="min-height: 615px; max-height:615px;">

                <!-- HEADING -->
                <div class="tab_box d-flex justify-content-between pb-2">
                    <!-- title -->
                    <h4 class="fw-semibold" style="font-size: 1.5rem;">Barangay List</h4>
                    <th class="col text-center">
                        <!-- add button -->
                        <button type=" button" id="addBarangay" class="btn btn-secondary add-loc-btn p-2 btn  m-0" name="addBarangay" data-bs-toggle="modal" data-bs-target="#add-item-modal-brgy">
                            Add New
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </th>
                </div>

                <?php
                // Set the number of items to display per page
                $items_per_page = 10;

                // Get the current page number
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the offset based on the current page and items per page
                $offset = ($current_page - 1) * $items_per_page;

                // Count the total number of rows for pagination for pending crops
                $total_rows_query_barangay = "SELECT COUNT(*) FROM barangay";
                $total_rows_result_barangay = pg_query($conn, $total_rows_query_barangay);
                $total_rows_barangay = pg_fetch_row($total_rows_result_barangay)[0];

                // Calculate the total number of pages for pending crops
                $total_pages_barangay = ceil($total_rows_barangay / $items_per_page);

                // Get the search query from the session or URL parameter
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $search_condition = $search ? "AND (barangay_name ILIKE '%$search%' OR municipality_name ILIKE '%$search%')" : '';

                // municipality filter
                $municipality_filter = !empty($_GET['municipalities']) ? "AND municipality.municipality_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';

                ?>

                <!-- dib ni sya para ma set ang mga tabs na data -->
                <div class="general_info">
                    <!-- barangay Tab Unactive -->
                    <div class="gen_info" id="barangayTabData" style="max-height: 500px; overflow-y: auto;">
                        <!-- TABLE -->
                        <table id="barangayTable" class="table table-hover">
                            <!-- table head -->
                            <thead>
                                <tr>
                                    <th class="col-1 thead-item" scope="col">
                                        <input class="row-checkbox form-check-input small-font" type="checkbox" id="checkAll">
                                        <label class="form-check-label text-dark-emphasis small-font">
                                            All
                                        </label>
                                    </th>
                                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="municipality">Municipality</th>
                                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="barangay">Barangay</th>
                                    <th class="col-3 text-dark-emphasis text-center small-font" scope="col" data-sort="date">Date Added</th>
                                    <th class="col-3 text-dark-emphasis text-center small-font admin-only" scope="col">Action</th>
                                    <!-- <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th> -->
                                </tr>
                            </thead>

                            <!-- table body -->
                            <tbody class="table-group-divider fw-bold overflow-scroll">
                                <?php
                                $query_barangay = "SELECT * FROM barangay left join municipality on municipality.municipality_id = barangay.municipality_id 
                                where 1=1 $search_condition $municipality_filter
                                ORDER BY barangay_id DESC LIMIT $items_per_page OFFSET $offset";
                                $query_run_barangay = pg_query($conn, $query_barangay);

                                if ($query_run_barangay) {
                                    while ($row = pg_fetch_array($query_run_barangay)) {
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($row['barangay_date']);
                                        // Format the date to display up to the minute
                                        $formatted_date = $date->format('m-d-Y H:i');
                                ?>
                                        <tr id="row1">
                                            <!-- checkbox -->
                                            <th scope="row"><input class="row-checkbox form-check-input small-font" type="checkbox"></th>
                                            <input type="hidden" name="barangay_id" value="<?= $row['barangay_id']; ?>">
                                            <td data-col="municipality">
                                                <!-- Municipality name -->
                                                <h6 class="small-font"><?= $row['municipality_name']; ?></h6>
                                            </td>
                                            <td data-col="barangay">
                                                <!-- Barangay name -->
                                                <h6 class="small-font fw-bold"><?= $row['barangay_name']; ?></h6>
                                            </td>
                                            <!-- date added -->
                                            <td data-col="date" class="small-font text-center text-secondary fw-normal">
                                                <?= $formatted_date ?>
                                            </td>
                                            <!-- Action -->
                                            <td>
                                                <form class="d-flex justify-content-end admin-only" action="code/massDelete-code.php" method="post" id="deleteForm">
                                                    <!-- edit -->
                                                    <a href="#" class="btn btn-primary me-1 edit_data_brgy admin-only py-2 px-3 small-font fw-bold" data-toggle="modal" data-target="#dataModalEdit" data-id="<?= $row['barangay_id']; ?>">Edit<i class="fa-solid fa-pen-to-square ms-1"></i></a>
                                                    <input type="hidden" name="barangay_id" value="<?= $row['barangay_id']; ?>">
                                                    <input type="hidden" name="delete_brgy" value="1">
                                                    <button type="submit" name="delete_brgy" id="deleteRow" class="btn btn-link link-danger admin-only small-font fw-bold pe-0">
                                                        Delete<i class="fa-solid fa-trash ms-1"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <!-- ellipsis menu button -->
                                            <!-- <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td> -->
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No data found.";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Add pagination links -->
                    <?php generatePaginationLinks($total_pages_barangay, $current_page, 'page'); ?>
                </div>
            </div>

            <!-- MODAL -->
            <!-- add Barangay -->
            <?php require "modals/add-barangay.php"; ?>
            <!-- edit barangay -->
            <?php require "modals/edit-barangay.php"; ?>
            <!-- confirm barangay -->
            <?php require "modals/confirm-delete.php"; ?>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../../visitor/js/nav.js"></script>
    <!-- to Capitalized all first letter in all inputs and textarea -->
    <script>
        $(document).ready(function() {
            // Capitalize the initial values of input fields
            $("input[type='text'], textarea").each(function() {
                var currentValue = $(this).val();
                if (currentValue.length > 0) {
                    var modifiedValue = currentValue.charAt(0).toUpperCase() + currentValue.slice(1);
                    $(this).val(modifiedValue);
                }
            });

            // Update the value as the user types
            $("input[type='text'], textarea").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                var newValue = $(this).val();
                if (newValue.length > 0) {
                    newValue = newValue.charAt(0).toUpperCase() + newValue.slice(1);
                }
                $(this).val(newValue);
                this.setSelectionRange(start, end);
            });
        });
    </script>
    <!-- search function -->
    <script>
        // Modify the search function to store the search query in a session or URL parameter
        function search() {
            var searchInput = document.getElementById("searchInput").value;
            // Store the search query in a session or URL parameter
            // For example, you can use localStorage to store the search query
            localStorage.setItem('searchQuery', searchInput);
            // Reload the page with the search query as a parameter
            window.location.href = window.location.pathname + "?search=" + searchInput;
        }

        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');

        // Add a keyup event listener to the search input field
        searchInput.addEventListener('keyup', function(event) {
            // Check if the Enter key is pressed (key code 13)
            if (event.keyCode === 13) {
                // Call the search function
                search();
            }
        });

        // Function to clear the search and hide the clear button
        function clearSearch() {
            searchInput.value = '';
            window.location.href = window.location.pathname;
        }

        // Function to apply filters and update the table
        function applyFilters() {
            let searchCondition = ''; // Initialize searchCondition here

            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);

            // Build the search condition based on selected categories, municipalities, and the search value

            if (selectedMunicipalities.length > 0) {
                searchCondition += `&municipalities=${selectedMunicipalities.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }
            // Reload the table with the new filters
            window.location.href = window.location.pathname + '?search=' + searchCondition;
        }
    </script>
    <!-- script for edit data -->
    <script>
        // EDIT SCRIPT
        const tableRows = document.querySelectorAll('.edit_data_brgy');

        tableRows.forEach(row => {

            row.addEventListener('click', () => {
                const id = row.getAttribute('data-id');

                let url = '';
                let dataKey = '';
                let modalId = '';
                url = 'fetch/fetch_brgy.php';
                dataKey = 'barangay_id';
                modalId = 'edit-item-modal-brgy';
                // Assuming you have jQuery available
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'click_edit_btn': true,
                        [dataKey]: id, // Make sure barangay_id or location_id is included
                    },

                    success: function(response) {
                        // Handle the response from the PHP script
                        // console.log('Response:', response);

                        // Clear the current preview
                        $('#preview').empty();

                        $.each(response, function(key, value) {
                            // Append options to select element
                            // console.log(value['province_name']);

                            // crop_id
                            $('#crop_id').val(id);

                            // data of barangay table
                            $('#municipality-Name-Edit').val(value['municipality_name']);
                            // data of municipality table
                            $('#municipality-Name-Edit').append($('<option>', {
                                value: value['municipality_id'],
                                text: value['municipality_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                            $('#barangay-Name').val(value['barangay_name']);
                            $('#CoordinatesEdit').val(value['barangay_coordinates']);

                            // setting the the value of the id of location and barangay depending on the tab
                            $('#' + dataKey + '-Edit').val(value[dataKey]);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('Error:', error);
                    }

                });

                // Show the modal
                const dataModal = new bootstrap.Modal(document.getElementById(modalId), {
                    keyboard: false
                });
                dataModal.show();
            });
        });
    </script>

    <!-- script for all checkbox -->
    <script>
        // Add event listener to the "All" checkbox
        $('#checkAll').change(function() {
            // Check or uncheck all checkboxes based on the state of the "All" checkbox
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });

        // Make table rows clickable
        $(document).ready(function() {
            // Add click event to table rows
            $('tbody tr[data-href]').on("click", function(event) {
                // Check if the click target or any of its ancestors is a button or checkbox
                if (
                    !$(event.target).is('.row-btn, :checkbox') &&
                    !$(event.target).closest('.row-btn, :checkbox').length
                ) {
                    // Navigate to the URL specified in the data-href attribute
                    window.location.href = $(this).attr('data-href');
                }
            });
        });
    </script>

    <!-- to confirm if a user wants to delete table row data -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your script here
            var deleteForm = document.getElementById('deleteForm');
            var confirmModalInstanceEdit;

            function deleteModalEdit(event) {
                // Prevent the default behavior of the button (e.g., form submission)
                event.preventDefault();

                // Get the modal element
                var confirmModal = document.getElementById('confirmModalDelete');

                // Create a new Bootstrap modal instance if it doesn't exist
                if (!confirmModalInstanceEdit) {
                    confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
                }

                // Show the modal
                confirmModalInstanceEdit.show();

                // Event listener for the confirm delete button
                document.getElementById('confirmDeleteBtnRow').addEventListener('click', function() {
                    // Set the value of delete_brgy to 1 before submitting the form
                    document.querySelector('input[name="delete_brgy"]').value = "1";
                    // Submit the form
                    deleteForm.submit();
                });
            }

            // Event listener for when the modal is shown
            document.getElementById('confirmModalDelete').addEventListener('shown.bs.modal', function() {
                // Setup event listeners for delete button in modal
                setupModalEventListenersEdit();
            });

            // Event listener for when the confirmation modal is hidden
            document.getElementById('confirmModalDelete').addEventListener('hidden.bs.modal', function() {
                // Reset the confirmModalInstanceEdit
                confirmModalInstanceEdit = null;
            });

            function setupModalEventListenersEdit() {
                // Event listener for the delete button
                document.getElementById('deleteRow').addEventListener('click', deleteModalEdit);
            }

            // Initialize event listener
            setupModalEventListenersEdit();
        });
    </script>

    <!-- Add a click event listener to each table header for sorting -->
    <script>
        $(document).ready(function() {
            $('th[data-sort]').on('click', function() {
                var $th = $(this);
                var column = $th.data('sort');
                var direction = $th.hasClass('asc') ? 'desc' : 'asc';

                // Remove asc/desc classes from all headers
                $('th[data-sort]').removeClass('asc desc');

                // Add asc/desc class to clicked header
                $th.addClass(direction);

                // Sort the table
                sortTable(column, direction);
            });
        });

        function sortTable(column, direction) {
            var $tbody = $('tbody');
            var $rows = $tbody.find('tr').toArray();

            $rows.sort(function(a, b) {
                var valA = $(a).find('td[data-col="' + column + '"]').text().toUpperCase();
                var valB = $(b).find('td[data-col="' + column + '"]').text().toUpperCase();

                if (direction === 'asc') {
                    return valA.localeCompare(valB);
                } else {
                    return valB.localeCompare(valA);
                }
            });

            $tbody.empty().append($rows);
        }
    </script>
</body>

<!-- to check if the user is logged in and has a rank of Encoder if Encoder and rank i redirect sya pabalik kung asa sya gaina before niya ni gi try access -->
<?php
if (!isset($_SESSION['LOGGED_IN']) || trim($_SESSION['rank']) == 'Encoder' || trim($_SESSION['rank']) == 'Curator') {
    // Output JavaScript code to redirect back to the original page
    echo '<script>window.history.go(-1);</script>';
    $_SESSION['message'] = 'Access Not Granted Not Enough Authority.';
    // stop the code
    exit();
}
?>

</html>