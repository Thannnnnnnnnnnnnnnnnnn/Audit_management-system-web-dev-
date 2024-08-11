<?php
include("connections.php");

$audit_id = $description = $name_team = $department = $Time = $Date = "";
$audit_id_err = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input for Audit ID
    $audit_id = trim($_POST["audit_id"]);

    // Check if the Audit ID is empty
    if (empty($audit_id)) {
        $audit_id_err = "Please enter an Audit ID.";
    } else {
        // Check if the Audit ID already exists
        $sql = "SELECT * FROM `dashboard_db` WHERE audit_id = '$audit_id'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $audit_id_err = "Audit ID already exists.";
        }
    }

    // Get form data
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $name_team = mysqli_real_escape_string($connection, $_POST['name_team']);
    $department = mysqli_real_escape_string($connection, $_POST['department']);
    $Time = mysqli_real_escape_string($connection, $_POST['Time']);
    $Date = mysqli_real_escape_string($connection, $_POST['Date']);

    // Insert data into the database if there are no errors
    if (empty($audit_id_err)) {
        $sql = "INSERT INTO `dashboard_db` (audit_id, description, name_team, department, Time, Date) 
                VALUES ('$audit_id', '$description', '$name_team', '$department', '$Time', '$Date')";

        if ($connection->query($sql) === TRUE) {
            // Redirect to admin.php after successfully adding a new record
            header("Location: admin.php");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}
?>
<script>
    // Function to confirm logout action
    function confirmLogout() {
        // Display confirmation dialog
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
                // If user confirms, redirect to login.php
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
    <title>Add Complain</title> 
    <link rel="stylesheet" href="systemm.css">
    <link rel="stylesheet" href="system.css">
    <script src="logout.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
       
    </header>

    <footer class="footer1">
        <div class="footer-section">
            <br>
            <a href="#" style="margin-left: 10px"><b>@Copyright.All right reserved Audit management</b></a><br>
            <a href="#" style="margin-left: 10px"><b> Audit management</b></a>
        </div>
    </footer>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Audit management</span> </a>
                <div class="nav_list"> 
                    <a href="admin.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="add_team.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Add Team</span> </a> 
                    
                </div>
            </div> 
            <a href="#" class="nav_link" onclick="confirmLogout()"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Log out</span> </a>
    </div>

    <!-- Footer -->
    <div class="container2 form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="audit_id">Audit ID</label>
                <input type="text" id="audit_id" name="audit_id" required>
                <span class="error"><?php echo $audit_id_err; ?></span>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
            </div>
            
            <div class="form-group">
                <label for="name_team">Name of Team</label>
                <input type="text" id="name_team" name="name_team" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" id="department" name="department" required>
            </div>

            <!-- Hidden input field for Time -->
            <input type="hidden" id="Time" name="Time">

            <!-- New form group for Date -->
            <div class="form-group">
                <label for="Date">Date</label>
                <input type="date" id="Date" name="Date" required>
            </div>
            <br>
                <center>
            <input type="submit" class="back-to-home-button" value="Submit">
</center>
        </form>
    </div>

 
    <script>
    function addCurrentTimeAndDateToForm() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = hours % 12 || 12;
        const time = formattedHours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + ampm;

        // Update value of Time input field
        document.getElementById('Time').value = time;

        // Update value of Date input field
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const date = `${year}-${month}-${day}`;
        document.getElementById('Date').value = date;
    }

    // Call addCurrentTimeAndDateToForm function when the form is submitted
    document.querySelector('form').addEventListener('submit', addCurrentTimeAndDateToForm);
    </script>

<script>
        document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-x')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });
   </script>
</body>
</html>
