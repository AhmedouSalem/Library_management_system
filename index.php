<?php
require "db_connect.php";
// require "header.php";
session_start();

if(empty($_SESSION['Category']));
else if(strcmp($_SESSION['Category'], "member") == 0)
	header("Location: librarian/home.php");
else if(strcmp($_SESSION['Category'], "Client") == 0)
	header("Location: member/member.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>bibliothéque webdot</title>
<link rel="icon" type="image/x-icon" href="/Library_management_system/file_database/lbbr.ico">
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="header_style.css">
</head>
<body>
<header>
			<a href="./">
				<div id="cd-logo">
          <img src="centre.jpg" alt=""width="45" height="45">
          <p>Système de gestion d'une bibliothéque</p>
				</div>
			</a>
		</header>

<div id="allTheThings">
			<div id="member">
				<a href="member/login.php">
					<img src="download.png" width="250px" height="auto"/><br />
					&nbsp;Connexion client
				</a>
			</div>
			<div id="verticalLine">
				<div id="librarian">
					<a id="librarian-link" href="Librarian/login.php">
						<img src="librarian.png" width="250px" height="220" /><br />
						&nbsp;&nbsp;&nbsp;Connexion bibliothécaire
					</a>
				</div>
			</div>
		</div>
<!-- </div> -->
</body>
</html>