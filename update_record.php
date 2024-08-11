<?php
include("connections.php");

// Check if all required POST parameters are provided
if(isset($_POST['editAuditID'], $_POST['editDescription'], $_POST['editNameTeam'], $_POST['editDepartment'], $_POST['editTime'], $_POST['editDate'])) {

    $audit_id = mysqli_real_escape_string($connection, $_POST['editAuditID']);
    $description = mysqli_real_escape_string($connection, $_POST['editDescription']);
    $name_team = mysqli_real_escape_string($connection, $_POST['editNameTeam']);
    $department = mysqli_real_escape_string($connection, $_POST['editDepartment']);
    $Time = mysqli_real_escape_string($connection, $_POST['editTime']);
    $Date = mysqli_real_escape_string($connection, $_POST['editDate']);


    $query = "UPDATE `dashboard_db` SET description = '$description', name_team = '$name_team', department = '$department', Time = '$Time', Date = '$Date' WHERE audit_id = '$audit_id'";
    $result = mysqli_query($connection, $query);

    if($result) {

        echo '<script>alert("Record updated successfully");</script>';
    } else {

        echo '<script>alert("Error updating record. Please try again.");</script>';
    }
} else {

    echo '<script>alert("Missing required parameters.");</script>';
}
?>
