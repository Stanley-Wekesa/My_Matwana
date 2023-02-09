<?php
if(isset($_GET['company_id']) && $_GET['company_id'] > 0){
    $qry = $conn->query("SELECT * from `companies` where company_id = '{$_GET['company_id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($company_id) ? "Update ": "Create New " ?> Company</h3>
	</div>
	<div class="card-body">
		<form action="" id="company-form">
      <input type="hidden" name ="company_id" value="<?php echo isset($company_id) ? $company_id : '' ?>">
      <div class="form-group">
				<label for="company_name" class="control-label">Company_name</label>
                <input name="company_name" id="company_name" type="text" class="form-control rounded-0" value="<?php echo isset($company_name) ? $company_name : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="telephone" class="control-label">Telephone</label>
                <input name="telephone" id="telephone" type="text" class="form-control rounded-0" value="<?php echo isset($telephone) ? $telephone : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="email" class="control-label">Email</label>
                <input name="email" id="email" type="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="manager_id" class="control-label">Manager ID</label>
                <input name="manager_id" id="manager_id" type="text" class="form-control rounded-0" value="<?php echo isset($manager_id) ? $manager_id : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="company-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=companies">Cancel</a>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('#company-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_company",
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
						location.href = "./?page=companies";
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
