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
        cursor: pointer;
    }

    .tab_box .tab_btn.active {
        color: #555555;
    }

    /* for hiding data that is not active */
    .general_info .gen_info {
        display: none;
        animation: moving .5s ease;
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

    .general_info .gen_info.active {
        display: block;
    }

    /* the blue line for showing active tab */
    .line {
        position: absolute;
        width: 140px;
        height: 5px;
        background-color: #555555;
        border-radius: 10px;
        transition: all .3s ease-in-out;
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
            <button class="tab_btn active" id="locationTab">Municipality</button>
            <button class="tab_btn" id="barangayTab">Barangay</button>
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
    $total_rows_query_location = "SELECT COUNT(*) FROM location";
    $total_rows_result_location = pg_query($conn, $total_rows_query_location);
    $total_row_location = pg_fetch_row($total_rows_result_location)[0];

    // Calculate the total number of pages for approved crops
    $total_pages_location = ceil($total_row_location / $items_per_page);

    // Count the total number of rows for pagination for pending crops
    $total_rows_query_barangay = "SELECT COUNT(*) FROM barangay";
    $total_rows_result_barangay = pg_query($conn, $total_rows_query_barangay);
    $total_rows_barangay = pg_fetch_row($total_rows_result_barangay)[0];

    // Calculate the total number of pages for pending crops
    $total_pages_barangay = ceil($total_rows_barangay / $items_per_page);
    ?>

    <!-- dib ni sya para ma set ang mga tabs na data -->
    <div class="general_info">

        <!-- location tab Active -->
        <?php require 'tabs/muni.php' ?>

        <!-- barangay Tab Unactive -->
        <?php require 'tabs/brgy.php' ?>

    </div>
</div>

<!-- script -->
<!-- tabs script -->
<script>
    // JavaScript for tab switching
    const tabs = document.querySelectorAll('.tab_btn');
    const all_content = document.querySelectorAll('.gen_info');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            var line = document.querySelector('.line');
            line.style.width = e.target.offsetWidth + "px";
            line.style.left = e.target.offsetLeft + "px";

            all_content.forEach(content => {
                content.classList.remove('active')
            });
            all_content[index].classList.add('active');


            // Update URL with tab parameter
            const tabName = tab.getAttribute('id');
            const url = new URL(window.location.href);
            url.searchParams.set('tab', tabName);
            history.replaceState(null, null, url);
        })
    })

    // for preventing the default action of pagination which is refreshing the page
    // this sets it to load the content of the selected page number without the page
    const paginationContainers = document.querySelectorAll('.pagination-container');

    paginationContainers.forEach(paginationContainer => {
        paginationContainer.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior
            if (e.target.tagName === 'A') {
                const url = e.target.getAttribute('href');
                const tabId = paginationContainer.dataset.tabId;
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        // Assuming each tab has a container with id "tabContent"
                        const tabContent = document.getElementById(tabId);
                        tabContent.innerHTML = data; // Update tab content with loaded data
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
</script>