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

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>
    <!-- NAV -->
    <?php require "../nav/nav.php"; ?>

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

                @keyframes moving {
                    from {
                        transform: translateX(50px);
                        opacity: 0;
                    }

                    to {
                        transform: translateX(0px);
                        opacity: 1;
                    }
                }

                .add-loc-btn {
                    background: var(--mainBrand);
                    border: none;
                }
            </style>

            <!-- LIST -->
            <div class="container">

                <!-- HEADING -->
                <div class="tab_box d-flex justify-content-between">
                    <!-- Button Tabs -->
                    <div>
                        <button class="tab_btn active" id="locationTab" disabled>Municipality</button>
                        <div class="line"></div>
                    </div>
                    <!-- filter actions -->
                    <div class="d-flex py-3 px-3">
                        <!-- search -->
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Location" aria-label="Search" aria-describedby="filter-search">
                            <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>

                <?php
                // Set the number of items to display per page
                $items_per_page = 10;

                // Get the current page number
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the offset based on the current page and items per page
                $offset = ($current_page - 1) * $items_per_page;

                // Count the total number of rows for pagination for approved crops
                $total_rows_query_location = "SELECT COUNT(*) FROM municipality";
                $total_rows_result_location = pg_query($conn, $total_rows_query_location);
                $total_row_location = pg_fetch_row($total_rows_result_location)[0];

                // Calculate the total number of pages for approved crops
                $total_pages_location = ceil($total_row_location / $items_per_page);
                ?>

                <!-- dib ni sya para ma set ang mga tabs na data -->
                <div class="general_info">
                    <!-- location tab Active -->
                    <div class="gen_info active" id="locationTabData" style="max-height: 500px; overflow-y: auto;">
                        <!-- TABLE -->
                        <table id="locationTable" class="table table-hover">
                            <!-- table head -->
                            <thead>
                                <tr>
                                    <th class="col-1 thead-item" scope="col">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-dark-emphasis small-font">
                                            All
                                        </label>
                                    </th>
                                    <th class="col text-dark-emphasis small-font" scope="col">Province</th>
                                    <th class="col text-dark-emphasis small-font" scope="col">Municipality</th>
                                    <th class="col-3 small-font text-dark-emphasis text-center">Date Added</th>
                                    <th class="col-1 text-center">
                                        <!-- add button -->
                                        <button type="button" id="addProvince" class="btn btn-secondary add-loc-btn p-2 btn small-font" name="addProvince" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                                            New
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </th>
                                    <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                                </tr>
                            </thead>

                            <!-- table body -->
                            <tbody class="table-group-divider fw-bold overflow-scroll">
                                <?php
                                $query_pending = "SELECT * FROM municipality left join province on province.province_id = municipality.province_id ORDER BY municipality.municipality_id ASC LIMIT $items_per_page OFFSET $offset";
                                $query_run_location = pg_query($conn, $query_pending);

                                if ($query_run_location) {
                                    while ($row = pg_fetch_array($query_run_location)) {
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($row['municipality_date']);
                                        // Format the date to display up to the minute
                                        $formatted_date = $date->format('Y-m-d H:i');

                                ?>
                                        <tr id="row1">
                                            <!-- checkbox -->
                                            <th scope="row"><input class="form-check-input" type="checkbox"></th>

                                            <input type="hidden" name="municipality_id" value="<?= $row['municipality_id']; ?>">

                                            <td>
                                                <!-- Province name -->
                                                <h6><?= $row['province_name']; ?></h6>
                                            </td>

                                            <td>
                                                <!-- Municipality name -->
                                                <a href=""><?= $row['municipality_name']; ?></a>
                                            </td>

                                            <!-- date added -->
                                            <td class="small-font text-center text-secondary fw-normal">
                                                <?= $formatted_date; ?>
                                            </td>

                                            <!-- Action -->
                                            <td>
                                                <form class="d-flex justify-content-center">
                                                    <!-- edit -->
                                                    <a href="#" class="btn btn-primary me-1 edit_data" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['municipality_id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                                    <!-- delete -->
                                                    <button type="submit" name="delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>

                                            <!-- ellipsis menu butn -->
                                            <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
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
                    <?php generatePaginationLinks($total_pages_location, $current_page, 'page'); ?>
                </div>
            </div>

            <!-- MODAL -->
            <!-- add Location -->
            <?php require "modals/add-municipality.php"; ?>
            <!-- edit location -->
            <?php //require "modals/edit-municipality.php"; 
            ?>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- search function -->
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();

            // Determine which table is currently active
            var activeTable = document.querySelector('.gen_info.active table');
            tr = activeTable.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var found = false;
                if (i === 0) {
                    tr[i].style.display = "";
                    continue; // Skip the header row
                }
                for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }

        // Add event listener to search input
        document.getElementById('searchInput').addEventListener('keyup', filterTable);

        // Reset search input when tab is switched
        function resetSearchInput() {
            document.getElementById("searchInput").value = "";
            filterTable(); // Trigger filtering to show all rows
        }

        // Add event listener to tab buttons to reset search input
        document.querySelectorAll('.tab_btn').forEach(tab => {
            tab.addEventListener('click', resetSearchInput);
        });
    </script>
    <!-- script for edit data -->
    <script>
        // EDIT SCRIPT
        const tableRows = document.querySelectorAll('.edit_data_brgy, .edit_data');

        tableRows.forEach(row => {

            row.addEventListener('click', () => {
                const id = row.getAttribute('data-id');

                let url = '';
                let dataKey = '';
                let modalId = '';

                if (row.classList.contains('edit_data_brgy')) {
                    url = 'code/code-brgy.php';
                    dataKey = 'barangay_id';
                    modalId = 'edit-item-modal-brgy';
                } else {
                    url = 'code/code-muni.php';
                    dataKey = 'municipality_id';
                    modalId = 'edit-item-modal';
                }

                // Assuming you have jQuery available
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'click_edit_btn': true,
                        [dataKey]: id, // Make sure barangay_id or municipality_id is included
                    },

                    success: function(response) {
                        // Handle the response from the PHP script
                        // console.log('Response:', response);

                        // Clear the current preview
                        $('#preview').empty();

                        $.each(response, function(key, value) {
                            // Append options to select element
                            console.log(value['province_name']);

                            // crop_id
                            $('#crop_id').val(id);

                            // data of location table
                            $('#prov-Name').val(value['province_name']);
                            $('#municipality-Name').val(value['municipality_name']);

                            // data of barangay table
                            $('#municipality-Name-Edit').val(value['municipality_name']);
                            $('#barangay-Name').val(value['barangay_name']);

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
</body>
<!-- 
    to check if the user is logged in and has a rank of Encoder
    if Encoder and rank i redirect sya pabalik kung asa sya gaina before niya ni gi try access
-->
<?php
if (!isset($_SESSION['LOGGED_IN']) || trim($_SESSION['rank']) == 'Encoder') {
    // Output JavaScript code to redirect back to the original page
    echo '<script>window.history.go(-1);</script>';
    $_SESSION['message'] = 'Access Not Granted Not Enough Authority.';
    // stop the code
    exit();
}
?>

</html>