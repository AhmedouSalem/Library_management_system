<?php require '../db_connect.php'; 

session_start();

if(empty($_SESSION['Category']))
    header("Location: ..");

else if(strcmp($_SESSION['Category'], "member") == 0)
    header("Location: ../librarian/home.php");

$user_name=$_SESSION['username'];
$success = $failed = "";
require_once 'count_panier.php';
if(isset($_GET['cat_name'])) {
    $cat_name = $_GET['cat_name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste Catégories</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../image.css">
    <link rel="stylesheet" href="../slick.css">
    <link rel="stylesheet" href="category_style.css">
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
    strong{
        color:blue;
    }
    a{
        color:blue;
    }
    .a{
        display:inline-block;
        background-color:#04AA6D;
        color:#000000;
        padding: 5px;
        margin: 0px;
        border-radius:5px;
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <li><?php echo "<div class='circle'><img src='../file_database/".$image_user."' width='160px' height='180px'/></div>"."<br>"."<center><font style='font-size:30px;'><b>";echo "@";print_r ($_SESSION['username']);echo "</b></font></center>"; ?>
        </li>
        <a href="member.php"><i class='fas fa-bookmark'></i> Commercialisez</a>
        <a class="active" href="category.php"><i class='fas fa-poll'></i> Catégorie\</a>
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
    <div class="content">
    <strong><font style="font-size: 30px;"><a href="category.php"><i class="fa fa-home"></i>Catégories</a>\<?php echo $cat_name; ?></font></strong>
    <form action="search.php" method="post">
                                
                                <strong>ISBN ou Nom :</strong>
                            
                                <input type="search" name="search" id="">
                            <input type="submit" value="chercher">
                    </form>
        <div class="row">
            <?php
            echo $failed ;
        echo $success;
    $sql_cat = mysqli_query($con,"SELECT `p`.`ProductId`, `p`.`NomLivre`, `p`.`Auteur`, `p`.`Description`, `p`.`Prix`, `p`.`CategoryId`,`p`.`image`,`c`.`Parentcategoryid`,`c`.`Name` FROM `produits` AS `p`,`category` as `c` WHERE `c`.`CategoryId`=`p`.`CategoryId` AND `c`.`Name` = '$cat_name' ");
    if (mysqli_num_rows($sql_cat) > 0) {
        while ($r = mysqli_fetch_assoc($sql_cat)) {
            $id = $r['ProductId'];
            $price_book = $r['Prix'];
            
            $image = $r['image'];
            echo "<div class='column'>";
            echo "<table><tr><td>"; ?>
            <a href="livre.php?book_id=<?php print($id); ?>" title="voir les info de livre"><?php echo "<img src='../file_database/".$image."' width='104'height='142'>"; ?><br></a></td>
            <?php
            echo "<td style = 'width:50%;'>";
            echo "<cite>".$r['NomLivre']."</cite>";
            echo "<address>";
            echo "Auteur(s):<br>".$r['Auteur']."<br>";
            echo "<img src='../file_database/bar-code.png' width='15px' height='15px'> ISBN : ".$r['Parentcategoryid']."<br>";
            echo "</address>";
            echo "</td><td>";?>
            <div class="a"><a href="member_complet.php?buy_it=<?php print($id); ?> ">
            <font color="black"><i title='Ajouter à la panier' class='fa fa-shopping-cart'></i>Ajouter au panier</font>
        </a></div></td></tr></table>
            </div>
            <?php
        }
    } else {
        echo "Aucun enregistrement";
    }
                
                
    ?>
            <!-- <div style="width: 900px;height: 25px;background-color:green;color:white;"><?php //echo $r; ?></div> -->
    </div>
    
    </div>
</body>
</html>