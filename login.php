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

</head>
<body>
<div class="container">
<?php

	//create short names for variables
@   $name		=	$_POST['name'];	
@   $password	=	$_POST['password'];	
@	$DBhost		=	"localhost";
@	$DBuser		=	"wilhelmm_admin";
@	$DBpass		=	"^D20T7LTw]o5";
@	$DBname		=	"wilhelmm_webdev";
	

	if(!isset($name)||!isset($password))
	{
		//Visitor needs to enter a name and password	
	?>
		<h1>Please Log In</h1>
		<p>This page is secret.</p>
		
		<form method="post" action="login.php">
		<table border="1">
			<tr>
				<th>Username</th>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class="btn" type="submit" value="Log In">
				</td>
			</tr>
		</table>
		</form>
<?php
	}
	else
	{
		//connect to mysql
		$mysql		=	mysqli_connect($DBhost, $DBuser, $DBpass, $DBname);
		if(!$mysql)
		{
			echo 'Cannot connect to database.';
			exit;
		}
		
		//query the database to see if there is a record which matches
		$query		=	"select count(*) from authorized_users where
						 name = '$name' and
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
			//visitor's name AND password are correct
			echo '<h1>Welcome!</h1>';
			echo '<p>I bet you are glad you can see this.</p>';
		}
		else
		{
			//visitor's name OR password are not correct
			echo '<h1>Error</h1>';
			echo '<p>You are not authorized to view this resource.</p>';
		}
	}
?>
</div>
<script>

</script>
</body>
</html>