<?php
$Email = $password = "";
$EmailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is Required";
    } else {
        $Email = $_POST["Email"];
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is Required";
    } else {
        $password = $_POST["password"];
    }
    if ($Email && $password) {
        include("connections.php");
        $check_email = mysqli_query($connection, "SELECT  Email, password, Account_type FROM accounts WHERE Email = '$Email'");
        $check_email_row = mysqli_num_rows($check_email);
        if ($check_email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_email)) {
                $db_password = $row["password"];
                $db_account_type = $row["Account_type"];
                if ($db_password == $password) {
                    if ($db_account_type == "1") {
                        header("Location: admin.php"); // Redirect to admin page
                        exit();
                    } else {
                        header("Location: user.php"); // Redirect to user page (adjust accordingly)
                        exit();
                        
                    }
                    
                } else {
                    $passwordErr = "Incorrect password";
                }
            }
        } else {
            $EmailErr = "Email is not registered";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
<body>
    <div class="login-container">
    <link rel="stylesheet" href="system.css">
        <h2>Login</h2>
        <form class=" login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="Email" id="Email" name="Email" placeholder="Email">
            <span class="error-message"><?php echo $EmailErr; ?></span>
            <br><br>
            <input type="password" id="password" name="password" placeholder="Password">
            <span class="error-message"><?php echo $passwordErr; ?></span>
            <br><br>
            <input type="submit" value="Login">
        </form>
        <div class="additional-options">
            <p>Don't have an account? <a href="sign_up.php">Sign up</a></p>
            
            
        </div>
    </div>
    <footer>
        <p>Copyright©Audit managemnt</p>
        <p>©BSIT - 2222</p> 
    </footer>
    
    

    
</body>
</html>