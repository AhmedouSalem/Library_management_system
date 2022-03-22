<?php 

require '../db_connect.php';

error_reporting(0);

session_start();

if (isset($_SESSION['Category'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	// $username = $_POST['username'];
	$email = $_POST['email'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$z = $_POST['z'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);


    $imgFile = $_FILES['imge_item']['name'];
    $tmp_dir = $_FILES['imge_item']['tmp_name'];
    $imgSize = $_FILES['imge_item']['size'];

    $upload_dir = '../file_database/';
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg','jpg','png', 'gif');
    $itempic = basename($imgFile);
    $target_file = $upload_dir.basename($imgFile);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM `login` WHERE `username`='$email'";
		$result = mysqli_query($con, $sql);
		if (!$result->num_rows > 0) {
            if (!file_exists($target_file)) {
                move_uploaded_file($tmp_dir,$upload_dir.$itempic);
                
            }
			$sql = "INSERT INTO `login` (`username`, password,category,`image`)
					VALUES ('$email', '$password','Client','$itempic')";
			$result = mysqli_query($con, $sql);
			
			if ($result) {
				$sq = "SELECT * FROM `login` where `username`='$email'";
			    $res = mysqli_query($con,$sq);
			    $fetch = mysqli_fetch_assoc($res);
			    $id = $fetch['UserId'];
			    $ur = $fetch['username'];
			    $sql = "INSERT INTO `client`(ClientId,Nom,`Address`,DateNaissance,Genre) VALUES
			    ('$id','$ur','$x','$y','$z')";
				// echo $id;
			     $h = mysqli_query($con,$sql);
				 if(!$h){echo "error";}
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css.css">
    <title>Sign Up Customer</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <style>
    h3 {
        color: black;
    }
	input,
    textarea,
    select {
        width: 100%;
    }

    </style>
</head>

<body>
    <div class="content">
        <center>
            <div class="container">
                <center>

				
                    <form action="" method="POST" class="login-email" enctype="multipart/form-data">

                        <h3 class="text-center py-3">Inscrir </h3><table><tr><td colspan="2">


                        <!-- <input type="text" placeholder="votre nom" name="username" value="<?php echo $username; ?>" required> -->

                        <input type="text" placeholder=" votre nom" name="email" value="<?php echo $email; ?>" required></td></tr><tr><td colspan="2">
                        <input type="text" name="x" id="" placeholder="Adresse.." required><br></td></tr><tr><td colspan="2">
                        <input type="date" name="y" id="" placeholder="Date de naissance"  required><br></td></tr><tr>
                        <font color="black"><td>
                            male<input type="radio" name="z" id="" value="male"><br></td><td>female<input type="radio" name="z"
                                id="" value="female"></td>
                        </font></tr><tr><td colspan="2">

                        <input type="password" placeholder="mot de passe" name="password"
                            value="<?php echo $_POST['password']; ?>" required></td></tr><tr><td colspan="2">

                        <input type="password" placeholder="Confirmer mot de passe" name="cpassword"
                            value="<?php echo $_POST['cpassword']; ?>" required></td></tr><tr><td colspan="2">
                        <input type="file" name="imge_item" id="" accept="image/*"></td></tr><tr><td colspan="2">
                        <button name="submit">Inscrir</button></td></tr></table>


                    </form>


            </div>
            <h3>
                <p color="black">Avez vous une compte? <a href="login.php"><button
                            style="width: 20%; background-color: blue;">connecter ici</button></a>.</p>
            </h3>
    </div>
</body>

</html>