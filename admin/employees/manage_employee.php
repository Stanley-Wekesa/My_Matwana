<?php
if(isset($_GET['employee_id']) && $_GET['employee_id'] > 0){
    $qry = $conn->query("SELECT * from `employees` where employee_id = '{$_GET['employee_id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($employee_id) ? "Update ": "Create New " ?> Employee</h3>
	</div>
	<div class="card-body">
		<form action="" id="employee-form">
      <div class="form-group">
				<label for="national_id" class="control-label">National ID</label>
                <input name="national_id" id="national_id" type="number" class="form-control rounded-0" value="<?php echo isset($national_id) ? $national_id : ''; ?>" required>
			</div>
      <div class="form-group">
				<label for="dob" class="control-label">Date of Birth</label>
                <input name="dob" id="dob" type="date" class="form-control rounded-0" value="<?php echo isset($dob) ? $dob : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="first_name" class="control-label">First Name</label>
                <input name="first_name" id="first_name" type="text" class="form-control rounded-0" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
			</div>
      <div class="form-group">
				<label for="last_name" class="control-label">Last Name</label>
                <input name="last_name" id="last_name" type="text" class="form-control rounded-0" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
			</div>
            <div class="form-group">
        <label for="gender" class="control-label">Gender</label>
                <select name="gender" id="gender" class="custom-select select">
                <option value="1" <?php echo isset($gender) && $gender == 1 ? 'selected' : '' ?>>Male</option>
                <option value="2" <?php echo isset($gender) && $gender == 2 ? 'selected' : '' ?>>Female</option>
                <option value="3" <?php echo isset($gender) && $gender == 3 ? 'selected' : '' ?>>Others</option>
                </select>
      </div>
            <div class="form-group">
				<label for="telephone" class="control-label">Telephone</label>
                <input name="telephone" id="telephone" type="text" class="form-control rounded-0" value="<?php echo isset($telephone) ? $telephone : ''; ?>" required>
			</div>
            <div class="form-group">
        <label for="title" class="control-label">Title</label>
                <select name="title" id="title" class="custom-select select">
                <option value="1" <?php echo isset($title) && $title == 1 ? 'selected' : '' ?>>Driver</option>
                <option value="2" <?php echo isset($title) && $title == 2 ? 'selected' : '' ?>>Cashier</option>
                <option value="3" <?php echo isset($title) && $title == 3 ? 'selected' : '' ?>>Others</option>
                </select>
      </div>
      <div class="form-group">
				<label for="salary" class="control-label">Salary</label>
                <input name="salary" id="salary" type="number" class="form-control rounded-0" value="<?php echo isset($salary) ? $salary : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="vehicle_name" class="control-label">Vehicle Name</label>
                <input name="vehicle_name" id="vehicle_name" type="text" class="form-control rounded-0" value="<?php echo isset($vehicle_name) ? $vehicle_name : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="employee-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=employees">Cancel</a>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('#employee-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_employee",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=employees";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>
