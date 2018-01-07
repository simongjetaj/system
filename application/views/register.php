<?php require_once('partials/header.php'); ?>

<h1 class="text-center"><?= $title; ?></h1>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h3>Register</h3>
						</div>
					</div>
					<hr>
				</div>

				<!-- Flash messages -->
				<?php if($msg=$this->session->flashdata('error')): ?>
					<?= '<span class="text-center alert-danger">'.$msg.'</span>' ?>
				<?php endif; ?>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<form id="register-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

								<div class="form-group">
									<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" autofocus>

									<?php echo form_error('fullname', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<label>Upload Image: </label>
									<div style="margin-bottom: 1rem">
										<input type="file" 
										id="image"
										name="image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/gif">

										<?php echo form_error('image', '<div class="text-danger">', '</div>'); ?>
									</div>
								</div>

								<div class="form-group">
									<input type="text" name="address" id="address" class="form-control" placeholder="Address">

									<?php echo form_error('address', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<input type="email" name="register_email" id="register_email" class="form-control" placeholder="E-mail">

									<?php echo form_error('register_email', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<input type="password" name="register_password" id="register_password" class="form-control" placeholder="Password">

									<?php echo form_error('register_password', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<input type="password" name="register_password2" id="register_password2" class="form-control" placeholder="Confirm Password">

									<?php echo form_error('register_password2', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-xs-8">
											<button type="submit" name="register-submit" id="register-submit" class="form-control btn btn-register"><i class="fa fa-sign-out" aria-hidden="true"></i> Register</button>
										</div>
										<div class="col-xs-4">
											<a href="<?php echo base_url() ?>" class="btn btn-login form-control"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
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