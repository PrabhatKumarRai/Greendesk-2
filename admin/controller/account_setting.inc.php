<?php 

session_start();

include_once __DIR__.'/../modal/account_setting.class.php';
include_once __DIR__.'/../includes/plugins/image_upload.inc.php';

// Update Account
if(isset($_POST['updateAccount'])){
    $organization = $_POST['organization'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];

    if(!empty($_POST['current_photo']) && empty($_FILES['photo']['name'])){
        $logo = $_POST['current_photo'];       //Existing/old Image, if any..
    }
    
    if(empty($organization)){
        $_SESSION['msg'] = "Empty Compulsary Feilds";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }

    $update = new Account_Setting();
    
    //calling image upload function from image_upload.inc.php to upload the image
    if(!empty($_FILES['photo']['name'])){
        $logo = imageUpload("settings.php", "org_logo", "organization");
        echo $localpath = $logo;
        $logo = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $logo));        //array to string conversion and getting relative path for image destination
        

        $unlink = $update->GetAccountSetting();
        
        $result = $unlink->fetch_assoc();
    
        if(!empty($result['logo'])  && file_exists($result['logo_local_path'])){
            if(unlink($result['logo_local_path']) == FALSE){
                $_SESSION["msg"] = "Media Deletion Error!!!";
                $_SESSION["class"] = "danger";
                
                header("Location: ../view/settings.php");
                exit;
            }
        }
    }
    

    $result = $update->UpdateAccountSetting($organization, $logo, $localpath, $contact, $email, $facebook, $twitter, $instagram);
    

    if($result == 0){
        $_SESSION['msg'] = "SQL ERROR OCCURED";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
    else{
        $_SESSION['msg'] = "Settings Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: ../view/settings.php");
        exit;
    }

}

// Remove Logo
elseif(isset($_POST['RemoveLogo'])){

    $removeLogo = new Account_Setting();
    $unlink = $removeLogo->GetAccountSetting();
        
    $result = $unlink->fetch_assoc();

    if(!empty($result['logo'])  && file_exists($result['logo_local_path'])){
        if(unlink($result['logo_local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/settings.php");
            exit;
        }
    }

    $result = $removeLogo->RemoveLogo();


    if($result == 0){
        $_SESSION['msg'] = "SQL ERROR OCCURED";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
    else{
        $_SESSION['msg'] = "Settings Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: ../view/settings.php");
        exit;
    }
    
}

else{
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}