<?php
require '../db_connect.php';

session_start();

if (empty($_SESSION['Category'])) {
    header("Location: ..");
} elseif (strcmp($_SESSION['Category'], "member") == 0) {
    header("Location: ../librarian/home.php");
}

$user_name=$_SESSION['username'];
$nom = "";
$success = $failed = "";
require_once 'count_panier.php';
if (isset($_GET['buy_it'])) {
    $Checked_it = $_GET['buy_it'];
}

    if (!empty($Checked_it) && !empty($user_ID)) {
        $inserted_to_panier = mysqli_query($con, "INSERT INTO `panier`(`ClientId`,`ProductId`) VALUES ('$user_ID','$Checked_it') ");
        if (!$inserted_to_panier) {
            echo "error";
        }
    }
    header("location: panier.php");
