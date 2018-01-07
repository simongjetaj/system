<?php require_once('partials/header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h3>Edit User</h3>
						</div>
					</div>
					<hr>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<form id="register-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

								<div class="form-group">
                  <label for="fullname">Full Name</label>
									<input type="text" name="fullname" id="fullname" class="form-control" placeholder="<?php echo $user['fullname']; ?>" value="<?php echo $user['fullname']; ?>" autofocus>

									<?php echo form_error('fullname', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
								<img style="margin-bottom: 1rem; border-radius: 50%" alt="<?php echo $user['image']; ?>" width="50" height="50" src="<?php echo base_url('assets/images/'.$user['image']); ?>" title="<?php echo $user['image']; ?>"> 
									<label for="image">Upload New Image:</label>
									<div style="margin-bottom: 1rem">
										<input type="file" 
										id="image"
										name="image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/gif">

										<?php echo form_error('image', '<div class="text-danger">', '</div>'); ?>
									</div>
								</div>

								<div class="form-group">
                <label for="address">Address</label>
									<input type="text" name="address" id="address" class="form-control" placeholder="<?php echo $user['address']; ?>" value="<?php echo $user['address']; ?>">

									<?php echo form_error('address', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<label for="dep">Department</label>
									<input type="text" name="dep" id="dep" class="form-control" placeholder="<?php echo $user['department']; ?>" value="<?php echo $user['department']; ?>">
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-xs-8">
											<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
											<button type="submit" name="edit-submit" id="edit-submit" class="form-control btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
										</div>
										<div class="col-xs-4">
											<a href="<?php echo base_url('admin') ?>" class="btn btn-default form-control"><i class="fa fa-undo" aria-hidden="true"></i> Cancel</a>
										</div>
									</div>
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('partials/footer.php'); ?>