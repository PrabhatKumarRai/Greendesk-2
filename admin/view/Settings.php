<?php 
    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/../modal/users.class.php';
    include_once __DIR__.'/../modal/admintheme.class.php';
    include_once __DIR__.'/../modal/account_setting.class.php';

    include_once __DIR__.'/../includes/alert.php';
?>


<?php

    $UserData = new Users();
    $AccountSetting = new Account_Setting();

    $result= $UserData->ReadSingleUser('u_id', 1);

    if($result == ''){
?>
        <div class="search-links-container">
            <div class="search-links-inner text-center py-3">
                <h4>User Not Found !!!</h4>
            </div>
        </div>
<?php
    }
    elseif($result == '0'){
?>
        <div class="search-links-container">
            <div class="search-links-inner text-center py-3">
                <h4>SQL Error Occured !!!</h4>
            </div>
        </div>
<?php
    }
    else{
        
    $row = $result->fetch_assoc();
?>

<div class="accordion" id="postman-settings">


    <!-- Website Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-website-body" aria-expanded="true" aria-controls="setting-admin-theme-body">
            <div class="card-header py-3" id="setting-website-setting">
                Website
            </div>
        </a>

        <div id="setting-website-body" class="collapse" aria-labelledby="setting-website-setting" data-parent="#postman-settings">            
            <div class="card-body">
                <p class="mb-2 font-weight-500 mb-3">Theme : </p>
                <div class="settings-inner d-flex justify-content-start align-items-center flex-wrap">
                    <a href="../controller/website_setting.inc.php?themeColor=1" class="admin-theme-1 btn btn-dark border-0 mb-3 mr-3">Dark</a>
                    <a href="../controller/website_setting.inc.php?themeColor=2" class="admin-theme-2 btn btn-info border-0 mb-3 mr-3" style="background-color: #007bff !important;">Blue</a>
                    <a href="../controller/website_setting.inc.php?themeColor=3" class="admin-theme-3 btn btn-secondary border-0 mb-3 mr-3">Grey</a>
                    <a href="../controller/website_setting.inc.php?themeColor=4" class="admin-theme-4 btn btn-danger border-0 mb-3 mr-3">Red</a>
                    <a href="../controller/website_setting.inc.php?themeColor=5" class="admin-theme-5 btn btn-success border-0 mb-3 mr-3">Green</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Panel Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-admin-theme-body" aria-expanded="true" aria-controls="setting-admin-theme-body">
            <div class="card-header py-3" id="setting-admin-theme-head">
                Admin Panel
            </div>
        </a>
        <div id="setting-admin-theme-body" class="collapse" aria-labelledby="setting-admin-theme-head" data-parent="#postman-settings">            
            <div class="card-body">
                <p class="mb-2 font-weight-500">Admin Panel Theme :</p>
                <div class="settings-inner d-flex justify-content-start align-items-center flex-wrap">
                    <a href="../controller/admin_theme.inc.php?theme=1" class="admin-theme-1 btn btn-dark border-0 mb-3 mr-3">Dark</a>
                    <a href="../controller/admin_theme.inc.php?theme=2" class="admin-theme-2 btn btn-info border-0 mb-3 mr-3">Cyan</a>
                    <a href="../controller/admin_theme.inc.php?theme=3" class="admin-theme-3 btn btn-secondary border-0 mb-3 mr-3">Grey</a>
                    <a href="../controller/admin_theme.inc.php?theme=4" class="admin-theme-4 btn btn-danger border-0 mb-3 mr-3">Red</a>
                    <a href="../controller/admin_theme.inc.php?theme=5" class="admin-theme-5 btn btn-success border-0 mb-3 mr-3">Green</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-account-body" aria-expanded="true" aria-controls="setting-account-body">
            <div class="card-header py-3" id="setting-account-head">
                Organization
            </div>
        </a>
        <div id="setting-account-body" class="collapse" aria-labelledby="setting-account-head" data-parent="#postman-settings">
            <div class="card-body">
                    <div class="settings-inner">
                        <?php
                            $result2 = $AccountSetting->GetAccountSetting();
                            $row2 = $result2->fetch_assoc();
                        ?>
                            <div>
                                <form action="../controller/account_setting.inc.php" method="POST" enctype="multipart/form-data">
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="title">Organization Name<span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control" name="organization" value="<?= $row2['organization']; ?>" required>
                                    </div>
                                    <!-- Logo -->
                                    <div class="form-group">
                                        <label for="author">Logo : </label>
                                        <input type="hidden" name="current_photo" value="<?= ($row2['logo'])? $row2['logo']: ''; ?>">
                                        <input type="file" class="btn btn-block bg-white border" name="photo">
                                        <?php
                                            if($row2['logo']){
                                                echo "Current Image : " . $row2['logo'];
                                            }
                                        ?>
                                    </div>
                                    <!-- Mobile -->
                                    <div class="form-group">
                                        <label for="content">Contact No. : </label>
                                        <input type="number" class="form-control" name="contact" value="<?php echo ($row2['contact']) ? $row2['contact'] : ''; ?>">
                                    </div>
                                                                        
                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="title">Email ID : </label>
                                        <input type="email" class="form-control" name="email" value="<?php echo ($row2['email']) ? $row2['email'] : ''; ?>">
                                    </div>

                                    <!-- Facebook -->
                                    <div class="form-group">
                                        <label for="title">Facebook (Link) : </label>
                                        <input type="url" class="form-control" name="facebook" value="<?php echo ($row2['facebook']) ? $row2['facebook'] : ''; ?>">
                                    </div>

                                    <!-- Twitter -->
                                    <div class="form-group">
                                        <label for="title">Twitter (Link) : </label>
                                        <input type="url" class="form-control" name="twitter" value="<?php echo ($row2['twitter']) ? $row2['twitter'] : ''; ?>">
                                    </div>
                                    
                                    <!-- Instagram -->
                                    <div class="form-group">
                                        <label for="title">Instagram (Link) : </label>
                                        <input type="url" class="form-control" name="instagram" value="<?php echo ($row2['instagram']) ? $row2['instagram'] : ''; ?>">
                                    </div>

                                    <!-- Update Section -->
                                    <button type="submit" name="updateAccount" class="btn btn-primary rounded-0 pl-4 pr-4">Update</button>
                                    <!-- Button trigger modal -->
                                    <a href="#" class='btn btn-danger px-1 m-0 rounded-0' data-toggle="modal" data-target="#removeLogo">Remove Logo</a>

                                </form>

                                <!-- Remove Logo Confirmation Modal Section Starts -->
                                <div class="modal fade" id="removeLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Remove Logo Confirmation</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h5>Are You Sure to Remove Logo ?</h5>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <form action="../controller/account_setting.inc.php" method="POST">
                                                    <button type="submit" class="btn btn-danger rounded-0" name="RemoveLogo">Remove</button>
                                                </form>
                                                <button type="button" class="btn btn-primary rounded-0" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Remove Logo Confirmation Modal Section End -->
                            </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Privacy Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-privacy-body" aria-expanded="false" aria-controls="setting-privacy-body">
            <div class="card-header py-3" id="setting-privacy-head">
                Privacy
            </div>
        </a>
        <div id="setting-privacy-body" class="collapse" aria-labelledby="setting-privacy-head" data-parent="#postman-settings">
            <form action="../controller/users.inc.php" method="POST" autocomplete="off">
                <div class="card-body">
                        
                        <!-- For User ID -->
                        <input type="hidden" name="u_id" value="<?= $row['u_id']; ?>">

                        <!-- Username -->
                        <div class="form-group">
                            <label for="title">Username : </label>
                            <input type="text" class="form-control" name="username" value="<?php echo ($row['u_name']) ? $row['u_name'] : ''; ?>" disabled>
                        </div>

                        <div class="text-secondary mt-4">
                            Change Password
                        </div>
                        <hr>
                        
                        <input type="password" class="autocomplete-off" style="display: none !important;" value="">
                        <!-- Old Password -->
                        <div class="form-group">
                            <label for="title">Enter Old Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="old_pass" autocomplete="new-password" required>
                        </div>    
                        
                        <!-- New Password -->
                        <div class="form-group">
                            <label for="title">New Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="new_pass" autocomplete="new-password" required>
                        </div>     
                        
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="title">Confirm Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="confirm_pass" autocomplete="new-password" required>
                        </div>             
                        <button type="submit" name="updatePassword" class="btn btn-primary rounded-0 pl-5 pr-5">Update</button>
                    </div>
                </div>
            </form>
    </div>
</div>

<?php
    }
?>

<?php include __DIR__.'/../includes/footer.php'; ?>