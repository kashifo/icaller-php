<?php

if (isset ($_POST['interests'])) {

    $interests = $_POST['interests'];
    $interestArray = json_decode ($interests);
    $arraySize = sizeof ($interestArray);

    //SELECT * from users WHERE id IN ( SELECT userID FROM interests WHERE JavaScript OR Android IS NOT NULL );
    
    $sql = "SELECT * from users WHERE id IN ( SELECT userID FROM interests WHERE ";

    for ($i = 0; $i < $arraySize; $i++) {
        $sql .= "`$interestArray[$i]`";
        if ($i < $arraySize - 1)
            $sql .= " OR ";
    }

    $sql .= " IS NOT NULL );";
    //echo $sql;
    
    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect ();

    $result = mysqli_query ($conn, $sql);

    if (!empty ($result)) {
    // check for empty result
    if (mysqli_num_rows ($result) > 0) {

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
