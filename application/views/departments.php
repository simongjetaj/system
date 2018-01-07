<?php require_once('partials/header.php'); ?>

<h1 class="text-center">Departments</h1>

<div class="container  well" id="tree">
<ul>
<!-- Credits to members of codeigniter forum -->
        <?php foreach ($users as $key => $user) : ?>
        <?php if ($key == 0 || $users[$key]['department'] != $users[$key - 1]['department']) : ?>
            <li>
                <?php echo $user['department']; ?>
                <ul>
        <?php endif; ?>
        <li data-jstree='{"disabled":true}'><?php echo $user['fullname']; ?></li>
        <?php if (count($users) - 1 == $key || $users[$key]['department'] != $users[$key + 1]['department']) : ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div> 

 <div class="container">
  <a class="pull-left btn btn-warning btn-sm" href="<?php echo base_url('admin') ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
</div>

<?php require_once('partials/footer.php'); ?>
