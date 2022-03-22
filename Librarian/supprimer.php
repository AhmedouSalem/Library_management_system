
<?php 
$con=mysqli_connect("localhost","root","","librairie");
if(!$con){die("Erreur de type: " .mysqli_connect_error()); }
else "OK";
$id=$_GET['delete_id'];
$sql = "DELETE FROM `panier` WHERE `ProductId` = '$id' ;";
$sql .= "DELETE FROM `produits` WHERE `ProductId`='$id' ;";
$resultat = mysqli_multi_query($con,$sql);

	
	if(isset($resultat))
	{
		header ("location:home.php");
	}
	else
	{
		echo "Erreur";
	}

	?>