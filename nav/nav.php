<?php
// Define the base URL of your local server
define('BASE_URL', 'http://localhost/travisar');

//get current page to choose the active link
// current page path
$current_page_path = strtok($_SERVER['REQUEST_URI'], '?');

// current page html boolean
$current_page_isHome = false;
$current_page_isCrop = false;
$current_page_isAbout = false;
$current_page_isHelp = false;
$current_page_isCrop_page = false;
$current_page_isSettings = false;
$current_page_isSubmission = false;
$current_page_isManagement = false;
$current_page_isProfile = false;

switch ($current_page_path) {
    case "/travisar/visitor/home.php":
        $current_page_isHome = true;
        break;
    case "/travisar/visitor/about/sar.php":
    case "/travisar/visitor/about/collab.php":
    case "/travisar/visitor/about/travis.php":
        $current_page_isAbout = true;
        break;
    case "/travisar/visitor/crop.php":
    case "/travisar/visitor/corn.php":
    case "/travisar/visitor/all.php":
    case "/travisar/visitor/rice.php":
    case "/travisar/visitor/root.php":
    case "/travisar/visitor/view.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/help/content.php":
    case "/travisar/visitor/help/contribute.php":
    case "/travisar/visitor/help/intro.php":
    case "/travisar/visitor/help/submission.php":
        $current_page_isHelp = true;
        break;
    case "/travisar/contributor/crop-page/category-variety.php":
    case "/travisar/contributor/crop-page/crop-category.php":
    case "/travisar/contributor/crop-page/abiotic-resistance.php":
    case "/travisar/contributor/crop-page/disease-resistance.php":
    case "/travisar/contributor/crop-page/pest-resistance.php":
    case "/travisar/contributor/location-page/municipality.php":
    case "/travisar/contributor/location-page/barangay.php":
    case "/travisar/contributor/user-page/partners.php":
    case "/travisar/contributor/user-page/verify-user.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/submission-page/submission.php":
        $current_page_isSubmission = true;
        break;
    case "/travisar/contributor/crop-page/crop.php":
    case "/travisar/contributor/approval-page/pending.php":
    case "/travisar/contributor/approval-page/approved.php":
    case "/travisar/contributor/approval-page/rejected.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/login/profile.php":
        $current_page_isProfile = true;
        break;
}

// Fetch active notifications
// para sa mga na approved ni na submission
if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Contributor') {
    if (isset($_SESSION['USER']['user_id'])) {
        $user_id = $_SESSION['USER']['user_id'];
        $find_notifications = "SELECT * FROM notification left join crop on crop.crop_id = notification.crop_id WHERE active = true AND crop.user_id = $user_id ORDER BY notification_date DESC";
        $result = pg_query($conn, $find_notifications);
        if (!$result) {
            die("Error in query: " . pg_last_error());
        }
    } else {
        $find_notifications = "SELECT * FROM notification left join crop on crop.crop_id = notification.crop_id WHERE active = true";
        $result = pg_query($conn, $find_notifications);
        if (!$result) {
            die("Error in query: " . pg_last_error());
        }
    }

    $count_active = '';
    $notifications_data = array();
    $deactive_notifications_dump = array();
    $count_active = pg_num_rows($result);
    while ($rows = pg_fetch_assoc($result)) {
        $notifications_data[] = array(
            "notification_id" => $rows['notification_id'],
            "notification_name" => $rows['notification_name'],
            "notification_date" => $rows['notification_date'],
            "message" => $rows['message']
        );
    }

    // Fetch only five specific posts with active = 0
    $deactive_notifications = "SELECT * FROM notification WHERE active = false ORDER BY notification_id DESC LIMIT 5";
    $result = pg_query($conn, $deactive_notifications);
    if (!$result) {
        die("Error in query: " . pg_last_error());
    }

    while ($rows = pg_fetch_assoc($result)) {
        $deactive_notifications_dump[] = array(
            "notification_id" => $rows['notification_id'],
            "notification_name" => $rows['notification_name'],
            "notification_date" => $rows['notification_date'],
            "message" => $rows['message']
        );
    }
}

