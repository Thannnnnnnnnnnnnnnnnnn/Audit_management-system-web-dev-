<?php
include("connections.php");

if(isset($_POST['audit_id'])) {
    $audit_id = $_POST['audit_id'];

    $query = "SELECT * FROM `dashboard_db` WHERE audit_id = '$audit_id'"; 
    $result = mysqli_query($connection, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'Record not found'));
    }
} else {
    echo json_encode(array('error' => 'Audit ID not provided'));
}
?>
