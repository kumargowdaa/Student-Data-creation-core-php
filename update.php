<?php

require('database.php');
$dob =  date('Y-m-d', strtotime($_POST['dob']));;
$sql = 'UPDATE student set  Name="'.$_POST['name'].'", dob = "'.$dob.'"
where Id = "'.$_POST['id'].'" ';  

if(mysqli_query($conn, $sql)){  
	echo "Record updated successfully";  
	// header("Location: http://localhost/samp/view.php");
}else{  
	echo "Could not update record: ". mysqli_error($conn);  
}  
  
mysqli_close($conn);  
?>