if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Curator') {
    $find_notificationsCurator = "SELECT * FROM notification left join crop on crop.crop_id = notification.crop_id left join status on crop.status_id = status.status_id WHERE action = 'Pending' AND active = true ORDER BY notification_date DESC";
    $resultCurator = pg_query($conn, $find_notificationsCurator);
    if (!$resultCurator) {
        die("Error in query: " . pg_last_error());
    }

    $count_activeCurator = '';
    $notifications_dataCurator = array();
    $deactive_notifications_dumpCurator = array();
    $count_activeCurator = pg_num_rows($resultCurator);
    while ($rows = pg_fetch_assoc($resultCurator)) {
        $notifications_dataCurator[] = array(
            "notification_id" => $rows['notification_id'],
            "crop_id" => $rows['crop_id'],
            "crop_variety" => $rows['crop_variety'],
            "notification_date" => $rows['notification_date'],
            "action" => $rows['action']
        );
    }

    // Fetch only five specific posts with active = 0
    $deactive_notificationsCurator = "SELECT * FROM notification left join crop on crop.crop_id = notification.crop_id left join status on crop.status_id = status.status_id WHERE action = 'Pending' ORDER BY crop.crop_id DESC LIMIT 5";
    $resultCurator = pg_query($conn, $deactive_notificationsCurator);
    if (!$resultCurator) {
        die("Error in query: " . pg_last_error());
    }

    while ($rows = pg_fetch_assoc($resultCurator)) {
        $deactive_notifications_dumpCurator[] = array(
            "notification_id" => $rows['notification_id'],
            "crop_id" => $rows['crop_id'],
            "crop_variety" => $rows['crop_variety'],
            "notification_date" => $rows['notification_date'],
            "action" => $rows['action']
        );
    }
}

if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Admin') {
    // Combined notifications for active entries
    $find_notificationsAdmin = "
        SELECT notification.notification_id AS id, crop.crop_variety AS name, notification.notification_date, notification.notification_name, 'crop' AS type
        FROM notification
        LEFT JOIN crop ON crop.crop_id = notification.crop_id
        WHERE notification.active = true

        UNION

        SELECT notification_user.notification_user_id AS id, CONCAT(users.first_name, ' ', users.last_name) AS name, notification_user.notification_date, 'User notification' AS notification_name, 'user' AS type
        FROM notification_user
        LEFT JOIN users ON users.user_id = notification_user.user_id
        WHERE notification_user.active = true

        ORDER BY notification_date DESC
    ";
    $resultAdmin = pg_query($conn, $find_notificationsAdmin);
    if (!$resultAdmin) {
        die("Error in query: " . pg_last_error());
    }

    $notifications_dataAdmin = array();
    while ($rows = pg_fetch_assoc($resultAdmin)) {
        $notifications_dataAdmin[] = array(
            "id" => $rows['id'],
            "name" => $rows['name'],
            "notification_date" => $rows['notification_date'],
            "notification_name" => $rows['notification_name'],
            "type" => $rows['type']
        );
    }

    // Fetch deactivated notifications
    $deactive_notificationsAdmin = "
        SELECT notification.notification_id AS id, crop.crop_variety AS name, notification.notification_date, notification.notification_name, 'crop' AS type
        FROM notification
        LEFT JOIN crop ON crop.crop_id = notification.crop_id
        WHERE notification.active = false

        UNION

        SELECT notification_user.notification_user_id AS id, CONCAT(users.first_name, ' ', users.last_name) AS name, notification_user.notification_date, 'User notification' AS notification_name, 'user' AS type
        FROM notification_user
        LEFT JOIN users ON users.user_id = notification_user.user_id
        WHERE notification_user.active = false

        ORDER BY notification_date DESC
        LIMIT 5
    ";
    $resultAdmin = pg_query($conn, $deactive_notificationsAdmin);
    if (!$resultAdmin) {
        die("Error in query: " . pg_last_error());
    }

    $deactive_notifications_dumpAdmin = array();
    while ($rows = pg_fetch_assoc($resultAdmin)) {
        $deactive_notifications_dumpAdmin[] = array(
            "id" => $rows['id'],
            "name" => $rows['name'],
            "notification_date" => $rows['notification_date'],
            "notification_name" => $rows['notification_name'],
            "type" => $rows['type']
        );
    }
}


