<?php require_once('partials/header.php'); ?>

<h1 class="text-center"><?= $title; ?></h1>

<!-- Flash messages -->
	<div class="col-md-6 col-md-offset-3">
		<?php if($msg=$this->session->flashdata('logout')): ?>
			<?= '<p class="text-center alert alert-success">'.$msg.'</p>' ?>
		<?php endif; ?>
	</div>

	<div class="col-md-6 col-md-offset-3">
		<?php if($msg=$this->session->flashdata('user_registered')): ?>
			<?= '<p class="text-center alert alert-success">'.$msg.'</p>' ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h3 class="text-center">Login</h3>
						</div>
					</div>
					<hr>
				</div>

				<?php if($msg=$this->session->flashdata('login_failed')): ?>
					<?= '<p class="text-center alert alert-danger">'.$msg.'</p>' ?>
				<?php endif; ?> 

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="login-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

								<div class="form-group">
									<input type="email" name="login_email" id="login_email" class="form-control" placeholder="E-mail" autofocus>

									<?php echo form_error('login_email', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<input type="password" name="login_password" id="login_password" class="form-control" placeholder="Password">

									<?php echo form_error('login_password', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-xs-8">
											<button type="submit" name="login-submit" id="login-submit" class="form-control btn btn-login"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
										</div>
										<div class="col-xs-4">
											<a href="<?php echo base_url('register') ?>" class="btn btn-register form-control"><i class="fa fa-sign-out" aria-hidden="true"></i> Register</a>
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