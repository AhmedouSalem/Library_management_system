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
    <title>Recherche</title>
    <link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
    <link rel="stylesheet" href="../css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    label {
        color: #04AA6D;
    }

    input,
    textarea,
    select {
        width: 300px;
    }

    h2 {
        color: #04AA6D;
        font: size 25px;
    }

    .myDIV {
        width: 100px;
        height: 20px;
        background: red;
        position: relative;
        animation: mymove 5s infinite;
    }

    @keyframes mymove {
        from {
            left: 0px;
        }

        to {
            left: 300px;
        }
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
        <a href="status.php"><i class="fa fa-stop-circle"></i> Commande en attente</a>
        <a href="category.php">liste des catégorie</a>
        <a class="active" href="search.php"><i class="fa fa-search"></i> Chercher</a>
        <a style="color:red;" href="../logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
    </div>
    <div class="content">
        <div class="container">
            <center><div style='overflow-x:auto;'>
                <table cellspacing="10">
                    <tr>
                        <td>
                            <center>
                                <h2>chercher un livre</h2>
                            </center>
                            <table>
                                <form action="search_livre.php" method="post">
                                    <tr>
                                        <td>
                                            <label>ISBN ou Nom</label>
                                        </td>
                                        <td>
                                            <input style="background-color: white;" type="search" name="search" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><input type="submit" value="chercher"></td>
                                    </tr>
                                </form>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="myDIV"></div>
                            <center>
                                <h2>chercher une catégorie</h2>
                            </center>
                            <table>
                                <form action="search_category.php" method="post">
                                    <tr>
                                        <td>
                                            <label for="">
                                                Nom categorie:
                                            </label>
                                        </td>
                                        <td>
                                            <input style="background-color: white;" type="search" name="search_c" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><input type="submit" value="chercher"></td>
                                    </tr>
                                </form>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
    </div>
</body>

</html>