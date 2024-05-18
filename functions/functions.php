<script>
    <?php
    // Function for signup
    function signup($data)
    {
        $errors = array();

        // Retrieve account type
        $accountTypeQuery = "SELECT * FROM account_type WHERE type_name = 'Contributor'";
        $accountTypeResult = database_run($accountTypeQuery);

        if ($accountTypeResult) {
            $user = $accountTypeResult[0];
            $account_type_id = $user['account_type_id'];

            // Save user data
            if (
                count($errors) == 0
            ) {
                $arr = array(
                    ':first_name' => $data['first_name'],
                    ':last_name' => $data['last_name'],
                    ':gender' => $data['gender'],
                    ':username' => $data['username'],
                    ':email' => $data['email'],
                    ':contact_num' => $data['contact_num'],
                    ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    ':affiliation' => $data['affiliation'],
                    ':affiliated_email' => $data['affiliated_email'],
                    ':affiliated_contact_num' => $data['affiliated_contact_num'],
                    ':account_type_id' => $account_type_id
                );

                $query = "
                INSERT INTO users (first_name, last_name, gender, username, email, password, affiliation, account_type_id, contact_num, affiliated_email, affiliated_contact_num) 
                VALUES (:first_name, :last_name, :gender, :username, :email, :password, :affiliation, :account_type_id, :contact_num, :affiliated_email, :affiliated_contact_num)
                RETURNING user_id";

                $result = database_run($query, $arr);

                if ($result) {
                    // Fetch the newly created user's ID
                    $user_id = $result[0]['user_id'];

                    // Prepare notification details
                    $notification_name = 'User created need verification.';
                    $message = 'User ' . $data['first_name'] . ' ' . $data['last_name'] . ' is created.';
                    $active = '1';

                    // Insert notification
                    $notificationQuery = "
                    INSERT INTO notification_user (notification_name, message, active, user_id)
                    VALUES (:notification_name, :message, :active, :user_id)";

                    $notificationData = array(
                        ':notification_name' => $notification_name,
                        ':message' => $message,
                        ':active' => $active,
                        ':user_id' => $user_id
                    );

                    $notificationResult = database_run($notificationQuery, $notificationData);

                    if (!$notificationResult) {
                        echo "Error inserting notification.";
                    }
                } else {
                    $errors[] = "Error saving user data";
                }
            }
        } else {
            $errors[] = "Error retrieving account type";
        }

        return $errors;
    }

    // Function for login
    function login($data)
    {
        $errors = array();

        // Check
        if (count($errors) == 0) {
            $email = $data['email'];
            $providedPassword = $data['password'];

            $query = "SELECT users.user_id, users.password, users.first_name, users.email, users.email_verified, account_type.type_name  
                FROM users 
                LEFT JOIN account_type ON users.account_type_id = account_type.account_type_id 
                WHERE email = :email 
                LIMIT 1";

            $row = database_run($query, array(':email' => $email));

            if (!empty($row) && password_verify($providedPassword, $row[0]['password'])) {
                // Check if the user's email is verified
                if ($row[0]['email_verified'] == $email) {
                    // Only store essential information in the session
                    $_SESSION['USER']['user_id'] = $row[0]['user_id'];
                    $_SESSION['USER']['first_name'] = $row[0]['first_name'];
                    $_SESSION['USER']['email'] = $row[0]['email'];
                    $_SESSION['rank'] = $row[0]['type_name'];
                    $_SESSION['LOGGED_IN'] = true;
                } else {
                    // Email is not verified
                    $errors[] = "<div class='error text-center'>Email is not verified. Please verify your email first.</div>";
                }
            } else {
                // Email or Password did not match
                $errors[] = "<div class='error text-center'>Email or Password did not match.</div>";
            }
        }

        return $errors;
    }

    // Function to connect to db and run queries
    function database_run($query, $vars = array())
    {
        $dsn = "pgsql:host=localhost dbname=farm_crops user=postgres password=123";

        try {
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $pdo->prepare($query);
            $check = $stm->execute($vars);

            if ($check) {
                // Check if it's a SELECT query before attempting to fetch data
                if ($stm->columnCount() > 0) {
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                } else {
                    // If it's not a SELECT query, return true for success
                    return true;
                }
            }

            return false;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Function to generate pagination links for the crop page
    function generatePaginationLinks($total_pages, $current_page, $pageQueryParam)
    {
        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        echo '<div class="d-flex justify-content-end mt-2"><ul class="pagination ">';

        // Previous page link
        $prevPage = ($current_page > 1) ? $current_page - 1 : 1;
        $urlPrev = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $prevPage, 'search' => $search]));
        echo    '<li class="page-item">
                <a class="page-link bg-light small-font link-dark fw-semibold" href="' . $urlPrev . '" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';

        // Page links
        for ($page = 1; $page <= $total_pages; $page++) {
            $activeClass = ($current_page == $page) ? 'active' : '';
            $url = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $page, 'search' => $search]));
            echo '<li class="page-item"><a class="' . $activeClass . ' page-link bg-light small-font link-dark fw-semibold" href="' . $url . '">' . $page . '</a></li>';
        }

        // Next page link
        $nextPage = ($current_page < $total_pages) ? $current_page + 1 : $total_pages;
        $urlNext = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $nextPage, 'search' => $search]));
        echo    '<li class="page-item">
                <a class="page-link bg-light small-font link-dark fw-semibold" href="' . $urlNext . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';

        echo '</ul></div>';
    }

    function generatePaginationLinksHome($total_pages, $current_page, $pageQueryParam)
    {
        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        echo '<ul class="pagination">';

        // Previous page link
        $prevPage = ($current_page > 1) ? $current_page - 1 : 1;
        $urlPrev = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $prevPage, 'search' => $search]));
        echo    '<li class="page-item">
                <a class="page-link bg-light small-font link-dark fw-semibold" href="' . $urlPrev . '" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';

        // Page links
        for ($page = 1; $page <= $total_pages; $page++) {
            $activeClass = ($current_page == $page) ? 'active' : '';
            $url = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $page, 'search' => $search]));
            echo '<li class="page-item"><a class="' . $activeClass . ' page-link bg-light small-font link-dark fw-semibold" href="' . $url . '">' . $page . '</a></li>';
        }

        // Next page link
        $nextPage = ($current_page < $total_pages) ? $current_page + 1 : $total_pages;
        $urlNext = '?' . http_build_query(array_merge($_GET, [$pageQueryParam => $nextPage, 'search' => $search]));
        echo    '<li class="page-item">
                <a class="page-link bg-light small-font link-dark fw-semibold" href="' . $urlNext . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';

        echo '</ul>';
    }
    ?>
</script>