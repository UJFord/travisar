<?php
require "../functions/connections.php";

// Define the base URL of your local server
define('BASE_URL', 'http://localhost/travisar');

//get current page to choose the active link
// current page path
$current_page_path = strtok($_SERVER['REQUEST_URI'], '?');


// current page html boolean
$current_page_isHome = false;
$current_page_isCrop = false;
$current_page_isAbout = false;
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
        $current_page_isAbout = true;
    case "/travisar/visitor/about/collab.php":
        $current_page_isAbout = true;
    case "/travisar/visitor/about/travis.php":
        $current_page_isAbout = true;
        break;

    case "/travisar/visitor/crop.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/corn.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/all.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/rice.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/root.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/view.php":
        $current_page_isCrop = true;
        break;

    case "/travisar/contributor/crop-page/category-variety.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/crop-category.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/abiotic-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/disease-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/pest-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/location-page/municipality.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/location-page/barangay.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/user-page/partners.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/user-page/verify-user.php":
        $current_page_isSettings = true;
        break;

    case "/travisar/contributor/submission-page/submission.php":
        $current_page_isSubmission = true;
        break;

    case "/travisar/contributor/crop-page/crop.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/contributor/approval-page/pending.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/contributor/approval-page/approved.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/contributor/approval-page/rejected.php":
        $current_page_isManagement = true;
        break;

    case "/travisar/login/profile.php":
        $current_page_isProfile = true;
        break;
}

// Fetch active notifications
$find_notifications = "SELECT * FROM notification WHERE active = true";
$result = pg_query($conn, $find_notifications);
if (!$result) {
    die("Error in query: " . pg_last_error());
}

$count_active = '';
$notifications_data = array();
$deactive_notifications_dump = array();
$count_active = pg_num_rows($result);
while ($rows = pg_fetch_assoc($result)) {
    $notifications_data[] = array(
        "notification_id" => $rows['notification_id'],
        "notification_name" => $rows['notification_name'],
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
        "message" => $rows['message']
    );
}
?>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?php echo BASE_URL . '/nav/assets/js/jquery.min.js'; ?>" defer></script>
<script src="<?php echo BASE_URL . '/nav/assets/js/bootstrap.min.js'; ?>" defer></script>

<!-- function for notification for approval of crops and users -->
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
    .round {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: relative;
        background: red;
        display: inline-block;
        padding: 0.3rem 0.2rem !important;
        margin: 0.3rem 0.2rem !important;
        left: -18px;
        top: 10px;
        z-index: 99 !important;
    }

    .round>span {
        color: white;
        display: block;
        text-align: center;
        font-size: 1rem !important;
        padding: 0 !important;
    }

    .message>span {
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
        /* background:#ff7f50;
        margin:0.3rem 0.2rem !important;
        padding:0.2rem 0 !important;
        width:100%;
        display:block; */
    }

    .message>.msg {
        width: 90%;
        margin: 0.2rem 0.3rem !important;
        padding: 0.2rem 0.2rem !important;
        text-align: justify;
        font-weight: bold;
        display: block;
        word-wrap: break-word;

    }
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
                    <ul class="nav navbar-nav navbar-right">
                        <li><i class="fa fa-bell" id="over" data-value="<?php echo $count_active; ?>" style="z-index:-99 !important;font-size:32px;color:white;margin:0.5rem 0.4rem !important;"></i></li>
                        <?php if (!empty($count_active)) { ?>
                            <div class="round" id="bell-count" data-value="<?php echo $count_active; ?>"><span><?php echo $count_active; ?></span></div>
                        <?php } ?>

                        <?php if (!empty($count_active)) { ?>
                            <div id="list">
                                <?php
                                foreach ($notifications_data as $list_rows) { ?>
                                    <li id="message_items">
                                        <div class="message alert alert-warning" data-id=<?php echo $list_rows['notification_id']; ?>>
                                            <span><?php echo $list_rows['notification_name']; ?></span>
                                            <div class="msg">
                                                <p><?php
                                                    echo $list_rows['message'];
                                                    ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            </div>
                        <?php } else { ?>
                            <!--old Messages-->
                            <div id="list">
                                <?php
                                foreach ($deactive_notifications_dump as $list_rows) { ?>
                                    <li id="message_items">
                                        <div class="message alert alert-danger" data-id=<?php echo $list_rows['notification_id']; ?>>
                                            <span><?php echo $list_rows['notification_name']; ?></span>
                                            <div class="msg">
                                                <p><?php
                                                    echo $list_rows['message'];
                                                    ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                                <!--old Messages-->

                            <?php } ?>

                            </div>
                    </ul>

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
        var ids = new Array();
        $('#over').on('click', function() {
            $('#list').toggle();
        });

        //Message with Ellipsis
        $('div.msg').each(function() {
            var len = $(this).text().trim(" ").split(" ");
            if (len.length > 12) {
                var add_elip = $(this).text().trim().substring(0, 65) + "…";
                $(this).text(add_elip);
            }

        });


        $("#bell-count").on('click', function(e) {
            e.preventDefault();

            let belvalue = $('#bell-count').attr('data-value');

            if (belvalue == '') {

                console.log("inactive");
            } else {
                $(".round").css('display', 'none');
                $("#list").css('display', 'block');

                // $('.message').each(function(){
                // var i = $(this).attr("data-id");
                // ids.push(i);

                // });
                //Ajax
                $('.message').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: './connection/deactive.php',
                        type: 'POST',
                        data: {
                            "id": $(this).attr('data-id')
                        },
                        success: function(data) {

                            console.log(data);
                            location.reload();
                        }
                    });
                });
            }
        });
    });
</script>