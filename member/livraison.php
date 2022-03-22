<?php
require '../db_connect.php';
session_start();

if (empty($_SESSION['Category'])) {
    header("Location: ..");
} elseif (strcmp($_SESSION['Category'], "member") == 0) {
    header("Location: ../librarian/home.php");
}
$user_name = $_SESSION['username'];
require_once 'count_panier.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste de Livraison</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../slick.css">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="../image.css">
    <link rel="stylesheet" href="../Librarian/Annimation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='main.js' crossorigin='anonymous'></script>
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

    tr:hover {
        background-color: white;
    }
    th, td {
  padding: 15px;
}

    a:active {
        background-color: #04AA6D;
        color: white;
    }
    input[type=submit] {
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
        <li><?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r ($_SESSION['username']);echo "</strong></font></center>"; ?>
        </li>
        <a href="member.php"><i class='fas fa-bookmark'></i> Commercialisez</a>
        <a href="category.php"><i class='fas fa-poll'></i> Catégorie\</a>
        <a  href="panier.php"><i class='fa fa-shopping-cart'></i> Panier
        <?php
        if (!$nb_prod_select == 0) {
            echo "<span class='red'>".$nb_prod_select."</span>";
        }
        ?>
    </a>
        <a class="active" href="livraison.php"><i class="fa fa-ship"></i> Mes Livres</a>
        <a href="compte.php"><i class="fas fa-address-card"></i> Compte</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <?php
    $sql = "SELECT `com`.`CommandeId`,`com`.`CommandeDate`, `com`.`Prix`, `com`.`status`,`com`.`ClientId`,
    `cl`.`Nom`,`cl`.`Address`,`cl`.`DateNaissance`,`cl`.`Genre`,GROUP_CONCAT(`p`.`NomLivre`) as `Livres`,GROUP_CONCAT(`p`.`image`) as `image_data` FROM `products_commandes` AS `pr`,`commande` AS `com`,
    `client` AS `cl` , `produits` AS `p`  
    WHERE `pr`.`ProduitCommande` = `p`.`ProductId` AND `pr`.`CommandeId` = `com`.`CommandeId` AND `com`.`ClientId` = `cl`.`ClientId` AND
    `com`.`status`=1 AND `com`.`ClientId` = '$user_ID'
    GROUP by `pr`.`CommandeId`;";
    $resultat = mysqli_query($con, $sql);
    if ((mysqli_num_rows($resultat) > 0) ) {
        
        echo "<table  width='100%' cellspacing='15'>"."<tr>";
        echo "<th>Livre commandé</th>";
        echo "<th>Prix</th>";
        // echo "<th>nom client</th>";
        // echo "<th>Address</th>";
        // echo "<th>Genre</th>";
        echo "</tr>";
        while ($r = mysqli_fetch_assoc($resultat)) {
            // if ($r['status']==0) {
                $id = $r['CommandeId'];
                $id_Client = $r['ClientId'];
                echo "<tr>";
                echo "<td>".$r['Livres']."</td>";
                echo "<td>".$r['Prix']."</td>"."</tr>";
                // echo "<td>".$r['Nom']."</td>";
                // echo "<td>".$r['Address']."</td>";
                // echo "<td>".$r['Genre']."</td>";
            // }
        }
    echo "</table>";
    
    }else {
        echo "<center><div class='rockstar'><div class='div'><strong>"."Auccun Livre n'a eté trouvé"."</strong></div></div></center>";
    }
    echo "</form>";
    
    ?>
    </div>
</body>

</html>
    </div>
</body>
</html>