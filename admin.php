<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="systemm.css">
    <link rel="stylesheet" href="system.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle" id="header-toggle"> <i class='bx bx-menu'></i> </div>
    </header>

    <footer class="footer1">
        <div class="footer-section">
            <br>
            <a href="#" style="margin-left: 10px"><b>@Copyright.All right reserved Audit management</b></a><br>
            <a href="#" style="margin-left: 10px"><b> Adit management</b></a>
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
        </nav>
    </div>

    <div class="container1">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <br><br><br>
                    </div>   
                    <table class="text-center">
                        <tr class="tr1">
                            <td>Audit ID</td>
                            <td>Description</td>
                            <td>Name of Team</td>
                            <td>Department</td>
                            <td>Time</td>
                            <td>Date</td>
                            <td>Actions</td> 
                        </tr>
                       
                        <?php
                        include("connections.php");
                        $query = "SELECT * FROM `dashboard_db`"; 
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) :
                            while($row = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td><?php echo $row['audit_id']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['name_team']; ?></td>
                                    <td><?php echo $row['department']; ?></td>
                                    <td><?php echo $row['Time']; ?></td>
                                    <td><?php echo $row['Date']; ?></td>
                                    <td>
                                        <!-- Trigger view action -->
                                        <a href='#' onclick="handleView(<?php echo $row['audit_id']; ?>)" class="view_btn">View</a> |

                                        <!-- Trigger edit action -->
                                        <a href='#' onclick="handleEdit(<?php echo $row['audit_id']; ?>)" class="edit_btn">Edit</a> | 

                                        <!-- Trigger delete action -->
                                        <a href='#' onclick="confirmDelete(<?php echo $row['audit_id']; ?>)" class="delete_btn">Delete</a>
                                    </td>
                                </tr>
                        <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">No records found</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                      nav = document.getElementById(navId),
                      bodypd = document.getElementById(bodyId),
                      headerpd = document.getElementById(headerId);

                if(toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show');
                        toggle.classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');
                    });
                }
            }
            
            showNavbar('header-toggle','nav-bar','body-pd','header');

            const linkColor = document.querySelectorAll('.nav_link');

            function colorLink() {
                if(linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>

    <script>
        function handleView(auditId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'View Record',
                            html: xhr.responseText,
                            showCloseButton: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                }
            };
            xhr.open('GET', 'fetch_record.php?audit_id=' + auditId, true);
            xhr.send();
        }

        function handleEdit(auditId) {
            $.ajax({
                url: 'edit.php?audit_id=' + auditId,
                type: 'GET',
                success: function(response) {
                    Swal.fire({
                        title: 'Edit Record',
                        html: response,
                        showCloseButton: true,
                        showConfirmButton: false 
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }

        function confirmDelete(auditId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this record. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id=' + auditId;
                }
            });
        }

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
</body>
</html>
