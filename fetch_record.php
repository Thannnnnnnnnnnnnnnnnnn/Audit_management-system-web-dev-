<?php

include("connections.php");


if(isset($_GET['audit_id'])) {

    $audit_id = mysqli_real_escape_string($connection, $_GET['audit_id']);
    

    $query = "SELECT * FROM `dashboard_db` WHERE audit_id = '$audit_id'";
    $result = mysqli_query($connection, $query);
    

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $htmlContent = '
            <p><strong>Audit ID:</strong> '.$row['audit_id'].'</p>
            <p><strong>Description:</strong> '.$row['description'].'</p>
            <p><strong>Name of Team:</strong> '.$row['name_team'].'</p>
            <p><strong>Department:</strong> '.$row['department'].'</p>
            <p><strong>Time:</strong> '.$row['Time'].'</p>
            <p><strong>Date:</strong> '.$row['Date'].'</p>
        ';

        echo $htmlContent;
    } else {

        echo "Record not found";
    }
} else {

    echo "Audit ID not provided";
}
?>
