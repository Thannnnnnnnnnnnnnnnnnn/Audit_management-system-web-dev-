<?php

include 'connections.php';

$email = $password = $register = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //check email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    //check password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    //check if email already registered
    $sql_check_email = "SELECT Email FROM accounts WHERE Email = '$email'";
    $result_check_email = $connection->query($sql_check_email);
    if ($result_check_email->num_rows > 0) {
        $email_err = "Email is already registered.";
    }

    //if success, data will go in the database
    if (empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO accounts ( Email, password) VALUES ('$email', '$password')";

        if ($connection->query($sql) === TRUE) {
            $register = "Registered Successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="system.css">
    
</head>
<body>

<div class="login-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>SignUp</h1>
        <span><?php echo $register?></span>
        <span><?php echo $email_err ?></span>
        <span><?php echo $password_err ?></span>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" class="submit" value="Sign up"><br><br>
        <a href="login.php" class="submit">Login</a></p>
    </form>

    
</div>
<footer>
        <p>©Audit management.All right reserved</p>
        <p>©BSIT - 2222</p> 
    </footer>
</body>
</html>