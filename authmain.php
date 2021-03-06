<?php
	session_start();
	
	if (isset($_POST['userid']) && isset($_POST['password']))
	{
		// if the user has just tried to log in
		$userid		=	$_POST['userid'];
		$password	=	$_POST['password'];
		
		$db_conn	=	new mysqli('localhost', 'wilhelmm_admin', '^D20T7LTw]o5', 'wilhelmm_webdev');
		
		if (mysqli_connect_errno()) 
		{
			echo 'Connection to database failed:'.mysqli_connect_error();
			exit();
		}
		
		$query		=	'select * from authorized_users '
						."where name='$userid' "
						." and password=sha1('$password')";
						
		$result		=	$db_conn->query($query);
		if ($result->num_rows >0)
		{
			// if they are in the database register the user id
			$_SESSION['valid_user']		=	$userid;
		}
		$db_conn->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>PHP and MySQL Chapter 16 - Log In with Database</title>
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
	<h1 class="display">Home Page</h1>
	
<?
	if (isset($_SESSION['valid_user']))
	{
		echo '<p>You are logged in as: '.$_SESSION['valid_user'].'</p>';
		echo '<a href="logout.php" class="btn">Log out</a>';
	}
	else
	{
		if (isset($userid))
		{
			// if they've tried and failed to log in
			echo '<div class="text-block red"><p>Could not log you in.</p></div>;';
		}
		else
		{
			// they have not tried to log in yet or have logged out
			echo '<div class="text-block yellow"><p>You are not logged in.</p></div>';
		}
		
		// provide form to log in
		echo '<form method="post" action="authmain.php">';
		echo '<div class="form-input__container">';
		echo '<label for="userid" class="form-input_label">Username</label>';
		echo '<input type="text" class="form-input" id="userid" name="userid">';
		echo '</div>';
		echo '<div class="form-input__container">';
		echo '<label for="password" class="form-input_label">Password</label>';
		echo '<input type="password" class="form-input" id="password" name="password">';
		echo '</div>';	
		echo '<button class="btn btn-block" type="submit">Log In</button>';
		echo '</form>';
	}
?>	
	<a href="members_only.php" class="btn">Members Section</a>
		
	
</div>
</body>
</html>