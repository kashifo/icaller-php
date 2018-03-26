<?php

require_once '../include/DB_Connect.php';
// connecting to database
$db = new Db_Connect();
$conn = $db->connect ();

if (!$conn) {
    die ('Could not connect: ' . mysqli_error ());
} echo 'Connected successfully';

mysqli_close ($conn);

