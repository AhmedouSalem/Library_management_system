<?php
$selsect_user_info =mysqli_query($con, "SELECT UserId AS `urser_id`,`image` AS `image_user` FROM `login` WHERE username = '$user_name'");
$fetch_user = mysqli_fetch_assoc($selsect_user_info);
$user_ID = $fetch_user['urser_id'];
$image_user = $fetch_user['image_user'];
$sql_panier = mysqli_query($con,"SELECT COUNT(`ProductId`) AS `nb_prod_select`,`ProductId`,`ClientId` From `panier` WHERE `ClientId` = '$user_ID'");
$fetch_sql_panier = mysqli_fetch_assoc($sql_panier);
$nb_prod_select = $fetch_sql_panier['nb_prod_select'];
?>