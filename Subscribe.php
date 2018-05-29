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

<h2>Subscribe Fish Creek</h2>
<p>
Required fields are maked with an asterisk (*).</p>

<form action ="Subscribe.php" method ="post">
<table>
<tr>
<td><label for="client_full_name">* Client Full Name:</label></td>
<td> <input type="text" name="client_full_name" > </td>
</tr>
<tr>
<td><label for="address">* Address:</label></td>
<td> <input type="text" name="client_address" ></td>
</tr>
<tr>
<td><label for="client_email">* E-mail:</label></td>
<td> <input type="email" name="client_email" ></td>
</tr>
<tr>
<td><label for="client_phone">* Phone:</label></td>
<td> <input type="text" name="client_phone" ></td>
</tr>
<tr>
<td><label for="client_password">* Password:</label></td>
<td> <input type="password" name="client_password" ></td>
</tr>
<tr>
<td><label for="type_of_service">* Type of Service:</label></td>
<td>  
<?php

$sql="select * from service";
$result=mysql_query($sql,$conn);
$service_array = array();
$number_of_rows = mysql_num_rows($result);

while($row = mysql_fetch_assoc($result))
{
	
    array_push($service_array, $row["servicename"]);	
	//echo $row["servicename"]; 
	
}


echo '<select name = "service_name">' ;
for ($i = 0; $i < $number_of_rows; $i++ ){
	echo "<option>".$service_array[$i]."</option>";
}
 
 
echo "</select>"



?>


</td>
</tr>
<tr>
<td><label for="pet">* Pet:</label></td>
<td> 
<?php

$sql2="select * from pet";
$result2=mysql_query($sql2,$conn);
$pet_array = array();
$number_of_rows_pet = mysql_num_rows($result2);

while($row2 = mysql_fetch_assoc($result2))
{
	
    array_push($pet_array, $row2["petname"]);	
	//echo $row["servicename"]; 
	
}


echo '<select name = "pet_name">' ;
for ($i = 0; $i < $number_of_rows_pet; $i++ ){
	echo "<option>".$pet_array[$i]."</option>";
}
 
 
echo "</select>"

?>
</td>
</tr>
<tr>
<td></td>
<td>
 <input type="submit" value="Send Now" name="send_now_subscribe"></td></tr>
</table>
</form>

</span>

<?php
$client_full_name = $_POST['client_full_name'];
$client_address = $_POST['client_address'];
$client_email = $_POST['client_email'];
$client_phone = $_POST['client_phone'];
$client_password = $_POST['client_password'];
$service_name = $_POST['service_name'];
$pet_name = $_POST['pet_name'];
$button = $_POST['send_now_subscribe'];

$sql4 = "select serviceid from service where servicename = '$service_name' ";
$result4 = mysql_query($sql4,$conn);
$row4 = mysql_fetch_array($result4,MYSQL_ASSOC);
$serviceid_tbi = $row4['serviceid'];

$sql5 = "select petid from pet where petname = '$pet_name' ";
$result5 = mysql_query($sql5,$conn);
$row5 = mysql_fetch_array($result5,MYSQL_ASSOC);
$petid_tbi = $row5['petid'];

if(isset($button))
{
	if(empty($client_full_name))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Name field must be properly filled!');";
		echo "</script>";
	}
		else if(empty($client_address))
		{
			echo "<script type='text/javascript'>";
			echo "alert('Address field must be properly filled!');";
			echo "</script>";
		}
		else if(empty($client_email))
		{
			echo "<script type='text/javascript'>";
			echo "alert('E-mail field must be properly filled!');";
			echo "</script>";
		}
		else if(!filter_var($client_email, FILTER_VALIDATE_EMAIL))
		{
			echo "<script type='text/javascript'>";
			echo "alert('Please enter the valid email id!');";
			echo "</script>";
		}

		else if(empty($client_phone))
		{
			echo "<script type='text/javascript'>";
			echo "alert('Phone number must be must be properly filled!');";
			echo "</script>";
		}
		
		else if(!preg_match("/^[0-9]{10}$/", $client_phone))
			{
				echo "<script type='text/javascript'>";
				echo "alert('Phone number must contain only 10 numbers!');";
				echo "</script>";
			}

		else if(empty($client_password))
		{
			echo "<script type='text/javascript'>";
			echo "alert('Password must be must be properly filled!');";
			echo "</script>";
		}
		else if (strlen($client_password) < '8') 
		{
			echo "<script type='text/javascript'>";
			echo "alert('Your Password Must Contain At Least 8 Characters!');";
			echo "</script>";
		}

		else if (strlen($client_password) > '16') 
		{
			echo "<script type='text/javascript'>";
			echo "alert('Your Password Must Not Be More Than 16 Characters!');";
			echo "</script>";
		   
		}

		elseif(!preg_match("#[0-9]+#",$client_password)) {
			echo "<script type='text/javascript'>";
			echo "alert('Your Password Must Contain At Least 1 Number!');";
			echo "</script>";
		}
		elseif(!preg_match("#[A-Z]+#",$client_password)) {
			echo "<script type='text/javascript'>";
			echo "alert('Your Password Must Contain At Least 1 Capital Letter!');";
			echo "</script>";
			
		}
		elseif(!preg_match("#[a-z]+#",$client_password)) {
			echo "<script type='text/javascript'>";
			echo "alert('Your Password Must Contain At Least 1 Lowercase Letter!');";
			echo "</script>";
		}
		
	// database transanction starts here
	
    $client_password = md5($client_password);
	
	$sql = "select clientid from client where email ='$client_email'";	
	$result=mysql_query($sql,$conn);
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$sql_email = "select email from client where email = '$client_email'";
	$result_email= mysql_query($sql_email,$conn);
	$row_email = mysql_fetch_array($result_email,MYSQL_ASSOC);

	
	
	if ($row_email['email'] != $client_email)
	{
	$sql2 = " insert into client (name, address, phone, email, password) values ('$client_full_name', '$client_address', '$client_phone','$client_email','$client_password')";
	$result2 = mysql_query($sql2,$conn);
	

	$sql3 = "select clientid from client where email = '$client_email' ";
	$result3 = mysql_query($sql3,$conn);
	$row3 = mysql_fetch_array($result3,MYSQL_ASSOC);
	$clientid_tbi = $row3['clientid'];

	$sql6 = "insert into subscription (clientid, serviceid, petid, date) values ($clientid_tbi,$serviceid_tbi,$petid_tbi,curdate()) ";
	$result6 = mysql_query($sql6,$conn);

	//echo "data inserted in subscription talbe";
	}
	else{
		
	$sql3 = "select clientid from client where email = '$client_email' ";
	$result3 = mysql_query($sql3,$conn);
	$row3 = mysql_fetch_array($result3,MYSQL_ASSOC);
	$clientid_tbi = $row3['clientid'];


	$sql6 = "insert into subscription (clientid, serviceid, petid, date) values ($clientid_tbi,$serviceid_tbi,$petid_tbi,curdate()) ";
	$result6 = mysql_query($sql6,$conn);

	}
//echo "working fine";

}



mysql_close($conn);
?>



</body>


<footer>
<p>Copyright &copy; 2016 Fish Creek Animal Hospital<br>
<a href="mailto:akshansh@chaudhry.com" alt="Akshansh Chaudhry Email">akshansh@chaudhry.com</a><br></p>
</footer>

</div>
</body>
</html>
