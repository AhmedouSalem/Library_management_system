<?php
require '../db_connect.php';
session_start();
    
    if (empty($_SESSION['Category'])) {
        header("Location: ..");
    } elseif (strcmp($_SESSION['Category'], "Client") == 0) {
        header("Location: ../member/member.php");
    }
$error = "";
if (isset($_POST['btn'])) {
    $parent_id = $_POST['parent_id'];
    $cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);
    $cat_desc = mysqli_real_escape_string($con, $_POST['cat_desc']);
    $parent_id = filter_var($parent_id, FILTER_SANITIZE_NUMBER_INT);
    if (empty($parent_id) || empty($cat_name) || empty($cat_desc)) {
        $error = "<span class='error'>"."Remplir les champs"."</span>";
    } elseif (!$parent_id) {
        $error = "<spna class='error'>"."Verifier L'ISBN"."</span>";
    } else {
        $sql = mysqli_query($con, "INSERT INTO `category`(`Parentcategoryid`,`Name`,`Description`)
       VALUES ('$parent_id','$cat_name', '$cat_desc');");
        if ($sql) {
            $error = "<span class='success'>"."Insertion avec succées!"."</spna>";
        } else {
            $error = "<span class='error'>"."Eurreur d'insertion!"."</spna>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="Annimation.css">
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

    .success {
        color: green;
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
        <a class="active" href="addCategory.php"><i class="fa fa-plus"></i> Ajouter un Catégorie</a>
        <a href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style = "color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">



        <div class="container">
            <center><?php echo "<strong>".$error."</strong>"; ?></center>
            <center><div style='overflow-x:auto;'>
                <table>
                    <form action="" method="POST">
                        <tr>
                            <td>
                                <label>ISBN</label>
                            </td>
                            <td>
                                <input type="text" name="parent_id" id="" placeholder="ISBN"><br>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nom Catégorie</label></td>
                            <td>
                                <input type="text" name="cat_name" id="" placeholder="Nom "><br>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Description</label></td>
                            <td>
                                <input type="text" name="cat_desc" id="" placeholder="Description"><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" name="btn" value="Ajouter"><br>
                            </td>
                        </tr>
                    </form>
                </table>
            </center>
        </div>
    </div>
</body>

</html>