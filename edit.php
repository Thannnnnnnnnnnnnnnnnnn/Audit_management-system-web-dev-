<?php
include("connections.php");


$audit_id = $description = $name_team = $department = "";
$audit_id_err = "";


if(isset($_GET['audit_id'])) {
    $audit_id = mysqli_real_escape_string($connection, $_GET['audit_id']);

  
    $query = "SELECT * FROM `dashboard_db` WHERE audit_id = '$audit_id'";
    $result = mysqli_query($connection, $query);


    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

     
        $audit_id = $row['audit_id'];
        $description = $row['description'];
        $name_team = $row['name_team'];
        $department = $row['department'];
    } else {
    
        echo "Record not found";
        exit();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $auditId = $_POST['audit_id'];
    $description = $_POST['description'];
    $nameTeam = $_POST['name_team'];
    $department = $_POST['department'];


    $updateQuery = "UPDATE `dashboard_db` SET description = '$description', name_team = '$nameTeam', department = '$department' WHERE audit_id = '$auditId'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if($updateResult) {
    
        echo '<script>alert("Record updated successfully");</script>';
      
        header("Location: admin.php");
        exit(); 
    } else {

        echo '<script>alert("Error updating record: ' . mysqli_error($connection) . '");</script>';
    }
}
?>
<script>

    function confirmLogout() {

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will be logged out of the system.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = 'login.php';
            }
        });
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Complain</title>
    <link rel="stylesheet" href="systemm.css">
    <link rel="stylesheet" href="system.css">
    <script src="logout.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>


    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="audit_id" value="<?php echo $audit_id; ?>">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
            </div>
            <div class="form-group">
                <label for="name_team">Name of Team</label>
                <input type="text" id="name_team" name="name_team" value="<?php echo $name_team; ?>" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" id="department" name="department" value="<?php echo $department; ?>" required>
            </div>
            <br>
            <center>
                <input type="submit" class="back-to-home-button" value="Update">
            </center>
        </form>
    </div>
</body>
</html>
