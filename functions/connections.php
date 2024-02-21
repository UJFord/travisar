<?php
$localhost = 'localhost';
$dbname = 'farm_crops';
$user = 'postgres';
$password = '123';

$connection = pg_connect("host=$localhost dbname=$dbname user=$user password=$password");
if (!$connection) {
    echo "An error occured";
    exit;
}
?>