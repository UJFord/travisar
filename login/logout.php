<?php
session_start();
require '../functions/connections.php';

?>

<?php
// Destroy session
session_destroy(); //  unsets $_SESSION['user']

// Redirect to login page
header('location:../login/login-form.php');
?>