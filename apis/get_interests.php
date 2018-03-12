<?php

if (isset ($_GET['userID'])) {

    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();
    $userID = $_GET['userID'];

    $result = mysqli_query ($conn, "SELECT * FROM interests WHERE userID = $userID");

    if (!empty ($result)) {
        // check for empty result
        if (mysqli_num_rows ($result) > 0) {

            $user = mysqli_fetch_assoc ($result);

            $response = array ();
            $response["success"] = 1;
            $ints = array();

            foreach ($user as $key => $value) {
                if( $value == 1 ){
                    array_push($ints, $key);
                }
            }
            
            //$response["ints"] = array ();
            $response["interests"] = $ints;
            echo json_encode ($response);
            
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode ($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode ($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (userID) is missing!";
    echo json_encode ($response);
}
?>