?>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- script for moment js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- function for notification for pending approval of crops and users -->
<script>
    // Define the load_unseen_notification function globally
    function load_unseen_notification(view = '') {
        $.ajax({
            url: "<?php echo BASE_URL . '/nav/fetch-notif.php'; ?>",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function(data) {
                // Access data1 and update HTML accordingly
                $('.count').html(data.data1.notification);
                if (data.data1.unseen_notification > 0) {
                    $('.count').html(data.data1.unseen_notification);
                }

                // Access data2 and update HTML accordingly
                // Adjust the selectors and HTML update based on your needs
                $('.count2').html(data.data2.notification);
                if (data.data2.unseen_notification > 0) {
                    $('.count2').html(data.data2.unseen_notification);
                }
            }
        });
    }

    // Call the function when the document is ready
    $(document).ready(function() {
        load_unseen_notification();
    });
</script>

<style>
    .fa-solid.fa-bell {
        position: relative;
        /* Ensure the parent of the absolute element is positioned */
    }

    .round {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        position: absolute;
        /* This is the crucial change */
        background: red;
        display: inline-block;
        z-index: 99 !important;
        text-align: center;
        font-size: 0.8rem;
        /* left: 0 !important; */
    }

    .round>span {
        color: white;
        text-align: center;
        font-size: 1rem !important;
        padding: 0 !important;
    }

    /* .message>span {
        width: 100%;
        display: block;
        color: red;
        text-align: justify;
        margin: 0.2rem 0.3rem !important;
        padding: 0.3rem !important;
        line-height: 1rem !important;
        font-weight: bold;
        border-bottom: 1px solid white;
        font-size: 1.8rem !important;
    }

    .message {
        background:#ff7f50;
        margin:0.3rem 0.2rem !important;
        padding:0.2rem 0 !important;
        width:100%;
        display:block;
    }

    .message>.msg {
        width: 90%;
        margin: 0.2rem 0.3rem !important;
        padding: 0.2rem 0.2rem !important;
        text-align: justify;
        font-weight: bold;
        display: block;
        word-wrap: break-word;

    } */
