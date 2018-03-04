<?php

if ( isset($_POST['userID']) ) {

    // receiving the post params
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $area = $_POST['area'];
    
    require_once '../include/DB_Connect.php';
    // connecting to database
    $db = new Db_Connect();
    $conn = $db->connect();
    
    $result = mysqli_query( $conn, "UPDATE users SET name = '$name', gender = '$gender', dob = '$dob', country = '$country', area = '$area' WHERE id = $userID");
        
        if ($result) {
            
            $response["success"] = 1;
            $response["message"] = "Profile successfully updated.";
        
            echo json_encode($response);
        } else {
            $response["success"] = 0;
            $response["message"] = "Profile update failed.";
        
            echo json_encode($response);
        }
        
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (userID) is missing!";
    echo json_encode($response);
}
?>

