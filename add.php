<?php

require('database.php');


$dob = date('Y-m-d', strtotime($_POST['dob']));
$sql = 'INSERT INTO student(name,dob) VALUES ("'.$_POST['name'].'", "'.$dob.'")';  
if(mysqli_query($conn, $sql)){  
	 echo "Record inserted successfully";  
}else{  
	echo "Could not insert record: ". mysqli_error($conn);  
}  
  
mysqli_close($conn);  

