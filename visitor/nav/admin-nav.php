<ul class="navbar-nav">

    <!-- all crops -->
    <div class="nav-item me-2">
        <a href="" class="nav-link">All Crops</a>
    </div>

    <!-- my crops -->
    <div class="nav-item fw-semibold me-2">
        <a href="" class="nav-link">My Crops</a>
    </div>

    <!-- crop management -->
    <div class="nav-item fw-semibold me-2 dropdown">

        <a href="" id="mng-nav" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Crop Management
        </a>

        <ul class="dropdown-menu" aria-labelledby="mng-nav">
            <li><a href="" class="dropdown-item">Pending</a></li>
            <li><a href="" class="dropdown-item">Approved</a></li>
            <li><a href="" class="dropdown-item">Rejected</a></li>
        </ul>
    </div>

    <!-- settings -->
    <div class="nav-item fw-semibold me-4 dropdown">

        <a href="#" id="set-nav" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Settings
        </a>

        <ul id="set-nav-menu" class="dropdown-menu  dropdown-menu-md-end">

            <!-- crop settings -->
            <li class="dropend">
                <button id="set-nav-crop" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                    Crop Settings
                </button>
                <ul class="dropdown-menu" aria-labelledby="set-nav-crop">
                    <li><a href="#" class="dropdown-item">Crop Category</a></li>
                    <li><a href="#" class="dropdown-item">Category Variety</a></li>
                    <li><a href="#" class="dropdown-item">Abiotic Resistance</a></li>
                    <li><a href="#" class="dropdown-item">Disease Resistance</a></li>
                    <li><a href="#" class="dropdown-item">Pest Resistance</a></li>
                </ul>
            </li>

            <!-- location settings -->
            <li class="dropend">
                <button id="set-nav-loc" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                    Location Settings
                </button>
                <ul class="dropdown-menu" aria-labelledby="set-nav-loc">
                    <li><a href="#" class="dropdown-item">Barangay</a></li>
                    <li><a href="#" class="dropdown-item">Municipality</a></li>
                </ul>
            </li>

            <!-- user accounts -->
            <li class="dropend">
                <button id="set-nav-usr" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                    User Account
                </button>
                <ul class="dropdown-menu" aria-labelledby="set-nav-usr">
                    <li><a href="#" class="dropdown-item">Users</a></li>
                    <li><a href="#" class="dropdown-item">Verification</a></li>
                </ul>
            </li>

        </ul>
    </div>


    <!-- user profile -->
    <div class="nav-item fw-semibold me-2 dropdown">
        <a href="" id="profile-btn" class="nav-link dropdown-toggle d-" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-md-end">

            <!-- login info -->
            <li>
                <a href="" class="dropdown-item d-flex align-items-center pb-2">
                    <i class="fa-solid fa-address-card me-2" style="width:20px"></i>
                    <div>
                        <div class="small-font">Logged In as</div>
                        <div class="fw-semibold">John Doe</div>
                    </div>
                </a>
            </li>

            <!-- settings -->
            <li>
                <a href="" class="dropdown-item"><i class="fa-solid fa-gears me-2"></i>Settings</a>
            </li>

            <li class="dropdown-divider m-0"></li>

            <!-- logout -->
            <li>
                <a href="" id="logout-link" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2" style="width:20px"></i>Logout</a>
            </li>
        </ul>
    </div>

</ul>