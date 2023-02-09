<?php
if(isset($_GET['account_id']) && $_GET['account_id'] > 0){
    $qry = $conn->query("SELECT * from `accounts` where account_id = '{$_GET['account_id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($account_id) ? "Update ": "Create New " ?> Account</h3>
	</div>
	<div class="card-body">
		<form action="" id="accounts-form">
			<input type="hidden" name ="account_id" value="<?php echo isset($account_id) ? $account_id : '' ?>">
			<div class="form-group">
				<label for="account_name" class="control-label">Account Name</label>
                <input name="account_name" id="account_name" type="text" class="form-control rounded-0" value="<?php echo isset($account_name) ? $account_name : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="initial_investment" class="control-label">Initial Investment</label>
                <input name="initial_investment" id="initial_investment" type="number" class="form-control rounded-0" value="<?php echo isset($initial_investment) ? $initial_investment : ''; ?>" required>
			</div>
      <div class="form-group">
				<label for="vehicle_number" class="control-label">Vehicle Number</label>
                <input name="vehicle_number" id="vehicle_number" type="text" class="form-control rounded-0" value="<?php echo isset($vehicle_number) ? $vehicle_number : ''; ?>" required>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="accounts-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=accounting">Cancel</a>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('#accounts-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_account",
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
						location.href = "./?page=accounting";
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
