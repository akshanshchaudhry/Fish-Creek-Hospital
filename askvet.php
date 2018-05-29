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
<p><a href="contact.php">Contact </a>us if you have a question that you would like answered here.<br>

<?php
mysql_select_db('vet');
$sql="select * from questions";
$result=mysql_query($sql,$conn);
$question_array = array();
$answer_array = array();
$number_of_rows = mysql_num_rows($result);

while($row = mysql_fetch_assoc($result))
{
	
    array_push($question_array, $row["question"]);
    array_push($answer_array, $row["answer"]);
	//echo $row["servicename"]; 
	
}

for ($i = 0; $i < $number_of_rows; $i++ ){
	echo "<dl><dt>".$question_array[$i]."</dt>" ;
	echo "<dd>".$answer_array[$i]."</dd></dl>" ;
	
	
}
?>

<br>
</p>



</body>


<footer>
<p>Copyright &copy; 2016 Fish Creek Animal Hospital<br>
<a href="mailto:akshansh@chaudhry.com" alt="Akshansh Chaudhry Email">akshansh@chaudhry.com</a><br></p>
</footer>

</div>
</body>
</html>
