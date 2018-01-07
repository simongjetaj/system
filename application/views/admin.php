<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simon System</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet"></link>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>" rel="stylesheet"></link>
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet"></link>
</head>
<body style="padding-top: 10rem">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <span class="navbar-brand"><a href="https://simongjetaj.github.io/">Simon S. Gjetaj</a></span>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-home" aria-hidden="true"></i> Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('admin/add') ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Add User</a></li>
                </ul>
              </li>
              <li><a href="chat"><i class="fa fa-weixin" aria-hidden="true"></i> Chat</a></li>
              <li><a href="<?php echo base_url('admin/departments') ?>"><i class="fa fa-list" aria-hidden="true"></i> Departments</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admin/profile') ?>"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('admin/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
        </div>
    </nav>


<!-- Flash messages -->
<div class="container">  
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="users_table">
      <thead>
        <tr>
          <th width="0.5%">#</th>
          <th width="10%">Image</th>
          <th width="20%"><i class="fa fa-sort" aria-hidden="true"></i> Full Name</th>
          <th width="15%"><i class="fa fa-sort" aria-hidden="true"></i> Address</th>
          <th width="20.5%"><i class="fa fa-sort" aria-hidden="true"></i> Email</th>
          <th width="15%"><i class="fa fa-sort" aria-hidden="true"></i> Department</th>
          <th width="19%">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<?php require_once('partials/footer.php'); ?>