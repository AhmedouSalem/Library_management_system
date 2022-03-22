<?php require '../db_connect.php'; 

session_start();

if(empty($_SESSION['Category']))
    header("Location: ..");

else if(strcmp($_SESSION['Category'], "member") == 0)
    header("Location: ../librarian/home.php");

$user_name=$_SESSION['username'];
$success = $error = "";
require_once 'count_panier.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bibliothèque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <!-- <li><?php //echo "<img src='../user.jpg' width='160px'/>"."<br>"."<center><font style='font-size:30px;'><strong>";//echo "@";//print_r ($_SESSION['username']);//echo "</strong></font>"; ?></li> -->
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
    <div class="content">
    <form action="search.php" method="post">
                                
                                <strong>ISBN ou Nom :</strong>
                            
                                <input type="search" name="search" id="">
                            <input type="submit" value="chercher">
                    </form>
        <div class="row">
        <!-- <center> -->

            <?php
            echo $error;
        echo $success;
    echo "<form method='post' action=''>";
    $sql = "SELECT `p`.`ProductId`, `p`.`NomLivre`, `p`.`Auteur`, `p`.`Description`, `p`.`Prix`, `p`.`CategoryId`,`p`.`image`,`c`.`Parentcategoryid`,`c`.`Name` FROM `produits` AS `p`,`category` as `c` WHERE `c`.`CategoryId`=`p`.`CategoryId` ORDER BY `c`.`Name` ";
    $resultat = mysqli_query($con, $sql);
    if (mysqli_num_rows($resultat) > 0) {
        while ($r = mysqli_fetch_assoc($resultat)) {
            $id = $r['ProductId'];
            $pp = $r['Prix'];
            
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
            echo "</td><td>"; ?>
            <div class="a"><a href="member_complet.php?buy_it=<?php print($id); ?> ">
            <font color="black"><i title='Ajouter à la panier' class='fa fa-shopping-cart'></i>Ajouter au panier</font>
        </a></div></td></tr></table>   
        </div>
            <?php
        }
    } else {
        echo "Aucun enregistrement";
    }
                echo "</form>";
                
                
    ?>
    </div>
</div>
</body>

</html>