<!DOCTYPE html>
<html lang="en">

<head>
    <?php define("VERSION", $this->config->item('queuing_version')); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title)) ? $title . ' | Queuing' : 'Queuing System'; ?></title>
    <link href="<?php echo base_url('build/css/transaction.css?v='.VERSION); ?>" rel="stylesheet">
    <!-- <link href="<?php // echo base_url('vendors/sweetalert2/sweetalert2.min.css?v='.VERSION); ?>" rel="stylesheet"> -->
</head>

<body id="body" class="transaction currentserving">