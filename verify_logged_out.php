<?php
	session_start();
	
	if(empty($_SESSION['Category']));
	else if(strcmp($_SESSION['Category'], "member") == 0)
		header("Location: ../librarian/home.php");
	else if(strcmp($_SESSION['Category'], "Client") == 0)
		header("Location: ../member/member.php");
?>