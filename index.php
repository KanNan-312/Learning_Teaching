<?php
	include "connectDB.php";		# Connect Database
	session_start();				# Session to save login account information
	$direct = 'login';				# Default page will be login page

	if(isset($_GET['page']))
	{
		$direct = $_GET['page'];
	}
	else if(isset($_POST['page']))
	{
		$direct = $_POST['page'];
	}
?>

<html lang="en">
<head>
	<?php include "head.php" ?>		<!-- Include css and js, or anything else -->
</head>
<body>
	<?php
		if($direct == "login" or $direct == "logout" or !isset($_SESSION["id"])) {
			if($direct == "logout") {
				session_destroy();
			}
			echo '<div class="login-page-container">';
				include "login.php";
			echo '</div>';
		}
		else {
			include "navbar.php";
			echo '<div class="page-container">';
				include $direct . ".php";
			echo '</div>';
		}
	?>
</body>
</html>