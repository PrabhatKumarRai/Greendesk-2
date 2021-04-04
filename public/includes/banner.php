<?php
    include_once __DIR__.'/../modal/account_setting.class.php';

    $accountSetting = new Account_Setting();
    $result = $accountSetting->GetAccountSetting();
    $row = $result->fetch_assoc();
?>

<div class="banner-container text-white">
    <div class="banner-inner">
        <!-- Banner Top Section Starts -->
        <div class="banner-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-0">

                <a class="navbar-brand text-white py-0" href="../">
                    <?php if(!empty($row['logo'])){ ?>
                        <img src="<?= $row['logo']; ?>" alt="<?= $row['organization'] ?>-logo" class="brand-logo rounded-circle">
                    <?php } ?>
                    <?= $row['organization']; ?>
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                      <?php if(isset($_SESSION['u_id'])){?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL_ADMIN ?>view/addpost.php" target="_blank">Add Article</a>
                        </li>
                      <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="enquiry.php">Enquiry</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL_ADMIN ?>" target="_blank">Admin Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Banner Top Section Ends -->

        <!-- Banner Bottom Section Starts -->
        <div class="banner-bottom text-center">
          <form action="searchPost.php" method="GET">
            <div class="banner-bottom-inner">
                <h3>How can we help you ?</h3>
                <div class="banner-bottom-search position-relative text-dark">
                    <input type="text" name="search_text" id="search_text" class="form-control">
                    <button class="btn btn-outline-success d-none" type="submit">Search</button>
                    <div id="searchResult" class="search-suggestions"></div>
                </div>
                <div class="banner-bottom-support-contacts w-100 d-flex justify-content-around flex-wrap">
                    <?php if($row['email'] != '' && $row['email'] != NULL){ ?>
                    <div>
                        <a href="mailto: <?= $row['email']; ?>" target="_blank"><?= $row['email']; ?></a>
                    </div>
                    <?php } ?>

                    <?php if($row['contact'] != '' && $row['contact'] != NULL && $row['contact'] != 0){ ?>
                    <div>
                        <a href="tel: <?= $row['contact']; ?>" target="_blank"><?= $row['contact']; ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
          </form>
        </div>
        <!-- Banner Bottom Section Ends -->
    </div>
</div>
