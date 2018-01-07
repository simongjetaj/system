<?php require_once('partials/header.php'); ?>

<!-- Flash messages -->
<?php if($msg=$this->session->flashdata('login_user_success')): ?>
	<?php '<p class="alert alert-success">'.$msg.'</p>' ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
            <div class="well">
            <strong>User Profile</strong>
                <div class="card hovercard">
                    <div class="cardheader">

                    </div>
                    <div class="avatar">
                        <img name="edit_image" alt="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>" src="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>" title="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>">


                    </div>
                    <div class="info">
                        <h2><?php echo $this->session->userdata('fullname'); ?></h2>

                        <div class="desc"><?php echo $this->session->userdata('address'); ?></div>
                    </div>
                    <div class="bottom">
                        <a class="btn btn-primary btn-lg" href="<?php echo base_url('chat') ?>"><i class="fa fa-weixin" aria-hidden="true"></i> Chat</a>

                        <a class="btn btn-warning btn-lg" href="<?php echo base_url('user/edit') ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</a>

                        <a class="btn btn-danger btn-twitter btn-lg" href="<?php echo base_url('user/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once('partials/footer.php'); ?>