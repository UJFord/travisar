<?php
$localhost = 'localhost';
$dbname = 'farm_crops';
$user = 'postgres';
$password = '123';

$conn = pg_connect("host=$localhost dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo "An error occured";
    exit;
}
?>