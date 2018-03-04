<?php

require_once '../include/DB_Connect.php';
// connecting to database
$db = new Db_Connect();
$conn = $db->connect ();

$result = mysqli_query ($conn, "SELECT * FROM users");

if (!empty ($result)) {
    // check for empty result
    if (mysqli_num_rows ($result) > 0) {

        $user = mysqli_fetch_array ($result);
        $count = mysqli_num_rows($result);
        // success
        $response["success"] = 1;
        $response["message"] = "$count users found";
        $response["users"] = array ();

        while ($row = mysqli_fetch_assoc ($result)) {
            array_push ($response["users"] , $row);
        }

        echo json_encode ($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No users found";

        // echo no users JSON
        echo json_encode ($response);
    }
} else {
    // no product found
    $response["success"] = 0;
    $response["message"] = "No users found";

    // echo no users JSON
    echo json_encode ($response);
}
?>
