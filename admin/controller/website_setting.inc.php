<?php
session_start();

include_once __DIR__.'/../modal/website_setting.class.php';

//Update Website Theme
if(isset($_GET['themeColor'])){
    $themeColor = htmlentities($_GET['themeColor']);
    echo $themeColor;
    if(empty($themeColor)){
        $_SESSION['msg'] = "Theme Color Does Not Exists";
        $_SESSION['class'] = "danger";
        header("Location: ../view/");
        exit;
    }

    $websiteThemeColor = new Website_setting();    

    switch($themeColor){
        case 1: $result = $websiteThemeColor->UpdateThemeColor("dark", "#111"); break;
        case 2: $result = $websiteThemeColor->UpdateThemeColor("blue", "#007bff"); break;
        case 3: $result = $websiteThemeColor->UpdateThemeColor("grey", "#777777"); break;
        case 4: $result = $websiteThemeColor->UpdateThemeColor("red", "#a73d3d"); break;
        case 5: $result = $websiteThemeColor->UpdateThemeColor("green", "#2f7950"); break;
        default: $result = $websiteThemeColor->UpdateThemeColor("dark", "#27292b");
    }
    
    if($result == 0){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
    else{
        $_SESSION['msg'] = "Website Theme Color Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: ../view/settings.php");
        exit;
    }
}

else{
    header("Location: ../view");
}