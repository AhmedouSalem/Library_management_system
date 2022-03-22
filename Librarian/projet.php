<?php
require "../db_connect.php";
session_start();
    
    if (empty($_SESSION['Category'])) {
        header("Location: ..");
    } elseif (strcmp($_SESSION['Category'], "Client") == 0) {
        header("Location: ../member/member.php");
    }

?>
<?php $error = $nom = $Auteur = $description = $prix_livre = $parentid = "";
if (isset($_POST['btn'])) {
    //Récupération de données
    $parentid=$_POST['parentid'];
    $nom=mysqli_real_escape_string($con,$_POST['nom']);
    $Auteur=mysqli_real_escape_string($con,$_POST['auteur']);
    $description=mysqli_real_escape_string($con,$_POST['desc']);
    $prix_livre=$_POST['price'];
    
    $imgFile = $_FILES["imge_item"]['name'];
    $tmp_dir = $_FILES['imge_item']['tmp_name'];
    $imgSize = $_FILES['imge_item']['size'];

    $upload_dir = '../file_database/';
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg','jpg','png', 'gif');
    $itempic = basename($imgFile);
    $target_file = $upload_dir.basename($imgFile);
    $query_category = mysqli_query($con, "SELECT `CategoryId` as `id_cat`
    FROM category WHERE `Parentcategoryid`='$parentid'");
    if ($fetch_category = mysqli_fetch_assoc($query_category)) {
        $id_cat =  $fetch_category ['id_cat'];
        //Insertion de données dans la BD
        if (!file_exists($target_file)) {
                move_uploaded_file($tmp_dir,$upload_dir.$itempic);
                }
        $sql= "INSERT INTO `produits` (`NomLivre`,`Auteur`,`Description`,`Prix`,`CategoryId`,`image`)
         VALUES ('$nom', '$Auteur', '$description', '$prix_livre','$id_cat','$itempic')";
        if (mysqli_query($con, $sql)) {
            header("location:home.php");
        } else {
            $error = "Erreur d'insertion ";
        }
    } else {
        $error = "Le numéro ISBN n'est pas trouvé";
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    label {
        color: #04AA6D;
    }

    input,
    textarea,
    select {
        width: 300px;
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
        <a class="active" href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">



        <div class="container">
            <center><span class="error"><?php echo $error; ?></span></center>
            <center><div style='overflow-x:auto;'>
                <table>
                    <form method="post" action="" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <label>ParentCategoryid</label>
                            </td>
                            <td>
                                <input type="text" name="parentid" id="" placeholder="ISBN" required
                                    value="<?php echo $parentid; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><b>NomLivre:</b></label>
                            </td>
                            <td>
                                <input type="text" name="nom" id="nm" placeholder="Nom Livre..." required
                                    value="<?php echo $nom; ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><b>Auteur:</b></label>
                            </td>
                            <td>
                                <input type="text" name="auteur" id="prenom" placeholder="Auteur..." required
                                    value="<?php echo $Auteur; ?>"><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <label><b>Description:</b></label>
                            </td>
                            <td>

                                <textarea name="desc"
                                    placeholder="desicription..."><?php echo $description; ?></textarea><br>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <label><b>Prix:</b></label>
                            </td>
                            <td>
                                <input type="text" name="price" id="adrs" placeholder="Prix..." required
                                    value="<?php  echo $prix_livre; ?>"><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td><label>image</label></td>
                            <td><input type="file" name="imge_item" id="" accept="image/*"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button type="submit" name="btn">Envoyer</button><br></td>
                        </tr>
                    </form>

                </table></div>
        </div>
    </div>
</body>

</html>