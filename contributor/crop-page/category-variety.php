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
    <!-- script for moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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

            <!-- FILTERS -->
            <?php require "modals/category-variety-tabs/filter.php"; ?>

            <!-- list -->
            <?php require "modals/category-variety-tabs/list.php"; ?>

            <!-- add -->
            <?php require "modals/category-variety-tabs/add.php"; ?>

            <!-- edit -->
            <?php require "modals/category-variety-tabs/edit.php"; ?>
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
            $("input[type='text']").each(function() {
                $(this).val($(this).val().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                }));
            });

            // Update the value as the user types
            $("input[type='text']").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                $(this).val(function(_, val) {
                    return val.replace(/\b\w/g, function(char) {
                        return char.toUpperCase();
                    });
                });
                this.setSelectionRange(start, end);
            });

            // Capitalize the initial values textarea fields
            $("textarea").each(function() {
                $(this).val($(this).val().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                }));
            });

            // Update the value as the user types
            $("textarea").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                $(this).val(function(_, val) {
                    return val.replace(/\b\w/g, function(char) {
                        return char.toUpperCase();
                    });
                });
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

            const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);

            // Build the search condition based on selected categories, municipalities, and the search value
            if (selectedCategories.length > 0) {
                searchCondition += `&categories=${selectedCategories.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }
            if (selectedMunicipalities.length > 0) {
                searchCondition += `&municipalities=${selectedMunicipalities.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }

            // Reload the table with the new filters
            window.location.href = window.location.pathname + '?search=' + searchCondition;
        }
    </script>
    <!-- allowing scrollspy in the modal -->
    <script>
        $(document).ready(function() {
            $('#view-item-modal').on('shown.bs.modal', function() {
                $('[data-spy="scroll"]').scrollspy('refresh');
                console.log($('[data-spy="scroll"]').scrollspy());
            });
        });
    </script>
</body>

</html>