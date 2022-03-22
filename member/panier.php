<?php
require '../db_connect.php';
session_start();

if (empty($_SESSION['Category'])) {
    header("Location: ..");
} elseif (strcmp($_SESSION['Category'], "member") == 0) {
    header("Location: ../librarian/home.php");
}
$user_name = $_SESSION['username'];


$valid_commanded = "";
    require_once 'count_panier.php';
if (isset($_POST['submit'])) {
    //CommandeDate Prix status ClientId
    $date = date("Y-m-d H:i:s");
    $select_sum_price = mysqli_query($con, "SELECT SUM(`produits`.`Prix`) AS `sum_price` FROM `panier`,`produits`
     WHERE `panier`.`ProductId`=`produits`.`ProductId` AND `panier`.`ClientId`='$user_ID' 
     HAVING COUNT(`panier`.`ProductId`) ;");
    $fetch_sum = mysqli_fetch_assoc($select_sum_price);
    $extract_sum_price = $fetch_sum['sum_price'];
    //  echo $lk;
    if (!empty($extract_sum_price) && !empty($date)) {
        $insert_commande = mysqli_query($con,"INSERT INTO `commande`(`CommandeDate`,`Prix`,`ClientId`) 
        VALUES ('$date','$extract_sum_price','$user_ID')");
        if ($insert_commande) {
            $last_id = mysqli_insert_id($con);//id_commande
        }
        $new_sql_panier = mysqli_query($con,"SELECT * FROM `panier` WHERE `ClientId` = '$user_ID';");
        if (mysqli_num_rows($new_sql_panier) > 0) {
            while ($rows_panier = mysqli_fetch_assoc($new_sql_panier)) {
                $id_Product = $rows_panier['ProductId'];
                $insert_products_commandes = mysqli_query($con,"INSERT INTO `products_commandes`(`ProduitCommande`, `CommandeId`) 
                VALUES('$id_Product','$last_id');");
            }
        }
    }
    $delete_panier_was_send = mysqli_query($con, "DELETE FROM `panier` WHERE ClientId = '$user_ID' ;");
    if (!$delete_panier_was_send) {
        echo "not truncate";
    }
    $valid_commanded =  "<div style='width: 900px;height: 25px;background-color:green;color:white;'>"."Votre commmande est transmettre avec Succees!"."</div>";
    header("Refresh:0.75");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier Des Livres</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../slick.css">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="../image.css">
    <!-- <link rel="stylesheet" href="../Librarian/Annimation.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='main.js' crossorigin='anonymous'></script>
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
        <!-- <li><?php //echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r($_SESSION['username']);echo "</strong></font>"; ?>
        </li> -->
        <li><?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r ($_SESSION['username']);echo "</strong></font></center>"; ?>
        </li>
        <a href="member.php"><i class='fas fa-bookmark'></i> Commercialisez</a>
        <a href="category.php"><i class='fas fa-poll'></i> Catégorie\</a>
        <a class="active" href="panier.php"><i class='fa fa-shopping-cart'></i> Panier
            <?php
        if (!$nb_prod_select == 0) {
            echo "<span class='red'>".$nb_prod_select."</span>";
        }
        ?>
        </a>
        <a href="livraison.php"><i class="fa fa-ship"></i> Mes Livres</a>
        <a href="compte.php"><i class="fas fa-address-card"></i> Compte</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <center>
            <?php
            echo $valid_commanded;
            echo "<form action='' method='post'>";
            $sql = "SELECT `pan`.`Id`,`pan`.`ClientId`, `pan`.`ProductId`, `p`.`NomLivre`, `p`.`Auteur`,`p`.`image` FROM `panier` as `pan`, `produits` as `p` WHERE `pan`.`ClientId` = '$user_ID' and `p`.`ProductId` = `pan`.`ProductId`;";
            $resultat = mysqli_query($con, $sql);
            if (mysqli_num_rows($resultat) > 0) {
                echo "<table border width='100%' cellpadding = '10'>"."<tr>";
                echo "<th></th><th>Nom Livre</th><th>Auteur</th><th></th>"."</tr>";
                while ($r = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    $id = $r['Id'];
                    $produit= $r['ProductId'];
                    $image_data = $r['image'];
                    echo "<td>"."<img src='../file_database/".$image_data."' width='100'height='100'>"."</td>";
                            echo "<td>".$r['NomLivre']."</td>";
                            echo "<td>".$r['Auteur']."</td>";  ?>
            <td><a href="supprimer.php?deleted_id=<?php print($id); ?>">
                    <font style="color:red;">&#x2715</font>
                </a></td>
            <?php
                    echo "</tr>";
                }
                echo "</table>"; ?>
            <input type="submit" name="submit" value="Commandez?">
            <?php
            }else {
                echo "<center><div class='rockstar'><div class='div'><strong>"."Aucun Nouveau Article Selectionné"."</strong></div></div></center>";
            }
            
            ?>

            <?php
            echo "</form>";
            ?>
        </center>
    </div>
</body>

</html>