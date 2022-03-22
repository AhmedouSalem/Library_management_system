<?php
require '../db_connect.php'; 
session_start();
	
	if(empty($_SESSION['Category']))
		header("Location: ..");
	
	else if(strcmp($_SESSION['Category'], "Client") == 0)
		header("Location: ../member/member.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    table tr {
        background-color: rgba(255, 255, 255, 0.8);
    }

    table {
        width: 100%;
        margin: auto;
    }

    tr {
        text-align: center;
    }
    button{
        padding: 0px;
        margin: 0px;
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
        <a class="active" href="search.php"><i class="fa fa-search"></i> search</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <?php
        if (!empty($_POST['search_c'])) {
//Récupération de données
$nom=$_POST['search_c'];
echo "<div style='overflow-x:auto;'>";
echo "<table width='100%'>"."<tr>";
    echo "<th>"."ISBN"."</th>";
    echo "<th>"."Nom Categorie"."</th>";
    echo "<th>"."Description"."</th>";
    echo "<th style='color:green;'>". "Modifier". "</th>";
    echo "<th style='color:red;'>"."Supprimer"."</th>"."</tr>";
    $sql= "select * from `category` where `Name` like '%$nom%' or `Parentcategoryid` like '%$nom%'";
    $resultat = mysqli_query($con, $sql);
    if (mysqli_num_rows($resultat) > 0) {
        while ($r = mysqli_fetch_assoc($resultat)) {
            $id = $r['CategoryId'];
            echo "<tr>";
            echo "<td>".$r['Parentcategoryid']."</td>";
            echo "<td>".$r['Name']."</td>";
            echo "<td>".$r['Description']."</td>";
            
            ?>
        <td align="center">
            <button style='background-color:blue;color:white;width: 115px;'><a
                    href="modifier_c.php?edit_id=<?php print($id); ?>">
                    <font style='color:green;font-size: 25px;'><i class="fa fa-refresh"></i></font>
                </a></button>
        </td>
        <td align="center"><a
                    href="supprimer_c.php?delete_id=<?php print($id); ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                    <font style='color:red;font-size: 25px;'>&#x2715</font>
                </a>
        </td>
        <?php
echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan='4'>";
        echo "Aucun enregistrement";
        echo "</td>";
    }
echo "</table></div>";
        }else {
            header("location:search.php");
        }
    ?>
    </div>
</body>

</html>