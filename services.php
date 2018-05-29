<?php

$host = 'localhost:3306';
$user = 'user_name';
$pass = 'password';
$conn = mysql_connect($host,$user,$pass);

if(! $conn)
{
	die( "can not connect" . mysql_error());
}

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
<p>
<ul>

<?php
mysql_select_db('vet');
$sql="select * from service";
$result=mysql_query($sql,$conn);
$service_array = array();
$service_array_desc = array();
$number_of_rows = mysql_num_rows($result);

while($row = mysql_fetch_assoc($result))
{
	
    array_push($service_array, $row["servicename"]);
    array_push($service_array_desc, $row["description"]);
	//echo $row["servicename"]; 
	
}

for ($i = 0; $i < $number_of_rows; $i++ ){
	echo "<li><strong><span>".$service_array[$i]."</span></strong><br></li>".$service_array_desc[$i] ;
	
	
}
?>


</ul>

</p>


<br>
<br>


<footer>

<p id="contact"><span><i>Copyright &copy; 2016 Fish Creek Animal Hospital</i></span><br>
<a href="mailto:akshansh@chaudhry.com" alt="Akshansh Chaudhry Email">akshansh@chaudhry.com</a><br></p>
</footer>
</div>
</body>
</html>
