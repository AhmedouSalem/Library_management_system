<?php
require '../db_connect.php';

session_start();

if (empty($_SESSION['Category'])) {
    header("Location: ..");
} elseif (strcmp($_SESSION['Category'], "member") == 0) {
    header("Location: ../librarian/home.php");
}

$user_name=$_SESSION['username'];
$success = $failed = "";
require_once 'count_panier.php';
if (isset($_GET['buy_it'])) {
    $Checked_it = $_GET['buy_it'];


    if (!empty($Checked_id) && !empty($user_ID)) {
        $insert_into_paniers = mysqli_query($con, "INSERT INTO `panier`(`ClientId`,`ProductId`) VALUES ('$user_ID','$Checked_id') ");
        
        if (!$insert_into_paniers) {
            echo "error";
        } else {
            header("location:panier.php");
        }
    }
}
