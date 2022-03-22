<?php require '../db_connect.php'; 

session_start();

if(empty($_SESSION['Category']))
    header("Location: ..");

else if(strcmp($_SESSION['Category'], "member") == 0)
    header("Location: ../librarian/home.php");

$user_name=$_SESSION['username'];
require_once 'count_panier.php';
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
}
if (isset($_POST['add_to_panier'])) {
    if (!empty($_POST['Checked_id'])) {
        $chek_input = $_POST['Checked_id'];
        $price = $_POST['add_to_panier'];
        $chek_input = filter_var($chek_input,FILTER_SANITIZE_NUMBER_INT);
        $insert_panier =mysqli_query($con,"INSERT INTO `panier`(`ClientId`,`ProductId`) VALUES ('$user_ID','$chek_input') ");
    }
    else {
        echo "<script>alert('Couchez le livre s'il vous plait')</script>";
    }
}
elseif (isset($_POST['buy_it'])) {
    if (!empty($_POST['Checked_id'])) {
        $date_current = date("Y-m-d H:i:s");
        $id_book = $_POST['Checked_id'];
        $id_book = filter_var($id_book,FILTER_SANITIZE_NUMBER_INT);
        $sql_price_1 = mysqli_query($con,"SELECT `Prix` AS `price_1` FROM `produits` WHERE `ProductId` = '$id_book' ");
        $fetch_price_1 = mysqli_fetch_assoc($sql_price_1);
        $price_1 = $fetch_price_1['price_1'];
        $sql_commande_it = mysqli_query($con,"INSERT INTO `commande`(`CommandeDate`,`Prix`,`ClientId`)
         VALUES ('$date_current','$price_1','$user_ID')");
         if ($sql_commande_it) {
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
    else {
        echo "<script>alert('Couchez le livre s'il vous plait')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails sur le livre</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../image.css">
    <link rel="stylesheet" href="../slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='main.js' crossorigin='anonymous'></script>
    <style>
    table tr {
        background-color: rgba(255, 255, 255, 0.8);
    }

    tr {
        text-align: center;
    }

    input[type=submit] {
        padding: 5px;
        margin: 0px;
    }

    </style>
</head>
<body>
    <div class="sidebar">
        <li><?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><strong>";echo "@";print_r ($_SESSION['username']);echo "</strong></font></center>"; ?>
        </li>
        <a class="active" href="member.php"><i class='fas fa-bookmark'></i> Commercialisez</a>
        <a href="category.php"><i class='fas fa-poll'></i> Catégorie\</a>
        <a href="panier.php"><i class='fa fa-shopping-cart'></i> Panier
        <?php
        if (!$nb_prod_select == 0) {
            echo "<span class='red'>".$nb_prod_select."</span>";
        }
        ?></a>
        <a href="livraison.php"><i class="fa fa-ship"></i> Mes Livres</a>
        <a href="compte.php"><i class="fas fa-address-card"></i> Compte</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content"><div style='overflow-x:auto;'>
        <fieldset>
            <center>
                <?php
                $sql = mysqli_query($con,"SELECT `p`.`ProductId`, `p`.`NomLivre`, `p`.`Auteur`, `p`.`Description`, `p`.`Prix`, `p`.`CategoryId`,`p`.`image`,`c`.`Parentcategoryid`,`c`.`Name` FROM `produits` AS `p`,`category` as `c` WHERE `p`.`ProductId` = '$book_id' AND `c`.`CategoryId`=`p`.`CategoryId`");
                if (mysqli_num_rows($sql)) {
                    echo "<form method='POST' action=''>";
                    $row = mysqli_fetch_assoc($sql);
                    $image = $row['image'];
                    $pp = $row['Prix'];
                    echo "<table><tr><td>"."<input style='width: 30px;height: 30px;' title='choisir ce livre' type='checkbox' checked name = 'Checked_id' style='width:10px;' value='.$book_id.'></td>";
                    echo "<td align='left'>"."<img src='../file_database/".$image."' width='200'height='200'>"."</td>";
                    echo "<td>";
                    echo "<p style='font-size:2.5vw;'><cite>".$row['NomLivre']."</cite>";
                    echo "<address>";
                    echo "Catégorie : ".$row['Name']."<br>";
                    echo "Auteur(s):<br>".$row['Auteur']."<br>";
                    echo "<img src='../file_database/bar-code.png' width='15px' height='15px'> ISBN : ".$row['Parentcategoryid']."<br>";
                    echo "</address></p>";
                    echo "</td><td>";
                    echo "<strong>".$row['Prix']." MRU</strong><br></td>";
                    echo "<td><button style='width: 170px;' title='Ajouter à la panier' type='submit' name='add_to_panier'/><i title='Ajouter à la panier' class='fa fa-shopping-cart'></i> $pp MRU</button><br>
                    <button style='width: 170px;' title='Acheter en un clique' type='submit' name='buy_it'/><i title='Acheter en un clique' class='fa fa-shopping-cart'></i> $pp MRU</button></td></tr>"; 
                    echo "<tr><td colspan='5'><br><br><strong>Présentation : </strong><br>";
                    echo "<p style='font-size:2.5vw;'>".$row['Description']."</blocquotte>"."</td></tr></table>";
                    echo "</form>";
                }
                ?>
            </center>
        </fieldset></div>
    </div>
</body>
</html>