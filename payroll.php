<?php include('db_connect.php') ?>
		<div class="container-fluid " >
			<div class="col-lg-12">
				
				<br />
				<br />
				<div class="card">
					<div class="card-header" style="background: #FCAF38;">
						<span><b>Payroll List</b></span>
						<button class="btn btn-primary btn-sm btn-block col-md-3 float-right" style="background: #50A3A4;color:WHITE;" type="button" id="new_payroll_btn"><span class="fa fa-plus"></span> Add Payroll</button>
					</div>
					<div class="card-body">
						<table id="table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Ref No</th>
									<th>Date From</th>
									<th>Date To</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
									$payroll=$conn->query("SELECT * FROM payroll order by date(date_from) desc") or die(mysqli_error());
									while($row=$payroll->fetch_array()){
								?>
								<tr>
									<td><?php echo $row['ref_no']?></td>
									<td><?php echo date("M d, Y",strtotime($row['date_from'])) ?></td>
									<td><?php echo date("M d, Y",strtotime($row['date_to'])) ?></td>
									<?php if($row['status'] == 0): ?>
									<td class="text-center"><span class="badge badge-primary">New</span></td>
									<?php else: ?>
									<td class="text-center"><span class="badge badge-success">Calculated</span></td>
									<?php endif ?>
									<td>
										<center>
									<?php if($row['status'] == 0): ?>
										 <button class="btn btn-sm btn-outline-primary calculate_payroll" data-id="<?php echo $row['id']?>" type="button">Calculate</button>
									<?php else: ?>
										 <button class="btn btn-sm btn-outline-primary view_payroll" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-eye"></i></button>
									<?php endif ?>

										<button class="btn btn-sm btn-outline-primary edit_payroll" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
										<button class="btn btn-sm btn-outline-danger remove_payroll" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
										</center>
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			*{
				font-family: 'Poppins', sans-serif;
			}
		</style>
		
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			

			
			$('.edit_payroll').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Edit Employee","manage_payroll.php?id="+$id)
				
			});
			$('.view_payroll').click(function(){
				var $id=$(this).attr('data-id');
				location.href = "index.php?page=payroll_items&id="+$id;
				
			});
			$('#new_payroll_btn').click(function(){
				uni_modal("New Payroll","manage_payroll.php")
			})
			$('.remove_payroll').click(function(){
				_conf("Are you sure to delete this payroll?","remove_payroll",[$(this).attr('data-id')])
			})
			$('.calculate_payroll').click(function(){
				start_load()
				$.ajax({
					url:'ajax.php?action=calculate_payroll',
					method:"POST",
					data:{id:$(this).attr('data-id')},
					error:err=>console.log(err),
					success:function(resp){
							if(resp == 1){
								alert_toast("Payroll successfully computed","success");
									setTimeout(function(){
									location.reload();

								},1000)
							}
						}
				})
			})
		});
		function remove_payroll(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_payroll',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
	</script>
