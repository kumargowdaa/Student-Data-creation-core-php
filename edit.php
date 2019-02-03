<?php
	require('database.php');
	if(isset($_GET['id'])){
			if($conn){
						$sql = "SELECT * FROM student where Id='".$_GET['id']."'";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$arr = $result->fetch_assoc();
							}else{
								echo 'No results';
							}
					}else{
						echo 'false';
					}	
	}
	mysqli_close($conn); 
?>
<html>
<head>	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script type="text/javascript">

	$('document').ready(function(){
		<?php if(isset($_GET['id'])){ ?>
			$("#editid").val("<?php echo $_GET['id']; ?>");
			$("#name").val("<?php echo $arr['Name']; ?>");
			$("#dob").val("<?php echo date('m-d-Y', strtotime($arr['dob'])); ?>");
			<?php }  ?>			
	});
	$(function() {
		$('input[name="dob"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1991,
			maxYear: parseInt(moment().format('YYYY'),10)
			}, function(start, end, label) {
			var years = moment().diff(start, 'years');
			alert("You are " + years + " years old!");
		});
	});
	function editDetails(){
		addobj = {};
		if($('#name').val() != '' && $('#dob').val() != ''){
			addobj.name = $('#name').val();
			addobj.dob = $('#dob').val();
			addobj.id = $('#editid').val();
			console.log(addobj);
			alert(addobj);
		}else{
			return;
		}		
		
		$.ajax({
				type: "POST",
				url: "update.php",
				data: addobj,
				success: function(data){
					//alert(data);
					$('#newform').trigger("reset");
					location.href = "view.php"
				}
		});
	}

	</script>
	<style type="text/css">
		.abc{
			    margin-top: 30px;
		}
		.aligntiltle{
			margin-right: -90px
		}
	</style>
</head>
	<body>
		<form role="form" id='newform'>
	  		<div class='container'>
				<h1 class='aligntiltle'><center>Student Details</center></h1>
				<div class='row abc form-group'>
					<div class='col-md-3 col-md-offset-5'>
						<label> Name:</label><input type="text" name="name" class='form-control' id='name' required="true">
					</div>
				</div>

				<div class='row abc form-group'>
					<div class='col-md-3 col-md-offset-5'>
						<label> Dob:</label> <input type="text" name="dob" value="10/24/1991" class='form-control' id='dob' required="true">
						<input type="hidden" id='editid'>
					</div>

				</div>

				<div class='row abc form-group'>
					<div class='col-md-3 col-md-offset-5'>
						<button class='form-control btn-success' id='submit' onclick="editDetails()">Submit</button>
					</div>

				</div>
			</div>    
		</form>
			
	</body>
</html>
