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

	$(function() {
		$('input[name="dob"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1991,
			maxYear: parseInt(moment().format('YYYY'),12)
			}, function(start, end, label) {
			var years = moment().diff(start, 'years');
			alert("You are " + years + " years old!");
		});
	});

	$('document').ready(function(){
		getData();
	});

	

	function saveDetails(){
		addobj = {};
		if($('#name').val() != '' && $('#dob').val() != ''){
			addobj.name = $('#name').val();
			addobj.dob = $('#dob').val();
		}else{
			return;
		}		
		
		$.ajax({
				type: "POST",
				url: "add.php",
				data: addobj,
				success: function(data){
					alert(data);
					$('#newform').trigger("reset");
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
						<label> Dob:</label> <input type="text" name="dob" class='form-control' id='dob' required="true">
					</div>

				</div>

				<div class='row abc form-group'>
					<div class='col-md-3 col-md-offset-5'>
						<button class='form-control btn-success' id='submit' onclick="saveDetails()">Submit</button>
					</div>

				</div>
			</div>    
		</form>

			<div class="container">
			<table class="table table-bordered style="display: none;"">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>DOB</th>
							<th>Update</th>
						</tr>
					</thead>
					<tbody id="table_body">

					</tbody>
			</table>
		</div> 
			<script type="text/javascript">
				function getData(){
					$.ajax({
						type : "POST",
						url : "fetch.php",
						dataType : 'json', 
						cache : false,
						success : function(data){
							//console.log(data.length);
							//alert(data.length);
							$('#name').val("");
							$('#dob').val("");
							var row = "";
							$("#table_body").empty();
							for(i = 0; i < data.length; i++){
								row += '<tr>' +
										'<td>'+(i+1)+'</td>' +
										'<td>'+data[i].Name+'</td>' +
										'<td>'+data[i].dob+'</td>' +
										'<td>'+'<a href="edit.php?id='+data[i].Id+'">edit</a>'+'</td>'+
										'</tr>';
							}
							//alert(row);
							$("#table_body").append(row);
						}
				});
			}
			</script>
	</body>
</html>
