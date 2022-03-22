
<?php 
$con=mysqli_connect("localhost","root","","librairie");
if(!$con){die("Erreur de type: " .mysqli_connect_error()); }
else "OK";
$id=$_GET['delete_id'];
$sql = "DELETE FROM `produits` WHERE `CategoryId` = '$id' ;" ;
$sql .= "DELETE  FROM `category` WHERE `CategoryId`='$id'; ";
$resultat = mysqli_multi_query($con,$sql);

	
	if(isset($resultat))
	{
		echo "<script>alert('la supression est bien effectue')</script>";
        header("location:category.php");
	}
	else
	{
		echo "Erreur";
	}

	?>