<?php require '../db_connect.php'; 

session_start();

if(empty($_SESSION['Category']))
    header("Location: ..");

else if(strcmp($_SESSION['Category'], "member") == 0)
    header("Location: ../librarian/home.php");

$user_name =$_SESSION['username'];
$r = $g = "";
require_once 'count_panier.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories Des Classements Des Livres</title>
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

    .margin {
        /* margin: auto; */
        margin-top: 70px;
        width: 100%;
        /* padding: 40px; */
        color: #fff;
    }
    a{
        color:blue;
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
        <fieldset style="width:100%;">
        <div class="margin">
            <strong><font style="font-size: 30px;"><i class="fa fa-home"></i>Catégories\</font></strong>
            <center>
                <h1>Les livres classés par catégories</h1>
            </center>
            <center>
            <?php
        $sql = mysqli_query($con, "SELECT * FROM `category` Group By `Name`");
        if (mysqli_num_rows($sql)) {
            while ($rw = mysqli_fetch_assoc($sql)) {
                $cat_id = $rw['CategoryId'];
                $cat_name = $rw['Name'];
                ?>
                <span class="a"><a href="list_category.php?cat_name=<?php print($cat_name); ?>"><?php echo $cat_name; ?></a></span><br><br><br>

                <?php
            }
        }
        ?>
        </center>
        </div>
    </fieldset>
    </div>
</body>

</html>