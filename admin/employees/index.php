<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Employees</h3>
		<div class="card-tools">
			<a href="?page=employees/manage_employee" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="5%">
					<col width="12%">
					<col width="12%">
					<col width="16%">
					<col width="5%">
					<col width="10%">
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="5%">
					<col width="5%">

				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>National ID</th>
						<th>Date Created</th>
						<th>DOB</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Contact</th>
						<th>Title</th>
						<th>Salary</th>
						<th>Vehicle Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
						$qry = $conn->query("SELECT * from `employees` order by (`date_registered`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo ($row['national_id']) ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_registered'])) ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['dob'])) ?></td>
							<td>
								<p class="m-0 lh-1">
								<?php echo ucwords($row['first_name']) ?>
								<?php echo ucwords($row['last_name']) ?>
								</p>
							</td>
							<td class="text-center">
                                <?php if($row['gender'] == 1): ?>
                                    <span class="badge badge-success">Male</span>
                                <?php elseif ($row['gender'] == 2):  ?>
                                    <span class="badge badge-danger">Female</span>
																<?php else: ?>
																    <span class="badge badge-success">Others</span>
                                <?php endif; ?>
                            </td>
							<td><?php echo ($row['telephone']) ?></td>
							<td><?php echo ucwords($row['title']) ?></td>
							<td><?php echo ($row['salary']) ?></td>
							<td><?php echo ($row['vehicle_name']) ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=employees/manage_employee&employee_id=<?php echo $row['employee_id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['employee_id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this employee permanently?","delete_employee",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_employee($employee_id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_employee",
			method:"POST",
			data:{employee_id: $employee_id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
