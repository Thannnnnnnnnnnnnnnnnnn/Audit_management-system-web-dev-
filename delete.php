<?php
include("connections.php");

if(isset($_GET['id'])) {
    $audit_id = $_GET['id'];

    $query = "DELETE FROM `dashboard_db` WHERE audit_id = '$audit_id'";

    if(mysqli_query($connection, $query)) {
       
        header("Location: admin.php");
        exit(); 
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "Audit ID not provided";
}
?>
