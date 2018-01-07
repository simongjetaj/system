<?php require_once('partials/header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h3 class="text-center">Add Department</h3>
						</div>
					</div>
					<hr>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="login-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

              <label>Department *</label>
								<div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
									<input type="text" name="dep" id="dep" class="form-control" placeholder="<?php echo $user['department']; ?>" value="<?php echo $user['department']; ?>" autofocus>

									<?php echo form_error('dep', '<div class="text-danger">', '</div>'); ?>
								</div>


								<div class="form-group">
									<div class="row">
										<div class="col-xs-8">
											<button type="submit" name="add-submit" id="add-submit" class="form-control btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
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