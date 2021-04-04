<?php 

    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/../modal/account_setting.class.php';
    include_once __DIR__.'/../modal/admintheme.class.php';
    include_once __DIR__.'/../modal/category.class.php';
    include_once __DIR__.'/../modal/enquiry.class.php';
    include_once __DIR__.'/../modal/folder.class.php';
    include_once __DIR__.'/../modal/post.class.php';
    include_once __DIR__.'/../modal/users.class.php';
    include_once __DIR__.'/../modal/website_setting.class.php';

    $accountSetting = new Account_Setting();
    $adminTheme = new Admintheme();
    $category = new Category();
    $enquiry = new Enquiry();
    $folder = new Folder();
    $post = new Post();
    $user = new Users();
    $websiteSetting = new Website_setting();

?>
<div class="index-container">
    <?php 
        $result = $accountSetting->GetAccountSetting();
        if($result != '' && $result != '0'){
            $row = $result->fetch_assoc();
    ?>

    <!-- Organization Details Section Starts -->
    <div class="index-details-container text-center">
        <?php if(!empty($row['logo'])){ ?>  
            <div class="index-details-logo">                  
                    <img src="<?= $row['logo']; ?>" alt="<?= $row['organization'] ?>-logo" class="rounded-circle">
            </div>
        <?php } ?>
        <div class="index-details-organization">
            <h3><?= $row['organization']; ?></h3>
        </div>
    </div>
    
    <?php
        }
    ?> 
    <!-- Organization Details Section Ends -->

    
    <!-- Cards Section Starts -->
    <div class="index-card-container text-center d-flex align-items-center flex-wrap">
        
        <!-- Enquiry Section -->
        <div class="index-card">
            <a href="dashboardDetail.php?data=enquiry">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Enquiry</div>
                        <div class="index-card-tagline">Unreplied</div>
                        <?php
                            $result = $enquiry->GetAllUnreadEnquiry();
                            if($result != '' && $result != '0'){
                                $unreadEnquiry = $result->num_rows;
                            }
                            else{
                                $unreadEnquiry = 0;
                            }
                        ?>
                        <div class="index-card-body w-100"><?= $unreadEnquiry; ?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Category Section -->
        <div class="index-card">
            <?php
                $result = $category->getAllCategory();

                if($result != '' && $result != '0'){
                    $totalPost = $result->fetch_assoc();

                    $totalPost = $result->num_rows;
                }
                else{
                    $totalPost = 0;
                }
            ?>
            <a href="categorylist.php">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Categories</div>
                        <div class="index-card-tagline">Total</div>
                        <div class="index-card-body w-100"><?= $totalPost; ?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Folder Section -->
        <div class="index-card">
            <?php
                $result = $folder->getTotalfolder();

                if($result != '' && $result != '0'){
                    $totalPost = $result->fetch_assoc();

                    $totalPost = $result->num_rows;
                }
                else{
                    $totalPost = 0;
                }
            ?>
            <a href="categorylist.php">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Folders</div>
                        <div class="index-card-tagline">Total</div>
                        <div class="index-card-body w-100"><?= $totalPost; ?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Articles Section -->
        <div class="index-card">
            <?php
                $result = $post->ReadAllPost();

                if($result != '' && $result != '0'){
                    $totalPost = $result->fetch_assoc();

                    $totalPost = $result->num_rows;
                }
                else{
                    $totalPost = 0;
                }
            ?>
            <a href="categorylist.php">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Articles</div>
                        <div class="index-card-tagline">Total</div>
                        <div class="index-card-body w-100"><?= $totalPost; ?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Draft Articles Section -->
        <div class="index-card">
            <?php
                $result = $post->ReadDraftPost();

                if($result != '' && $result != '0'){
                    $row = $result->fetch_assoc();
                    $draftPost = $result->num_rows;
                }
                else{
                    $draftPost = 0;
                }
            ?>
            <a href="dashboardDetail.php?data=draft">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Draft Articles</div>
                        <div class="index-card-tagline">Total</div>
                        <div class="index-card-body w-100"><?= $draftPost; ?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Article Views Section -->
        <div class="index-card">
            <?php
                $result = $post->ViewCount();
                if($result != '0'){
                    $row = $result->fetch_assoc();
            ?>
                <a href="categorylist.php">
            <?php
                }
                else{
            ?>
                <a href="#">
            <?php
                }
            ?>
            
                    <div class="index-card-inner">
                        <div>
                            <div class="index-card-head w-100">Article Views</div>
                            <div class="index-card-tagline">Total</div>
                            <div class="index-card-body w-100"><?= $row['view']; ?></div>
                        </div>
                    </div>
                </a>
        </div>

        <!-- Users Section -->
        <div class="index-card">
            <a href="settings.php">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">User Settings</div>
                        <div class="index-card-tagline">Last Updated</div>
                        <?php
                            $result = $user->ReadSingleUser('u_id', 1);
                            if($result != '' && $result != '0'){
                                $row = $result->fetch_assoc();                        
                        ?>
                        <div class="index-card-body w-100"><?=date('d M, Y' , strtotime($row['last_updated'])); ?></div>
                        <?php }else{ ?>
                            <div class="index-card-body w-100">---</div>
                        <?php } ?>
                    </div>
                </div>
            </a>
        </div>

        <!-- Website Section -->
        <div class="index-card">
            <a href="settings.php">
                <div class="index-card-inner">
                    <div>
                        <div class="index-card-head w-100">Website Theme</div>
                        <div class="index-card-tagline">Current</div>
                        <?php
                            $result = $websiteSetting->GetWebsiteSetting();
                            if($result != '' && $result != '0'){
                                $row = $result->fetch_assoc();                        
                        ?>
                        <div class="index-card-body w-100 text-capitalize"><?= $row['theme_color_name']; ?></div>
                        <?php }else{ ?>
                        <div class="index-card-body w-100 text-capitalize">---</div>
                        <?php } ?>
                    </div>
                </div>
            </a>
        </div>

    </div>    
    <!-- Cards Section Ends -->

</div>

<?php 
    include_once __DIR__.'/../includes/footer.php';
?>