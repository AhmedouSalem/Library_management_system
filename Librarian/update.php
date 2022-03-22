<?php
session_start();
	
	if(empty($_SESSION['Category']))
		header("Location: ..");
	
	else if(strcmp($_SESSION['Category'], "Client") == 0)
		header("Location: ../member/member.php");

$error = "";
$con=mysqli_connect("localhost","root","","librairie");
if(!$con){die("Erreur de type: " .mysqli_connect_error()); }
else "OK";
if (isset($_GET['edit_id'])){
$id=$_GET['edit_id'];
$sq= "SELECT * FROM `category` WHERE `CategoryId`='$id' ";
$result = mysqli_query($con,$sq);
if($result){
$row = mysqli_fetch_assoc($result);
$parentid = $row["Parentcategoryid"];
$nm=$row["Name"];
$descri_ption=$row["Description"];
}
else echo "controler votre requêtte";
}
if(isset($_POST['btn-save']))
{
    $parent = $_POST['parentid'];
	$nom = $_POST['nom'];
    $decr = $_POST['decri'];
        $sql= "UPDATE  category SET `Parentcategoryid`='$parent ',`Name`='$nom', `Description`='$decr' WHERE `CategoryId`='$id' ";
        $resultat = mysqli_query($con, $sql);
        if ($resultat) {
            echo "<script>alert('la modification est ajoutee')</script>";
        } else {
            echo "Erreur";
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
        <li><?php echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:25px;'><strong>";echo "@";print_r ($_SESSION['useame']);echo "</strong></font>"; ?>
        </li>
        <a href="home.php"><i class="fa fa-home"></i> Liste des livres disponible</a>
        <a href="addCategory.php"><i class="fa fa-plus"></i> Ajouter un Catégorie</a>
        <a href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style = "color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <div class="container">
            <center><span class="error"><?php echo $error; ?></span></center>
            <center>
                <h2>Modifier un Livre</h2>
                <table>
                    <tr>
                        <form method="post">
                            <td>
                                <label>ISBN</label>
                            </td>
                            <td>
                                <input type="text" name="parentid" id=""
                                    value="<?php if (isset($_GET['edit_id'])){print $parentid;} ?>">
                            </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Nom de Livre:</b></label>
                        </td>
                        <td>
                            <input type="text" name="nom" id="nm"
                                value="<?php if (isset($_GET['edit_id'])){print $nm;} ?>" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Auteur:</b></label>
                        </td>
                        <td>
                            <input type="text" name="decri" id="prenom"
                                value="<?php if (isset($_GET['edit_id'])){print $descri_ption;} ?>" required><br><br>
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