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
    <?php require "../../functions/message.php"; ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">
            <!-- LIST -->
            <?php require "list.php"; ?>
            <!-- Add -->
            <?php require "tabs/add-user.php"; ?>
            <!-- Edit -->
            <?php require "tabs/edit-user.php"; ?>
            <!-- View -->
            <?php require "tabs/view.php"; ?>
            <div>
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
    <!-- script for viewing -->
    <script>
        // View SCRIPT
        const tableRowsView = document.querySelectorAll('.view-item-modal-partners');

        tableRowsView.forEach(row => {

            row.addEventListener('click', () => {
                const id = row.getAttribute('data-id');

                // Use the user_id as needed
                //console.log("User ID: " + id);

                // Assuming you have jQuery available
                $.ajax({
                    url: 'modals/fetch.php',
                    type: 'POST',
                    data: {
                        'click_view_btn': true,
                        'user_id': id,
                    },
                    success: function(response) {
                        // Handle the response from the PHP script
                        // console.log('Response:', response);

                        $.each(response, function(key, value) {
                            // Append options to select element
                            console.log(value['affiliated_contact_num']);

                            // input elements with the new data on gen.php and loc.php
                            $('#first_nameView').text(value['first_name']);
                            $('#last_nameView').text(value['last_name']);
                            $('#genderView').text(value['gender']);
                            $('#affiliationView').text(value['affiliation']);
                            $('#emailView').text(value['email']);
                            $('#contact_numView').text(value['contact_num']);
                            $('#affiliation_emailView').text(value['affiliated_email']);
                            $('#affiliation_contact_numView').text(value['affiliated_contact_num']);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('Error:', error);
                    }

                });

                // Show the modal
                const dataModalView = new bootstrap.Modal(document.getElementById('view-item-modal-partners'), {
                    keyboard: false
                });
                dataModalView.show();
            });
        });
    </script>
</body>
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