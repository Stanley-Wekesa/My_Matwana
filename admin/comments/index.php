<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Comments</h3>
		<div class="card-tools">
			<a href="?page=comments/manage_comment" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="5%">
					<col width="5%">
					<col width="10%">
					<col width="5%">
					<col width="30%">
					<col width="17%">
					<col width="5%">
					<col width="10%">
					<col width="3%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Comment ID</th>
						<th>Date Posted</th>
						<th>Username</th>
						<th>Post ID</th>
						<th>Message</th>
						<th>Reply</th>
						<th>Date Replied</th>
						<th>Who Replied</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
						$qry = $conn->query("SELECT * from `comments` order by (`date_posted`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['comment_id'] ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_posted'])) ?></td>
							<td><?php echo ucwords($row['username']) ?></td>
							<td><?php echo $row['post_id'] ?></td>
							<td><?php echo ucwords($row['message']) ?></td>
							<td><?php echo ucwords($row['reply']) ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_replied'])) ?></td>
							<td><?php echo ucwords($row['who_replied']) ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=comments/manage_comment&comment_id=<?php echo $row['comment_id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['comment_id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
			_conf("Are you sure to delete this Comment permanently?","delete_comment",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_comment($comment_id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_comment",
			method:"POST",
			data:{comment_id: $comment_id},
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
