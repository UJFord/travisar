<!-- STYLESHEET -->
<!-- custom -->
<link rel="stylesheet" href="../css/staff/nav.css">

<!-- MARKUP -->
<nav class="navbar navbar-expand-md border-bottom border-body" data-bs-theme="dark">
    <div class="container">
        <!-- brand and navs -->
        <a class="navbar-brand text-white" href="#"><i class="bi bi-crop"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-md-flex justify-content-md-between" id="navbarNav">
            <ul class="navbar-nav fw-bold">
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="#">Crop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Approval</a>
                </li>
            </ul>
            <!-- profile -->
            <div id="profile-container" class="dropdown">
                <!-- button -->
                <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                    <!-- profile icon -->
                    <div id="profile-icon-container" class="me-1">
                        <div id="profile-icon" class="profile-thumbnail rounded-circle" style="background-image: url('https://images.unsplash.com/photo-1504473114289-43f5e302d6bb?q=80&w=2151&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        </div>
                    </div>
                    <!-- caret icon -->
                    <i id="profile-drop-icon" class="bi bi-caret-down"></i>
                </div>
                <!-- dropdown actions -->
                <ul id="profile-actions-container" class="overflow-hidden dropdown-menu dropdown-menu-end bg-white border border-secondary-subtle p-0">
                    <!-- login status -->
                    <li>
                        <a href="#" class="dropdown-item border-bottom px-3 pe-3 d-flex align-items-center">
                            <!-- profile thumnail -->
                            <div id="login-status-thumbnail" class="profile-thumbnail rounded-circle me-2" style="background-image: url('https://images.unsplash.com/photo-1504473114289-43f5e302d6bb?q=80&w=2151&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
                            <!-- login status -->
                            <div class="d-flex flex-column justify-content-center text-dark">
                                <span class="fs-6 fw-semibold">Logged in as</span>
                                <!-- username -->
                                <span id="actions-username" class=" fs-6 text-secondary">John Doe</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item border-bottom text-dark fs-6 d-flex justify-content-start align-items-center px-3 pe-3">
                            <i class="fa-regular fa-user me-2 fs-6 text-dark"></i>
                            <p class="m-0">Account settings</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item text-dark fs-6 d-flex justify-content-start align-items-center px-3 pe-3">
                            <i class="fa-solid fa-arrow-right-from-bracket me-2 fs-6 text-dark"></i>
                            <p class="m-0">Log Out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</nav>