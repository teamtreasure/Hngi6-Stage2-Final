<?php
include_once('dbcon.php');
//if user did not login it should redirect back to login page
if (!isset($_SESSION['id'])) {
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<title>Home</title>
</head>

<body>
	<div class="container">
		<?php if (isset($_SESSION['message'])) : ?>

			<div class="alert home">
				<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);

					?>
			</div>
		<?php endif; ?>
		<h2 class="welcome">Welcome Home, <?= $_SESSION['full_name']; ?></h2>
		<a href="logout.php" class="logout">Logout</a>
	</div>

</body>

</html>