<?php
if(isset($_GET['route_id']) && $_GET['route_id'] > 0){
    $qry = $conn->query("SELECT * from `routes` where route_id = '{$_GET['route_id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($route_id) ? "Update ": "Create New " ?> Route</h3>
	</div>
	<div class="card-body">
		<form action="" id="route-form">
			<input type="hidden" name ="route_id" value="<?php echo isset($route_id) ? $route_id : '' ?>">
			<div class="form-group">
				<label for="route_name" class="control-label">Route Name</label>
                <input name="route_name" id="route_name" type="text" class="form-control rounded-0" value="<?php echo isset($route_name) ? $route_name : ''; ?>" required>
			</div>
            <div class="form-group">
				<label for="description" class="control-label">Description</label>
                <input name="description" id="description" type="text" class="form-control rounded-0" value="<?php echo isset($description) ? $description : ''; ?>" required>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="route-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=routes">Cancel</a>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('#route-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_route",
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
						location.href = "./?page=routes";
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
