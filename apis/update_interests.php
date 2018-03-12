<?php

if (isset ($_POST['userID']) && isset ($_POST['interests'])) {

    // receiving the post params
    $userID = $_POST['userID'];
    $interests = $_POST['interests'];
    $interestArray = json_decode ($interests);
    $arraySize = sizeof ($interestArray);

    $sql = "UPDATE interests SET ";

    for ($i = 0; $i < $arraySize; $i++) {
        $sql .= "`$interestArray[$i]` =1 ";
        if ($i < $arraySize - 1)
            $sql .= ", ";
    }

    $sql .= "WHERE userID = $userID";
    
    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();

    $result = mysqli_query ($conn, $sql);

    if ($result) {

        $response["success"] = 1;
        $response["message"] = "Interests successfully updated.";

        echo json_encode ($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Interest update failed.";

        echo json_encode ($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode ($response);
}
?>
