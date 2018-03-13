<?php

if (isset ($_POST['senderID']) && isset ($_POST['receiverID'])) {

    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();

    // receiving the post params
    $senderID = $_POST['senderID'];
    $receiverID = $_POST['receiverID'];
    $userOne;
    $userTwo;

    if ($senderID < $receiverID) {
        $userOne = $senderID;
        $userTwo = $receiverID;
    } else {
        $userOne = $receiverID;
        $userTwo = $senderID;
    }

    $sql = "SELECT * FROM friends WHERE userOne=2 AND userTwo=3;";
    $result = mysqli_query ($conn, $sql);
    $status = 0;

    if (!empty ($result) && (mysqli_num_rows ($result) > 0)) {

        $record = mysqli_fetch_array ($result);
        $status = $record["status"];

        $sql = "UPDATE friends SET status=0, actionUser=$senderID WHERE userOne=$userOne AND userTwo=$userTwo;";
    } else {
        $sql = "INSERT INTO `friends`(`userOne`, `userTwo`, `status`, `actionUser`) VALUES ( $userOne, $userTwo, '0', $senderID );";
    }

    if ($status == 3) {

        $result = mysqli_query ($conn, $sql);

        if ($result) {

            $response["error"] = FALSE;
            $response["success"] = 1;
            $response["message"] = "Friend Request Sent";

            echo json_encode ($response);
        } else {
            echoFailed ();
        }
    } else {
        echoFailed ();
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode ($response);
}


function echoFailed () {
    $response["error"] = TRUE;
    $response["success"] = 0;
    $response["message"] = "Friend Request Failed";
    echo json_encode ($response);
}
?>

