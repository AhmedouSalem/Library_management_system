<?php

include '../db_connect.php';

error_reporting(0);

require_once('../db_connect.php');
require "../verify_logged_out.php";

if (isset($_POST['submit'])) {
    // $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM loginm WHERE username='$email'";
        $result = mysqli_query($con, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO loginm (username,password,category)
					VALUES ('$email', '$password','member')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Wow! User Registration Completed.')</script>";
                // $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Something Wrong Went.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Already Exists.')</script>";
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css.css">
    <title>Login Admin</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <style type="text/css">
    h3 {
        color: black;
    }

    a {
        color: red;
    }

    a:hover {
        color: hotpink;
    }

    a:active {
        color: blue;
    }
    </style>
    <title>Register Administrateur</title>
</head>

<body style="background-color:#E8E8E8;">
    <div class="content">
        <div class="container">
            <form action="" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800; color:black;">Register</p>
                <div class="input-group">

                </div>
                <div class="input-group">
                    <input type="text" placeholder="Nom" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password"
                        value="<?php echo $_POST['password']; ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Confirm Password" name="cpassword"
                        value="<?php echo $_POST['cpassword']; ?>" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Register</button>
                </div>
                <p style="color:black;">Have an account? <a href="login.php">Login Here</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>