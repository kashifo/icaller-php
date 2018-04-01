<?php

if (isset ($_POST['userID']) && isset ($_POST['interests'])) {

    $userID = $_POST['userID'];
    $interests = $_POST['interests'];
    $interestArray = json_decode ($interests);
    $arraySize = sizeof ($interestArray);

    //SELECT * from users WHERE id IN ( SELECT userID FROM interests WHERE JavaScript OR Android IS NOT NULL );

    $sql = "SELECT id, name, gender, dob, country, area, bio from users WHERE id IN ( SELECT userID FROM interests WHERE ";

    for ($i = 0; $i < $arraySize; $i++) {
        $sql .= "`$interestArray[$i]` = 1 ";
        if ($i < $arraySize - 1)
            $sql .= " OR ";
    }

    $sql .= " );";
    //echo $sql;

    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();

    $result = mysqli_query ($conn, $sql);

    if (!empty ($result)) {
        // check for empty result
        if (mysqli_num_rows ($result) > 0) {

            $count = mysqli_num_rows ($result);
            // success
            $response["success"] = 1;
            $response["message"] = "$count users found";
            $response["users"] = array ();

            while ($row = mysqli_fetch_assoc ($result)) {
                //array_push ($response["users"] , $row);

                if ($row['id'] != $userID) {

                    $user = array ();
                    $user = $row;

                    $ints = array ();
                    $result2 = mysqli_query ($conn, "SELECT * FROM interests WHERE userID = $row[id]");

                    if (!empty ($result2)) {
                        // check for empty result
                        if (mysqli_num_rows ($result2) > 0) {

                            $row2 = mysqli_fetch_assoc ($result2);

                            foreach ($row2 as $key => $value) {
                                if ($value == 1) {
                                    array_push ($ints, $key);
                                }
                            }
                        }
                    }

                    // interests node
                    $user["interests"] = $ints;
                    array_push ($response["users"], $user);
                }
            }

            echo json_encode ($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No user found for your interests";

            // echo no users JSON
            echo json_encode ($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No user found for your interests";

        // echo no users JSON
        echo json_encode ($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode ($response);
}
?>
