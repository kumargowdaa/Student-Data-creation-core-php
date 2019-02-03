<?php

require('database.php');

if($conn){
				$sql = "SELECT * FROM student";
				$result = $conn->query($sql);
		if ($result->num_rows > 0) {
    			//echo "<table><tr><th>ID</th><th>Name</th><th>DOB</th></tr>";
    			// output data of each row
			$arr = [];
			while($row = $result->fetch_assoc()) {
			    array_push($arr,$row);
			    sort($arr);
			}
			echo json_encode($arr);
		} else {
			    echo "0 results";
		}

		$conn->close();

	}else{
		echo 'false';
	}

