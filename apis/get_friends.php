<?php

if (isset ($_GET['userID'])) {

    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();
    $userID = $_GET['userID'];

    $sql = "SELECT * FROM friends WHERE ( userOne = $userID OR userTwo = $userID ) AND `status` = 1";
    $result = mysqli_query ($conn, $sql);

    if (!empty ($result)) {
        // check for empty result
        if (mysqli_num_rows ($result) > 0) {

            $count = mysqli_num_rows ($result);
            $friendIDS = "";
            $currentRecord = 1;

            while ($row = mysqli_fetch_assoc ($result)) {

                if ($userID != $row["userOne"]) {
                    
                    $friendIDS .= $row['userOne'];
                    
                } else if ($userID != $row["userTwo"]) {
                    
                    $friendIDS .= $row["userTwo"];
                    
                }

                if ($currentRecord < $count ) {
                    $friendIDS .= ",";
                }
                
                $currentRecord += 1;
            }

            //echo json_encode ($response);
            //get user data
            $sql = "SELECT * FROM users WHERE id IN ($friendIDS);";
            $result = mysqli_query ($conn, $sql);
            //echo $sql;

            if (!empty ($result)) {
                // check for empty result
                if (mysqli_num_rows ($result) > 0) {

                    $count = mysqli_num_rows ($result);
                    // success
                    $response["success"] = 1;
                    $response["message"] = "$count friends found";
                    $response["friends"] = array ();

                    while ($row = mysqli_fetch_assoc ($result)) {
                        array_push ($response["friends"], $row);
                    }

                    echo json_encode ($response);
                }

                //get user data
            } else {
                // no product found
                $response["success"] = 0;
                $response["message"] = "No friends found";

                // echo no users JSON
                echo json_encode ($response);
            }
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No friends found";

            // echo no users JSON
            echo json_encode ($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No friends found";

        // echo no users JSON
        echo json_encode ($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (userID) is missing!";
    echo json_encode ($response);
}
?>