<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
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
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="css/crop-list.css">
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
            <?php require "location-page/list.php"; ?>
            <div>
            </div>

            <!-- MODAL -->
            <!-- add Location -->
            <?php require "location-page/modals/add-location.php"; ?>
            <!-- add Barangay -->
            <?php require "location-page/modals/add-barangay.php"; ?>
            <!-- edit location -->
            <?php require "location-page/modals/edit-location.php"; ?>
            <!-- edit barangay -->
            <?php require "location-page/modals/edit-barangay.php"; ?>
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
                    url = 'location-page/code/code-brgy.php';
                    dataKey = 'barangay_id';
                    modalId = 'edit-item-modal-brgy';
                } else {
                    url = 'location-page/code/code-muni.php';
                    dataKey = 'location_id';
                    modalId = 'edit-item-modal';
                }

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

                            // data of location table
                            $('#province-Name').val(value['province_name']);
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