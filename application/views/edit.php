<?php require_once('partials/header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h3>Edit</h3>
						</div>
					</div>
					<hr>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<form id="register-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

								<div class="form-group">
									<input type="text" name="edit_fullname" id="edit_fullname" class="form-control" placeholder="Update Full Name" autofocus value="<?php echo $this->session->userdata('fullname'); ?>">
									<?php echo form_error('edit_fullname', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
                  <img style="margin-bottom: 1rem; border-radius: 50%" alt="<?php echo $this->session->userdata('image'); ?>" title="<?php echo $this->session->userdata('image'); ?>" width="50" height="50" src="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>">
									<label>Upload New Image: </label>
									<div style="margin-bottom: 1rem">
										<input type="file" id="edit_image" name="edit_image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/gif">
										<?php echo form_error('edit_image', '<div class="text-danger">', '</div>'); ?>
									</div>
								</div>

								<div class="form-group">
									<input type="text" name="edit_address" id="edit_address" class="form-control" placeholder="New Address" value="<?php echo $this->session->userdata('address'); ?>">
									<?php echo form_error('edit_address', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-xs-4 col-xs-offset-4">
											<button type="submit" name="edit" id="edit-submit" class="form-control btn btn-register" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
										</div>
									</div>
									<a class="pull-left btn btn-warning btn-sm" href="<?php echo base_url('user') ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
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