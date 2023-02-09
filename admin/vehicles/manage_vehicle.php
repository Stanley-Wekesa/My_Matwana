
<?php
if(isset($_GET['vehicle_id']) && $_GET['vehicle_id'] > 0){
    $user = $conn->query("SELECT * FROM vehicles where vehicle_id ='{$_GET['vehicle_id']}'");
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-vehicle">
				<input type="hidden" name="vehicle_id" value="<?php echo isset($meta['vehicle_id']) ? $meta['vehicle_id']: '' ?>">
        <div class="form-group">
          <label for="vehicle_number" class="control-label">Number Plate</label>
                  <input name="vehicle_number" id="vehicle_number" type="text" class="form-control rounded-0" value="<?php echo isset($vehicle_number) ? $vehicle_number : ''; ?>" required>
        </div>
        <div class="form-group">
          <label for="vehicle_name" class="control-label">Vehicle Name</label>
                  <input name="vehicle_name" id="vehicle_name" type="text" class="form-control rounded-0" value="<?php echo isset($vehicle_name) ? $vehicle_name : ''; ?>" required>
        </div>
        <div class="form-group">
          <label for="date_purchased" class="control-label">Date Purchased</label>
                  <input name="date_purchased" id="date_purchased" type="date" class="form-control rounded-0" value="<?php echo isset($date_purchased) ? $date_purchased : ''; ?>" required>
        </div>
        <div class="form-group">
          <label for="model" class="control-label">Model</label>
                  <input name="model" id="model" type="text" class="form-control rounded-0" value="<?php echo isset($model) ? $model : ''; ?>" required>
        </div>
        <div class="form-group">
          <label for="description" class="control-label">Description</label>
                  <input name="description" id="description" type="text" class="form-control rounded-0" value="<?php echo isset($description) ? $description : ''; ?>" required>
        </div>
        <div class="form-group col-6">
					<label for="" class="control-label">Image</label>
					<div class="custom-file">
		              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
		              <label class="custom-file-label" for="customFile">Choose file</label>
		            </div>
				</div>
        <div class="form-group">
          <label for="route_id" class="control-label">Company_name</label>
                  <input name="route_id" id="route_id" type="text" class="form-control rounded-0" value="<?php echo isset($route_id) ? $route_id : ''; ?>" required>
        </div>
				<div class="form-group col-6 d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['image']) ? $meta['image'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary mr-2" form="manage-vehicle">Save</button>
					<a class="btn btn-sm btn-secondary" href="./?page=vehicles">Cancel</a>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-vehicles').submit(function(e){
		e.preventDefault();
var _this = $(this)
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=save',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.href = './?page=vehicles';
				}else{
					$('#msg').html('<div class="alert alert-danger">Vehicle already exist</div>')
					$("html, body").animate({ scrollTop: 0 }, "fast");
				}
                end_loader()
			}
		})
	})

</script>
