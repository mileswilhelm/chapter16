<?php
	session_start();
	
	// store to test if they *were* logged in
	$old_user	=	$_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<title>PHP and MySQL Chapter 16 - Logout Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../css/default.css">
<link rel="stylesheet" href="../css/grid.css">
<link rel="stylesheet" href="../css/_text-blocks.css">
<link rel="stylesheet" href="../css/_typography.css">
<link rel="stylesheet" href="../css/_fun.css">
<link rel="stylesheet" href="../css/_text-utilities.css">
<link rel="stylesheet" href="../css/_position-utilities.css">
<link rel="stylesheet" href="../css/_spacing-utilities.css">
<link rel="stylesheet" href="../css/_buttons.css">
<link rel="stylesheet" href="../css/_inputs.css">

</head>
<body>
<div class="container">
	<h1 class="display">Log Out</h1>
<?
	if (!empty($old_user))
	{
		echo '<p>Logged out.</p>';
	}
	else
	{
		// if they weren't logged in but came to this page somehow
		echo '<p>You were not logged in, and so have not been logged out.</p>';
	}
?>
<a href="authmain.php" class="btn">Back to main page</a>
</div>
</body>
</html>