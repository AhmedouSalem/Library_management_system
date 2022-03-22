<?php
require_once '../db_connect.php';
$id=$_GET['deleted_id'];
$sql = "DELETE FROM `panier` WHERE `Id` = '$id' ;";
$resultat = mysqli_multi_query($con, $sql);

    
    if (isset($resultat)) {
        header("location:panier.php");
    } else {
        echo "Erreur";
    }
