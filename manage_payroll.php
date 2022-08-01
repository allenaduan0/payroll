<?php include 'db_connect.php' ?>
<?php 


?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-payroll">
				<input type="hidden" name="id" value="">
				<div class="form-group">
					<label for="" class="control-label">Date From :</label>
					<input type="date" class="form-control" name="date_from">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Date To :</label>
					<input type="date" class="form-control" name="date_to">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Payroll Type :</label>
					<select name="type" class="custom-select browser-default" id="">
						<option value="1">Monthly</option>
						<option value="2">Semi-Monthly</option>
					</select>
				</div>
		</form>
	</div>
</div>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			*{
				font-family: 'Poppins', sans-serif;
			}
</style>

<script>
	$('#manage-payroll').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
		url:'ajax.php?action=save_payroll',
		method:"POST",
		data:$(this).serialize(),
		error:err=>console.log(),
		success:function(resp){
				if(resp == 1){
					alert_toast("Payroll successfully saved","success");
					setTimeout(function(){
								location.reload()
							},1000)
				}
		}
	})
	})
</script>