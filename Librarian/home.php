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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres en stock</title>
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

    button {
        padding: 0px;
        margin: 0px;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <li><?php echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:25px;'><strong>";echo "@";print_r ($_SESSION['useame']);echo "</strong></font>"; ?>
        </li>
        <a class="active" href="home.php"><i class="fa fa-home"></i> Liste des livres disponible</a>
        <a href="addCategory.php"><i class="fa fa-plus"></i> Ajouter un Catégorie</a>
        <a href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <center>
            <?php
        $t="";
       
    
    // echo $t;
    echo "<form method='post' action='#'>";
    echo "<input type='text' style='background-color:white;' id='myInput' onkeyup='myFunction()' placeholder='Chercher avec Catégorie...' title='Type in a name'>";
    echo "<div style='overflow-x:auto;'>";
    echo "<table width='100%' id='myTable'>"."<tr>";
    echo "<th></th>";
    echo "<th>"."ISBN"."</th>";
    echo "<th>"."Nom Livre"."</th>";
    echo "<th>"."Auteur"."</th>";
    echo "<th>"."Description"."</th>";
    echo "<th>"."Prix"."</th>";
    echo "<th>"."Catégorie"."</th>";
    echo "<th style='color:green;'>". "Modifier". "</th>";
    echo "<th style='color:red;'>"."Supprimer"."</th>"."</tr>";
    $sql = "SELECT `p`.`ProductId`, `p`.`NomLivre`, `p`.`Auteur`, `p`.`Description`, `p`.`Prix`, `p`.`CategoryId`,`p`.`image`,`c`.`Parentcategoryid`,`c`.`Name` FROM `produits` AS `p`,`category` as `c` WHERE `c`.`CategoryId`=`p`.`CategoryId` ORDER BY `c`.`Name`";
    $resultat = mysqli_query($con, $sql);
    if (mysqli_num_rows($resultat) > 0) {
        while ($r = mysqli_fetch_assoc($resultat)) {
            $id = $r['ProductId'];
            $img_uploaded = $r['image'];
            echo "<tr>";
            // echo "<td>"."<input type='radio' name = 'req' value='.$id.'>"."</td>";
            echo "<td>"."<img src='../file_database/".$img_uploaded."' width='100' height='142'>"."</td>";
            echo "<td>".$r['Parentcategoryid']."</td>";
            echo "<td>".$r['NomLivre']."</td>";
            echo "<td>".$r['Auteur']."</td>";
            echo "<td>".$r['Description']."</td>";
            echo "<td>".$r['Prix']."</td>";
            echo "<td>".$r['Name']."</td>";
            $catid = $r['CategoryId']
            
            ?>
            <td align="center">
                <a href="modifier.php?edit_id=<?php print($id); ?>&&catid=<?php print ($catid); ?>">
                    <font style='color:green;font-size: 25px;'><i class="fa fa-refresh"></i></font>
                </a>
            </td>
            <td align="center">
                <a href="supprimer.php?delete_id=<?php print($id); ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                    <font style='color:red;font-size: 25px;'>&#x2715</font>
                </a>
            </td>
            <?php
echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan='5'>";
        echo "Aucun enregistrement";
        echo "</td>";
    }
echo "</table></div></form>";
    ?>
    </div>
    <script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>
</body>

</html>