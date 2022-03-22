<?php
//localhost
require '../db_connect.php';
session_start();

if (empty($_SESSION['Category'])) {
    header("Location: ..");
} elseif (strcmp($_SESSION['Category'], "member") == 0) {
    header("Location: ../librarian/home.php");
}
$user_name = $_SESSION['username'];
require_once 'count_panier.php';
if (isset($_POST['btn'])) {
    if (($_FILES['imge_item']["size"] > 0) && !empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        $imgFile = $_FILES["imge_item"]['name'];
        $tmp_dir = $_FILES['imge_item']['tmp_name'];
        $imgSize = $_FILES['imge_item']['size'];

        $upload_dir = '../file_database/';
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg','jpg','png', 'gif');
        $itempic = basename($imgFile);
        $target_file = $upload_dir.basename($imgFile);

        if (!file_exists($target_file)) {
            move_uploaded_file($tmp_dir, $upload_dir.$itempic);
        }
        $sql_update = mysqli_query($con, "UPDATE `login` SET username = '$nom',`image` = '$itempic' WHERE `UserId` = '$user_ID'");
        $_SESSION['username'] = "$nom";
        header("Refresh:0");
    // }
    } elseif ($_FILES['imge_item']["size"] == 0) {
        $nom = $_POST['nom'];
        $sql_updat_nom = mysqli_query($con, "UPDATE `login` SET username = '$nom' WHERE `UserId` = '$user_ID'");
        $_SESSION['username'] = "$nom";
        header("Refresh:0");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="../slick.css">
    <link rel="stylesheet" href="../image.css">
    <link rel="stylesheet" href="../Librarian/Annimation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='main.js' crossorigin='anonymous'></script>
</head>

<body>
    <div class="sidebar">
        <!-- <li><?php //echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r($_SESSION['username']);echo "</strong></font>";?>
        </li> -->
        <li><?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r($_SESSION['username']);echo "</strong></font></center>"; ?>
        </li>
        <a href="member.php"><i class='fas fa-bookmark'></i> Commercialisez</a>
        <a href="category.php"><i class='fas fa-poll'></i> Catégorie\</a>
        <a href="panier.php"><i class='fa fa-shopping-cart'></i> Panier
            <?php
        if (!$nb_prod_select == 0) {
            echo "<span class='red'>".$nb_prod_select."</span>";
        }
        ?>
        </a>
        <a href="livraison.php"><i class="fa fa-ship"></i> Mes Livres</a>
        <a class="active" href="compte.php"><i class="fas fa-address-card"></i> Compte</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <fieldset>
            <center>
                <?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r($_SESSION['username']);echo "</strong></font></center>"; ?>
                <fieldset style="width:50%;height:50%; background-color:powderblue;">
                    <center>
                        <form action="" method="post" enctype="multipart/form-data">
                            changer votre nom: <input style="background-color:white;" type="text" name="nom" id=""
                                value="<?php echo $user_name; ?>" required><br>
                            changer votre profil : <input type="file" name="imge_item" id="" accept="image/*">
                            <!-- changer le mot de passe: <input style="background-color:white;" type="password" name="Password" id="" > -->
                            <input type="submit" name="btn" value="modifier">
                        </form>

                    </center>
                </fieldset>
            </center>
        </fieldset>
    </div>
</body>

</html>