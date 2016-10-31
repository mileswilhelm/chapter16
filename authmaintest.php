<?php
session_start();

@	$DBhost				=	"localhost";
@	$DBuser				=	"wilhelmm_admin";
@	$DBpass				=	"^D20T7LTw]o5";
@	$DBname				=	"wilhelmm_webdev";
	

	if(!isset($_POST['userid']) && !isset($_POST['password']))
	{
		// if the user has just tried to log in
		$userid			=	$_POST['userid'];
		$password		=	$_POST['password'];
		
		$mysql		=	mysqli_connect($DBhost, $DBuser, $DBpass, $DBname);
		if(!$mysql)
		{
			echo 'Cannot connect to database.';
			exit;
		}
		
		if(mysqli_connect_errno())
		{
			echo 'Connection to database failed:'.mysqli_connect_error();
			exit();
		}
		
		//query the database to see if there is a record which matches
		$query		=	"select count(*) from authorized_users where
						 name = '$userid' and
						 password = sha1('$password')";
		
		$result		=	mysqli_query($mysql, $query);
		if(!$result)
		{
			echo 'Cannot run query.';
			exit;
		}
		
		$row		=	mysqli_fetch_row($result);
		$count		=	$row[0];
		
		if($count > 0)
		{
			//if they are in the database, register the user id
			$_SESSION['valid_user']	=	$userid;
		}

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
	if(isset($_SESSION['valid_user']))
	{
		echo '<p>You are logged in as: '.$_SESSION['valid_user'].'</p>';
		echo '<div><a href="logout.php" class="btn">Log out</a></div>';
	}
	else
	{
		if(isset($userid))
		{
			//if they've tried and failed to log in
			echo '<div class="text-block red"><p class="no-margin">Could not log you in.</p></div>';
		}
		else
		{
			//they have not tried to log in yet or have logged out
			echo '<p>You are not logged in.</p>';
		}
		
	//provide form to log in
	echo '<form method="post" action="authmaintest.php">';
	echo '<div class="form-input__container">';
	echo '<label for="userid" class="form-input_label">Username</label>';
	echo '<input type="text" class="form-input" id="userid" name="userid">';
	echo '</div>';
	echo '<div class="form-input__container">';
	echo '<label for="password" class="form-input_label">Password</label>';
	echo '<input type="password" class="form-input" id="password" name="password">';
	echo '</div>';	
	echo '<button class="btn btn-block" type="submit">Log In</button>';
	
	}
?>
<a href="members_only.php" class="btn">Members Section</a>
</div>
<script>

</script>
</body>
</html>