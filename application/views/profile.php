<?php require_once('partials/header.php'); ?>

<div class="container padding">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
            <div class="well">
            <strong>Administrator Profile</strong>
                <div class="card hovercard">
                    <div class="cardheader">

                    </div>
                    <div class="avatar">
                        <img name="edit_image" alt="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>" src="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>" title="<?php echo base_url('assets/images/'.$this->session->userdata('image')); ?>">
                    </div>
                    <div class="info">
                        <h2><?php echo $this->session->userdata('fullname'); ?></h2>
                        <div class="desc"><?php echo $this->session->userdata('address'); ?></div>
                        <em><?php echo $this->session->userdata('department'); ?></em>
                    </div>
                    <div class="bottom">
                      <a class="btn btn-xs pull-right btn-warning btn-twitter btn-lg" href="<?php echo base_url('admin') ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once('partials/footer.php'); ?>