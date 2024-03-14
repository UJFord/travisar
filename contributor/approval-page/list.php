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
        width: 100px;
        height: 5px;
        background-color: #555555;
        border-radius: 10px;
        transition: all .3s ease-in-out;
    }
</style>
<!-- LIST -->
<div class="container">
    <div class="row">

        <!-- HEADING -->
        <div class="tab_box d-flex justify-content-between">
            <!-- Button Tabs -->
            <div>
                <button class="tab_btn active" id="pendingTab">Pending</button>
                <button class="tab_btn" id="approvedTab">History</button>
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
        ?>

        <!-- dib ni sya para ma set ang mga tabs na data -->
        <div class="general_info">
            <!-- pending tab -->
            <?php require 'tabs/pending.php' ?>

            <!-- history tab -->
            <?php require 'tabs/history.php' ?>
        </div>

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
            const tabName = tab.id.replace('Tab', '').toLowerCase();
            history.replaceState(null, null, `?tab=${tabName}`);
        })
    })

    function loadPage(page, tab) {
        // Perform AJAX request to fetch new page content
        fetch('approval.php?page=' + page + '&tab=' + tab)
            .then(response => response.text())
            .then(data => {
                // Update the table body of the active tab with the new page content
                document.querySelector('.gen_info.active tbody').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>