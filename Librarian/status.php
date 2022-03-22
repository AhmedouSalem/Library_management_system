<?php
 
//  session_start();
//  if (!isset($_SESSION['useame']) && !isset($_SESSION['Category'])) {
//     header("Location: login.php");
// }
require '../db_connect.php';
session_start();
error_reporting(0);
	
	if(empty($_SESSION['Category']))
		header("Location: ..");
	
	else if(strcmp($_SESSION['Category'], "Client") == 0)
		header("Location: ../member/member.php");
 ?>
<?php  $tr = "";
if (isset($_POST['m_r'])) {
    if (empty($_POST['req'])) {
        $tr = "<div style='width: 900px;height: 25px;background-color:red;color:white;'>"."No Element has been Selected"."</div>";
        header("Refresh:1");
    }
    else{
        $x =$_POST['req'];
        // $x = filter_var($x,FILTER_SANITIZE_INT);
        // var_dump($x);
        $kjt = mysqli_multi_query($con, "UPDATE `commande` SET `status`=2 WHERE `commande`.`CommandeId`='$x' ");
        if (!$kjt) {
            echo "Error querry";
        }
        $tr = "<div style='width: 900px;height: 25px;background-color:green;color:white;'>"."The request has deleted Successfully!"."</div>";
        // header("Refresh:1");
    }
}elseif (isset($_POST['m_request'])) {
    if (empty($_POST['req'])) {
        $tr = "<div style='width: 900px;height: 25px;background-color:red;color:white;'>"."No Element has ben Selected"."</div>";
        header("Refresh:1");
    }else{
        $z = $_POST['req'];
        // echo $z;
        $kt = mysqli_query($con, "UPDATE `commande` SET `status` = 1 WHERE `CommandeId`='$z';");
        if (!$kt) {
            echo "Error";
        }
        $tr = "<div style='width: 900px;height: 25px;background-color:green;color:white;'>"."One Element Has Bee Selected!"."</div>";
        header("Refresh:1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commandes</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="Annimation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    table tr {
        background-color: rgba(255, 255, 255, 0.8);
    }

    table {
        width: 80%;
        margin: auto;
    }

    tr {
        text-align: center;
    }

    a:active {
        background-color: #04AA6D;
        color: white;
    }

    button {
        padding: 5px;
        margin: 0px;
    }

    .rockstar {
        /* margin: auto; */
        margin-top: 70px;
        /* padding: 40px; */
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <li><?php echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:25px;'><strong>";echo "@";print_r ($_SESSION['useame']);echo "</strong></font>"; ?>
        </li>
        <a href="home.php"><i class="fa fa-home"></i> Liste des livres disponible</a>
        <a href="addCategory.php"><i class="fa fa-plus"></i> Ajouter un Catégorie</a>
        <a  href="projet.php"><i class="fa fa-plus"></i> Ajouter un livre</a>
        <a class="active" href="status.php"><i class="fa fa-stop-circle"></i> commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style = "color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">


        <?php
    echo "<center>".$tr."</center>";
    echo "<form action='' method='post'>";
    $sql = "SELECT `com`.`CommandeId`,`com`.`CommandeDate`, `com`.`Prix`, `com`.`status`,`com`.`ClientId`,
    `cl`.`Nom`,`cl`.`Address`,`cl`.`DateNaissance`,`cl`.`Genre`,GROUP_CONCAT(`p`.`NomLivre`) as `Name_livre` 
    FROM `products_commandes` AS `pr`,`commande` AS `com`,
    `client` AS `cl` , `produits` AS `p`  
    WHERE `pr`.`ProduitCommande` = `p`.`ProductId` AND `pr`.`CommandeId` = `com`.`CommandeId` 
    AND `com`.`ClientId` = `cl`.`ClientId` AND
    `com`.`status`=0
    GROUP by `pr`.`CommandeId`;";
    $resultat = mysqli_query($con, $sql);
    // $r = mysqli_fetch_assoc($resultat);
    if ((mysqli_num_rows($resultat) > 0) ) {
        echo "<div style='overflow-x:auto;'>";
        echo "<table  width='100%'>"."<tr>";
        echo "<th></th>";
        echo "<th>Commande ID</th>";
        echo "<th>Date de la commande</th>";
        echo "<th>Prix</th>";
        // echo "<th>status</th>";
        echo "<th>nom client</th><th>Address</th><th>Genre</th><th>Livre commandé</th><th colspan='2'>Action</th>"."</tr>";
        while ($r = mysqli_fetch_assoc($resultat)) {
                $id_Commande = $r['CommandeId'];
                $id_Clientelle = $r['ClientId'];
                echo "<tr>";
                echo  "<td style='width: 50px;'>"."<input style='width: 30px;height: 30px;' type='checkbox' name = 'req' style='width:10px;' value='$id_Commande'>"."</td>";
                echo "<td>".$r['CommandeId']."</td>";
                echo "<td>".$r['CommandeDate']."</td>";
                echo "<td>".$r['Prix']."</td>";
                echo "<td>".$r['Nom']."</td>";
                echo "<td>".$r['Address']."</td>";
                echo "<td>".$r['Genre']."</td>";
                echo "<td>".$r['Name_livre']."</td>";
                echo "<td>"."<button style='width: 98px;height: 50px;' type='submit' name='m_request' >"."Accepter"."</td>";
                echo "<td>"."<button style='width: 80px;height: 50px;background-color:red;' type='submit'  name='m_r'>"."Rejeter"."</button>"."</td>"."</tr>";
            // }
        }
        echo "</table></div>";
    
    }else {
        echo "<center><div class='rockstar'><div class='div'><strong>"."Auccune Nouveau Commande En Attente"."</strong></div></div></center>";
    }
    echo "</form>";
    
    ?>
    </div>
</body>

</html>