</style>
<!-- NAVBAR -->
<div class="navbar navbar-dark navbar-expand-md" id="main-nav">
    <div class="container">

        <!-- logo -->
        <a href="<?php echo BASE_URL . '/' . 'visitor/home.php'; ?>" class="navbar-brand h1 m-0 me-3 <?php if ($current_page_isHome) {
                                                                                                            echo "active";
                                                                                                        } ?>"><img id="nav-logo" src="<?php echo BASE_URL . '/' . 'nav/travis-light.svg'; ?>" alt="" srcset=""></a>

        <!-- hamburger button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navLink">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav links -->
        <div class="collapse navbar-collapse" id="navLink">

            <!-- VISITOR -->
            <div class="navbar-nav me-auto">
                <!-- home page link -->
                <div class="nav-item">
                    <!-- add active class when at home.php -->
                    <a class="nav-link fw-bold me-2 <?php if ($current_page_isHome) {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'visitor/home.php'; ?>">Home</a>
                </div>
                <!-- crop page link -->
                <div class="nav-item fw-bold me-2">
                    <!-- add active class when at crop.php -->
                    <a class="nav-link <?php if ($current_page_isCrop) {
                                            echo "active";
                                        } ?>" href="<?php echo BASE_URL . '/' . 'visitor/crop.php'; ?>">Crops</a>
                </div>

                <!-- about -->
                <div class="nav-item fw-semibold me-2 dropdown">
                    <a id="abt-nav" class="nav-link dropdown-toggle <?php if ($current_page_isAbout) {
                                                                        echo "active";
                                                                    } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">About
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="abt-nav">
                        <!-- sarangani -->
                        <li>
                            <a href="<?= BASE_URL . '/' . 'visitor/about/sar.php' ?>" class="dropdown-item">
                                Sarangani
                            </a>
                        </li>
                        <!-- collaborators -->
                        <li>
                            <a href="<?= BASE_URL . '/' . 'visitor/about/collab.php' ?>" class="dropdown-item">
                                Collaborators
                            </a>
                        </li>
                        <!-- travis -->
                        <li>
                            <a href="<?= BASE_URL . '/' . 'visitor/about/travis.php' ?>" class="dropdown-item">
                                TRAVIS
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- help -->
                <div class="nav-item">
                    <!-- add active class when at home.php -->
                    <a class="nav-link fw-bold me-2 <?php if ($current_page_isHelp) {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'visitor/help/intro.php'; ?>">Help</a>
                </div>

            </div>
            <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                <!-- ADMIN -->
                <ul class="navbar-nav">

                    <!-- my crops -->
                    <div class="nav-item fw-semibold me-2 contributor-only">
                        <a class="nav-link fw-bold me-2 <?php if ($current_page_isSubmission) {
                                                            echo "active";
                                                        } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'contributor/submission-page/submission.php'; ?>">My Listings</a>
                    </div>

                    <!-- crop management -->
                    <div class="nav-item fw-semibold me-2 dropdown curator-only">

                        <a href="" id="mng-nav" class="nav-link dropdown-toggle <?php if ($current_page_isManagement) {
                                                                                    echo "active";
                                                                                } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Crop Management
                            <!-- <span class="count rounded-circle" style="color:red;"></span> -->
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="mng-nav">
                            <li>
                                <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/crop-page/crop.php'; ?>">All Crops <span class="count" style="color:red;"></span></a>
                            </li>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/pending.php'; ?>">Pending <span class="count" style="color:red;"></span></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/approved.php'; ?>">Approved</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/rejected.php'; ?>">Rejected</a>
                            </li>
                        </ul>
                    </div>

                    <!-- settings -->
                    <div class="nav-item fw-semibold me-4 dropdown admin-only">

                        <a href="#" id="set-nav" class="nav-link dropdown-toggle <?php if ($current_page_isSettings) {
                                                                                        echo "active";
                                                                                    } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                            <!-- <span class="count2" style="color:red;"></span> -->
                        </a>

                        <ul id="set-nav-menu" class="dropdown-menu  dropdown-menu-md-end">

                            <!-- crop settings -->
                            <li class="dropend">
                                <button id="set-nav-crop" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                    Crop Settings
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="set-nav-crop">
                                    <!-- <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/crop-category.php'; ?>" class="dropdown-item">Crop Category</a></li> -->
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/category-variety.php'; ?>" class="dropdown-item">Crop Variety</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/terrain.php'; ?>" class="dropdown-item">Terrain</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/disease-resistance.php'; ?>" class="dropdown-item">Diseases</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/pest-resistance.php'; ?>" class="dropdown-item">Pests</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/abiotic-resistance.php'; ?>" class="dropdown-item">Abiotic Resistance</a></li>

                                </ul>
                            </li>

                            <!-- location settings -->
                            <li class="dropend">
                                <button id="set-nav-loc" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                    Location Settings
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="set-nav-loc">
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/location-page/municipality.php'; ?>" class="dropdown-item">Municipality</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/location-page/barangay.php'; ?>" class="dropdown-item">Barangay</a></li>
                                </ul>
                            </li>

                            <!-- user accounts -->
                            <li class="dropend">
                                <button id="set-nav-usr" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                    User Account
                                    <span class="count2" style="color:red;"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="set-nav-usr">
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/user-page/partners.php'; ?>" class="dropdown-item">Users</a></li>
                                    <li><a href="<?php echo BASE_URL . '/' . 'contributor/user-page/verify-user.php'; ?>" class="dropdown-item">Verification <span class="count2" style="color:red;"></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <?php if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Contributor') : ?>
                        <!-- notification -->
                        <div class="nav-item dropdown me-0">
                            <a class="nav-link dropdown-toggle" role="button" id="notif" data-bs-toggle="dropdown" aria-expanded="false">

                                <i class="fa-solid fa-bell"></i>
                                <?php if ($count_active != 0) { ?>
                                    <div class="round" data-value="<?= $count_active ?>"><?= $count_active ?></div>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-md-end notif-menu" aria-labelledby="notif" id="list">
                                <?php if (count($notifications_data) > 0) { ?>
                                    <?php foreach ($notifications_data as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        // Convert the string to a DateTime object
                                        if (!empty($notification['notification_date'])) {
                                            $date = new DateTime($notification['notification_date']);
                                            // Format the date to display up to the minute
                                            $formatted_date = $date->format('m-d-Y H:i');
                                        }
                                        ?>
                                        <li class="message" data-id="<?= $notification['notification_id']; ?>">
                                            <a href="<?php echo BASE_URL . '/nav/deactivate.php?notification_id=' . $notification['notification_id']; ?>" class="dropdown-item d-flex flex-column">
                                                <span><?= $notification['notification_name'] ?></span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="msg fw-normal small-font text-truncate"><?= $notification['message'] ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php foreach ($deactive_notifications_dump as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        // Convert the string to a DateTime object
                                        if (!empty($notification['notification_date'])) {
                                            $date = new DateTime($notification['notification_date']);
                                            // Format the date to display up to the minute
                                            $formatted_date = $date->format('m-d-Y H:i');
                                        }
                                        ?>
                                        <li class="message" data-id="<?= $notification['notification_id']; ?>">
                                            <a href="<?php echo BASE_URL . '/' . 'contributor/submission-page/submission.php'; ?>" class="dropdown-item d-flex flex-column">
                                                <span><?= $notification['notification_name'] ?></span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="msg fw-normal small-font text-truncate"><?= $notification['message'] ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Curator') : ?>
                        <!-- notification -->
                        <div class="nav-item dropdown me-0">
                            <a class="nav-link dropdown-toggle" role="button" id="notif" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                                <?php if ($count_activeCurator != 0) { ?>
                                    <div class="round" data-value="<?= $count_activeCurator ?>"><?= $count_activeCurator ?></div>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-md-end notif-menu" aria-labelledby="notif" id="list">
                                <?php if (count($notifications_dataCurator) > 0) { ?>
                                    <?php foreach ($notifications_dataCurator as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        // Convert the string to a DateTime object
                                        if (!empty($notification['notification_date'])) {
                                            $date = new DateTime($notification['notification_date']);
                                            // Format the date to display up to the minute
                                            $formatted_date = $date->format('m-d-Y H:i');
                                        }
                                        ?>
                                        <li class="message" data-id="<?= $notification['notification_id']; ?>">
                                            <a href="<?php echo BASE_URL . '/nav/deactivate.php?notification_id=' . $notification['notification_id']; ?>" class="dropdown-item d-flex flex-column">
                                                <span class="fw-bold fs-6">"<?= $notification['crop_variety'] ?>"</span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="msg fw-normal small-font text-truncate"><?= $notification['action'] ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php foreach ($deactive_notifications_dumpCurator as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        // Convert the string to a DateTime object
                                        if (!empty($notification['notification_date'])) {
                                            $date = new DateTime($notification['notification_date']);
                                            // Format the date to display up to the minute
                                            $formatted_date = $date->format('m-d-Y H:i');
                                        }
                                        ?>
                                        <li class="message" data-id="<?= $notification['notification_id']; ?>">
                                            <a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/crop.php'; ?>" class="dropdown-item d-flex flex-column">
                                                <span class="fw-bold fs-6">"<?= $notification['crop_variety'] ?>"</span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="msg fw-normal small-font text-truncate"><?= $notification['action'] ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Admin') : ?>
                        <!-- notification -->
                        <div class="nav-item dropdown me-0">
                            <a class="nav-link dropdown-toggle" role="button" id="notif" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                                <?php
                                $total_notifications = count($notifications_dataAdmin);
                                if ($total_notifications != 0) { ?>
                                    <div class="round" data-value="<?= $total_notifications ?>"><?= $total_notifications ?></div>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-md-end notif-menu" aria-labelledby="notif" id="list">
                                <?php if (!empty($notifications_dataAdmin)) { ?>
                                    <?php foreach ($notifications_dataAdmin as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        $formatted_date = $date->format('m-d-Y H:i');

                                        // Determine the link based on the notification type
                                        if ($notification['type'] === 'crop') {
                                            $link = BASE_URL . '/nav/deactivate.php?notification_id=' . $notification['id'];
                                        } else {
                                            $link = BASE_URL . '/nav/deactivate_user.php?notification_user_id=' . $notification['id'];
                                        }
                                        ?>
                                        <li class="message" data-id="<?= htmlspecialchars($notification['id']); ?>">
                                            <a href="<?= $link ?>" class="row dropdown-item d-flex flex-column p-0 m-0">
                                                <span class="fw-bold fs-6"><?= htmlspecialchars($notification['name']); ?></span>
                                                <div class="d-flex justify-content-between ">
                                                    <div class="msg fw-normal small-font text-truncate"><?= htmlspecialchars($notification['notification_name']); ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php foreach ($deactive_notifications_dumpAdmin as $notification) { ?>
                                        <?php
                                        // Convert the string to a DateTime object
                                        $date = new DateTime($notification['notification_date']);
                                        // Format the date to display up to the minute
                                        $formatted_date = $date->format('m-d-Y H:i');

                                        // Determine the link based on the notification type
                                        if ($notification['type'] === 'crop') {
                                            $link = BASE_URL . '/' . 'contributor/crop-page/crop.php'; // Adjust as necessary for deactivated crop notifications
                                        } else {
                                            $link = BASE_URL . '/' . 'contributor/user-page/partners.php'; // Adjust as necessary for deactivated user notifications
                                        }
                                        ?>
                                        <li class="message" data-id="<?= htmlspecialchars($notification['id']); ?>">
                                            <a href="<?= $link ?>" class="dropdown-item d-flex flex-column">
                                                <span class="fw-bold fs-6"><?= htmlspecialchars($notification['name']); ?></span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="msg fw-normal small-font text-truncate"><?= htmlspecialchars($notification['notification_name']); ?></div>
                                                    <div class="small-font fw-normal text-secondary"><?= $formatted_date ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- user profile -->
                    <div class="nav-item fw-semibold me-2 dropdown">
                        <a href="" id="profile-btn" class="nav-link dropdown-toggle  <?php if ($current_page_isProfile) {
                                                                                            echo "active";
                                                                                        } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-md-end">

                            <!-- login info -->
                            <li>
                                <a href="<?php echo BASE_URL . '/' . 'login/profile.php'; ?>" class="dropdown-item d-flex align-items-center pb-2">
                                    <i class="fa-solid fa-address-card me-2" style="width:20px"></i>
                                    <div>
                                        <div class="small-font">Logged In as</div>
                                        <div class="fw-semibold"><strong><?= $_SESSION['USER']['first_name']; ?></strong></div>
                                    </div>
                                </a>
                            </li>

                            <!-- settings -->
                            <li>
                                <a href="<?php echo BASE_URL . '/' . 'login/profile.php'; ?>" class="dropdown-item" class="dropdown-item"><i class="fa-solid fa-gears me-2"></i>Settings</a>
                            </li>

                            <li class="dropdown-divider m-0"></li>

                            <!-- logout -->
                            <li>
                                <a href="<?php echo BASE_URL . '/' . 'login/logout.php'; ?>" id="logout-link" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2" style="width:20px"></i>Logout</a>
                            </li>
                        </ul>
                    </div>

                </ul>
            <?php endif; ?>
            <?php if (!isset($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN']) : ?>
                <!-- VISITOR -->
                <a id="contributor-link" href="<?php echo BASE_URL . '/' . 'login/register.php'; ?>" class="link-light link-offset-3 link-underline link-underline-opacity-0 rounded-pill px-3 py-2">Be a Contributor!</a>
                &nbsp;&nbsp; <!-- Add space here -->
                <a id="contributor-link" href="<?php echo BASE_URL . '/' . 'login/login.php'; ?>" class="link-light link-offset-3 link-underline link-underline-opacity-0 rounded-pill px-3 py-2">Login</a>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- script for access control -->
<script src="<?php echo BASE_URL . '/js/access-control.js'; ?>" defer></script>
<!-- script for access js -->
<script src="<?php echo BASE_URL . '/js/access.js'; ?>" defer></script>

<!-- script for notification bell -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.message', function(e) {
            let notificationId = $(this).data('id');
            console.log("yeah");
            console.log(notificationId);
            e.stopPropagation(); // Prevents the dropdown from closing if that's an issue
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.message', function(e) {
            console.log("clicked");
            e.preventDefault();
            let notificationId = $(this).data('id');

            $.ajax({
                url: '<?php echo BASE_URL . '/nav/deactivate.php'; ?>',
                type: 'POST',
                data: {
                    id: notificationId
                },
                success: function(response) {
                    console.log(response);
                    if (response.trim() === 'success') {
                        location.reload();
                    } else {
                        alert('Failed to update notification');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $(document).on('click', '.message_user', function(e) {
            console.log("clicked user");
            e.preventDefault();
            let notificationId = $(this).data('id');

            $.ajax({
                url: '<?php echo BASE_URL . '/nav/deactivate_user.php'; ?>',
                type: 'POST',
                data: {
                    id: notificationId
                },
                success: function(response) {
                    console.log(response);
                    if (response.trim() === 'success') {
                        location.reload();
                    } else {
                        alert('Failed to update notification');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>