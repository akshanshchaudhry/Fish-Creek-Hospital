<?php

$host = 'localhost:3306';
$user = 'user_name';
$pass = 'password';
$conn = mysql_connect($host,$user,$pass);

if(! $conn)
{
	die( "can not connect" . mysql_error());
}
mysql_select_db('vet');
?>

<html>
<title> Fish Creek Animal Hospital</title>
<head>
<link rel="stylesheet" type="text/css" href="fishcreek.css">
</head>
<div class="body">
<body id="wrapper">

<div>
<h1>Fish Creek Animal Hospital</h1>
</div>

<nav>
<table>

<tr>
<td><a href="index.php">Home </a></td>
</tr>

<tr>
<td><a href="services.php">Services </a></td>
</tr>

<tr>
<td><a href="askvet.php">Ask the Vet </a></td>
</tr>

<tr>
<td><a href="Subscribe.php">Subscribe </a></td>
</tr>

<tr>
<td><a href="contact.php">Contact </a><td>
</tr>

</table>
</nav>

<div class = "page_content">
<h2>Contact Fish Creek</h2>
<p>Required fields are maked with an asterisk (*).<br></p>

<form action ="contact.php" method ="post">
<table>
<tr>
<td><label for="name">* Name: </label></td>
<td> <input type="text" name="name" > </td>
</tr>
<tr>
<td><label for="email">* E-mail: </label></td>
<td> <input type="email" name="email" ></td>
</tr>
<tr>
<td><label for="comments">* Comments: </label></td>
<td> <textarea  name="comments" row="30" col="15" /> </textarea></td>
</tr>
<tr>
<td></td>
<td>
 <input type="submit" value="Send Now" name="send_contact">
 </td>
 </tr>
</table>
</form>

<?php
$name = $_POST['name'];
$email = $_POST['email'];
$comments = $_POST['comments'];
$button = $_POST['send_contact'];

if(isset($button))
{
if(empty($name))
{
	echo "<script type='text/javascript'>";
	echo "alert('Name field must be properly filled!');";
	echo "</script>";
}
else if(empty($email))
{
	echo "<script type='text/javascript'>";
	echo "alert('Email field must be properly filled!');";
	echo "</script>";
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	echo "<script type='text/javascript'>";
	echo "alert('Please enter the valid email id!');";
	echo "</script>";
}

else if(empty($comments))
{
	echo "<script type='text/javascript'>";
	echo "alert('Comments field must be properly filled!');";
	echo "</script>";
}
else
{

$sql = " insert into contact (name, email, comments) values ('$name', '$email', '$comments')";
$result=mysql_query($sql,$conn);
}
}
mysql_close($conn);
?>

</body>
</div>
</body>
</html>
