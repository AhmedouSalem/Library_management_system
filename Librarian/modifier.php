<?php
session_start();
    
    if (empty($_SESSION['Category'])) {
        header("Location: ..");
    } elseif (strcmp($_SESSION['Category'], "Client") == 0) {
        header("Location: ../member/member.php");
    }

$error = "";
$con=mysqli_connect("localhost", "root", "", "librairie");
if (!$con) {
    die("Erreur de type: " .mysqli_connect_error());
} else {
    "OK";
}
if (isset($_GET['edit_id'])) {
    $id=$_GET['edit_id'];
    $catid = $_GET['catid'];
    $sql_select= "SELECT `p`.`NomLivre`,`p`.`Auteur`,`p`.`Description`,`p`.`Prix`,`p`.`CategoryId`,`p`.`image`,`c`.`Parentcategoryid` FROM `produits` as `p`,`category` as `c` WHERE `p`.`productId`='$id' AND `c`.`CategoryId`='$catid' ";
    $result = mysqli_query($con, $sql_select);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $parentid = $row["Parentcategoryid"];
        $rows_nomLivre=$row["NomLivre"];
        $rows_Auteur=$row["Auteur"];
        $rows_Description=$row["Description"];
        $rows_price=$row["Prix"];
        $image_up =$row['image'];
    } else {
        echo "controler votre requêtte";
    }
}
if (isset($_POST['btn-save'])) {
    $parent = $_POST['parentid'];
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $Auteur = mysqli_real_escape_string($con, $_POST['auteur']);
    $descr = mysqli_real_escape_string($con, $_POST['desc']);
    $price = $_POST['price'];
    ////
    $sql_select = mysqli_query($con, "SELECT `CategoryId` as `catid_select`, `Name` as `catname_select`,`category`.`Description` as `catdesc_select` FROM category WHERE `Parentcategoryid`='$parent'");
    if ($fetch_cat_select = mysqli_fetch_assoc($sql_select)) {
        $catname_select = $fetch_cat_select['catname_select'];
        $catid_select =  $fetch_cat_select ['catid_select'];
        $catdesc_select = $fetch_cat_select['catdesc_select'];
        if ($_FILES['imge_item']["size"] > 0) {
            $imgFile = $_FILES["file_img"]['name'];
            $tmp_dir = $_FILES['file_img']['tmp_name'];
            $imgSize = $_FILES['file_img']['size'];

            $upload_dir = '../file_database/';
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg','jpg','png', 'gif');
            $itempic = basename($imgFile);
            $target_file = $upload_dir.basename($imgFile);
            //////////////
            if (!file_exists($target_file)) {
                move_uploaded_file($tmp_dir, $upload_dir.$itempic);
            }
            $sql= "UPDATE  produits SET `NomLivre`='$nom ',`Auteur`='$Auteur', `Description`='$descr',  `Prix`='$price',`image` = '$itempic' WHERE `productId`='$id' ";
        } else {
            $sql= "UPDATE  produits SET `NomLivre`='$nom ',`Auteur`='$Auteur', `Description`='$descr',  `Prix`='$price' WHERE `productId`='$id' ";
            $resultat = mysqli_query($con, $sql);
            if ($resultat) {
                header("Location: home.php");
            } else {
                echo "Erreur";
            }
        }
    } else {
        $error = "ISBN INVALIDE";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    h2 {
        color: #04AA6D;
    }

    input,
    textarea,
    select {
        width: 300px;
    }

    label {
        color: #04AA6D;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <li><?php echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:25px;'><strong>";echo "@";print_r($_SESSION['useame']);echo "</strong></font>"; ?>
        </li>
        <a href="home.php"><i class="fa fa-home"></i> Liste des livres disponible</a>
        <a href="addCategory.php"><i class="fa fa-plus"></i> Ajouter un Catégorie</a>
        <a href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content"><?php echo "<img src='../file_database/".$image_up."'  style='float:right;width:100px;height:142px;'>"; ?>
        <div class="container">
            <center><span class="error"><?php echo $error; ?></span></center>
            <center>
                <h2>Modifier un Livre</h2>
                <div style='overflow-x:auto;'>
                <table>
                    <tr>
                        <form method="post" action="" enctype="multipart/form-data">
                            <td>
                                <label for="">Image:</label>
                            </td>
                            <td>
                                <input type="file" name="file_img" id="" accept="image/*">
                                
                            </td>
                    <tr>
                        <td>
                            <label>ISBN</label>
                        </td>
                        <td>
                            <input type="text" name="parentid" id=""
                                value="<?php if (isset($_GET['edit_id'])) {
    print $parentid;
} ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Nom de Livre:</b></label>
                        </td>
                        <td>
                            <input type="text" name="nom" id="nm"
                                value="<?php if (isset($_GET['edit_id'])) {
    print $rows_nomLivre;
} ?>" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Auteur:</b></label>
                        </td>
                        <td>
                            <input type="text" name="auteur" id="prenom"
                                value="<?php if (isset($_GET['edit_id'])) {
    print $rows_Auteur;
} ?>" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Description:</b></label>
                        </td>
                        <td>
                            <textarea name="desc"
                                required><?php if (isset($_GET['edit_id'])) {
    print $rows_Description;
} ?></textarea><br>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Prix:</b></label>
                        </td>
                        <td>
                            <input type="text" name="price" id="adrs"
                                value="<?php if (isset($_GET['edit_id'])) {
    print $rows_price;
} ?>" required><br><br>
                        </td>
                    </tr>


                    <tr>
                        <td colspan='2' align='center'><input type="submit" value="Modifier" name="btn-save"></td>
                    </tr>


                    </form>
                </table>
        </div>
    </div>
</body>

</html>