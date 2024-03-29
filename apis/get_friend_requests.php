<?php

if (isset ($_GET['userID']) ) {
    
require_once '../include/DB_Connect.php';
// connecting to database
$db = new Db_Connect();
$conn = $db->connect ();

$userID = $_GET['userID'];
$sql = "SELECT id, name, gender, dob, country, area, bio from users WHERE id = ( SELECT actionUser FROM friends WHERE ( userOne=$userID  OR userTwo=$userID ) AND status = 0 AND actionUser != $userID);";
$result = mysqli_query ($conn, $sql);


if (!empty ($result)) {
    // check for empty result
    if (mysqli_num_rows ($result) > 0) {

        $count = mysqli_num_rows($result);
        // success
        $response["success"] = 1;
        $$response["count"] = "$count";
        $$response["message"] = "$count friends requests";
        $response["users"] = array ();

        while ($row = mysqli_fetch_assoc ($result)) {
            array_push ($response["users"] , $row);
        }

        echo json_encode ($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No friend requests";

        // echo no users JSON
        echo json_encode ($response);
    }
} else {
    // no product found
    $response["success"] = 0;
    $response["message"] = "No friend requests";

    // echo no users JSON
    echo json_encode ($response);
}

}
?>
