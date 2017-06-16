<!DOCTYPE html>
<html lang="id">
<head>
  <title>Halaman <?php echo $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/static.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datetimepicker.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css')?>">
  <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.datetimepicker.full.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/ui/1.11.4/jquery-ui.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
  <style>
    body{
    background-color: #ffffff;
    }
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #02002f;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>