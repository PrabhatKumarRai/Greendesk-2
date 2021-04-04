<?php

    session_start();

    include_once __DIR__.'/../../config/config.php';
    include_once __DIR__.'/../modal/account_setting.class.php';

    $titleobj = new Account_Setting();
    $titleresult = $titleobj->GetAccountSetting();
    $websitetitle = $titleresult->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $websitetitle['organization']; ?></title>
    <?php if(!empty($websitetitle['logo'])){ ?>
    <link rel="icon" href="<?= $websitetitle['logo']; ?>" type="image/gif" sizes="16x16">
    <?php }else{ ?>
    <link rel="icon" href="../../uploads/app/logo.png" type="image/gif" sizes="16x16">
    <?php } ?>

    <!---------- Dependencies Section Starts ---------->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/bootstrap/css/bootstrap.min.css">
    <script src="<?= ROOT_URL_WEBSITE ?>includes/js/jquery.min.js"></script>
    <script src="<?= ROOT_URL_WEBSITE ?>includes/bootstrap/js/bootstrap.min.js"></script>
    <!---------- Dependencies Section Ends ---------->

    <!-- Custom CSS Starts -->
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/common.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/banner.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/alert.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/index.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/page.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/post.css">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/theme.php">
    <link rel="stylesheet" href="<?= ROOT_URL_WEBSITE ?>includes/css/searchpage.css">
    <!-- Custom CSS Ends -->

    <!-- Custom JS Starts -->
    <script src="<?= ROOT_URL_WEBSITE ?>includes/js/script.js"></script>
    <script src="<?= ROOT_URL_WEBSITE ?>includes/js/ajax.js"></script>
    <!-- Custom JS Ends -->

</head>
<body>

<div>
    <!-- Including Navbar -->
    <?php include_once 'banner.php'; ?>
