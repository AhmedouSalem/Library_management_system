<!-- Ahmedou Salem-->
<?php

require_once('../db_connect.php');
require "../verify_logged_out.php";

$UName = $Password = "";
if (isset($_POST['Login'])) {
    $UName = $_POST['UName'];
    $Password = md5($_POST['Password']);

    $sql = "SELECT * FROM `loginm` WHERE `username`='$UName' AND password='$Password' AND category='member'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        // if ($row['category'] == "Client") {
        $_SESSION['useame'] = $row['username'];
        $_SESSION['Category'] = "member";
        header("Location: home.php");
    // }
    } else {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</head>

<body style="background-color:#E8E8E8;">
    <table cellspacing="0">
        <div class="content">
            <div class="container">
                <center>

                    <h3>Connexion bibliothécaire</h3>


                    <form action="" method="post">
                        <input type="text" name="UName" placeholder=" votre nom" value="<?php echo $UName; ?>"
                            class="form-control mb-3">
                        <input type="password" name="Password" id="motdepasse" placeholder=" mot de passe"
                            value="<?php //echo $_POST['Password'];?>" class="form-control mb-3">
                        <input type="checkbox" onclick="Afficher()">
                        <button class="btn btn-success mt-3" name="Login">connexion</button><br>


                    </form>

            </div><br><br>
            <center><a href="../index.php">Précedent</a>

                <!-- <a href="register.php"><button style="width: 20%; background-color: blue;">Inscrir Ici</button></a> -->
            </center>

        </div>
        <script>
        function Afficher() {
            var input = document.getElementById("motdepasse");
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
        </script>
</body>

</html>