<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>

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
</style>

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
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="css/crop-list.css">
    <!-- script for moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- script for access control -->
    <script src="../js/access-control.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>

    <!-- NAV -->
    <?php require "nav.php"; ?>

    <?php
    include "../functions/message.php";
    ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">
            <!-- LIST -->
            <div class="container">
                <div class="row">

                    <!-- HEADING -->
                    <div class="tab_box d-flex justify-content-between">
                        <!-- Button Tabs -->
                        <div>
                            <button class="tab_btn" id="approvedTab" disabled>Submission</button>
                            <div class="line"></div>
                        </div>
                        <!-- filter actions -->
                        <div class="d-flex py-3 px-3">
                            <!-- search -->
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
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
                    $total_rows_query_approved = "SELECT COUNT(*) FROM crop WHERE status = 'approved'";
                    $total_rows_result_approved = pg_query($conn, $total_rows_query_approved);
                    $total_rows_approved = pg_fetch_row($total_rows_result_approved)[0];

                    // Calculate the total number of pages for approved crops
                    $total_pages_approved = ceil($total_rows_approved / $items_per_page);

                    // Count the total number of rows for pagination for pending crops
                    $total_rows_query_pending = "SELECT COUNT(*) FROM crop WHERE status = 'pending'";
                    $total_rows_result_pending = pg_query($conn, $total_rows_query_pending);
                    $total_rows_pending = pg_fetch_row($total_rows_result_pending)[0];

                    // Calculate the total number of pages for pending crops
                    $total_pages_pending = ceil($total_rows_pending / $items_per_page);

                    $user_id = null; // Initialize the variable

                    if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                        $user_id = $_SESSION['USER']['user_id']; // Assign the user ID if the user is logged in
                    }
                    ?>

                    <!-- dib ni sya para ma set ang mga tabs na data -->
                    <div class="general_info">
                        <!-- Submission Tab -->
                        <div class="gen_info" id="submissionTab" style="max-height: 400px; overflow-y: auto;">
                            <!-- TABLE -->
                            <table id="submissionTable" class="table table-hover">
                                <!-- table head -->
                                <thead>
                                    <tr>
                                        <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                                        <th class="col text-dark-emphasis small-font text-center" scope="col">Date Created</th>
                                        <th class="col text-dark-emphasis small-font text-center" scope="col">Status</th>
                                        <th class="col text-dark-emphasis small-font text-center" scope="col">Action</th>
                                        <th class="col text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                                    </tr>

                                </thead>
                                <!-- table body -->
                                <tbody class="table-group-divider fw-bold overflow-scroll">
                                    <?php
                                    $query_approved = "SELECT * FROM crop WHERE status IN ('approved', 'rejected', 'pending') AND user_id = $user_id ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
                                    $query_run_approved = pg_query($conn, $query_approved);

                                    if ($query_run_approved) {
                                        while ($row = pg_fetch_array($query_run_approved)) {
                                            // Convert the string to a DateTime object
                                            $date = new DateTime($row['input_date']);
                                            // Format the date to display up to the minute
                                            $formatted_date = $date->format('Y-m-d H:i');

                                            // Fetch category name
                                            $query_category = "SELECT * FROM category WHERE category_id = $1";
                                            $query_run_category = pg_query_params($conn, $query_category, array($row['category_id']));
                                    ?>
                                            <tr id="row1" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>" style="background-color: <?= ($row['status'] == 'approved') ? 'green' : ($row['status'] == 'pending' ? 'yellow' : 'red'); ?>">
                                                <td>
                                                    <!-- crop variety name -->
                                                    <a href=""><?= $row['crop_variety']; ?></a>
                                                    <!-- category -->
                                                    <?php
                                                    if (pg_num_rows($query_run_category)) {
                                                        $category = pg_fetch_assoc($query_run_category);
                                                        echo '<h6 class="text-secondary small-font m-0">' . $category['category_name'] . '</h6>';
                                                    } else {
                                                        echo "No category added.";
                                                    }
                                                    ?>
                                                </td>

                                                <!-- Date Created -->
                                                <td class="text-secondary small-font fw-normal text-center">
                                                    <?= $formatted_date; ?>
                                                </td>

                                                <!-- Status -->
                                                <td class="text-secondary small-font fw-normal text-center">
                                                    <?= $row['status']; ?>
                                                </td>

                                                <!-- edit -->
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-success btn-sm edit_data admin-only" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">Edit</a>
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
                        <!-- pagination -->
                        <?php generatePaginationLinks($total_pages_approved, $current_page, 'page'); ?>
                    </div>

                    <!-- edit -->
                    <?php require "submission-page/edit.php"; ?>

                </div>
            </div>
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
    <script>
        // make clicking table rows open edit ui
        $(document).ready(function() {
            $('#dataTable tr').click(function() {
                // console.log('clicked')
                // Get the crop ID from the clicked row or anchor tag
                var cropId = $(this).data('id') || $(this).find('a').data('id');

                // Open the modal
                $('#dataModal').modal('show');
            });
        });
    </script>
</body>

</html>