<?php

session_start();

include_once __DIR__.'/../modal/users.class.php';

//Update Section
if(isset($_POST['updatePassword'])){
    $id = htmlentities($_POST['u_id']);
    
    $oldPass = htmlentities($_POST['old_pass']);
    $newPass = htmlentities($_POST['new_pass']);
    $confirmPass = htmlentities($_POST['confirm_pass']);

    $oldpassobj = new Users();
    $oldpass = $oldpassobj->ReadSingleUser('u_id', $id);
    $row = $oldpass->fetch_assoc();

    if(password_verify($oldPass, $row['u_pass']) == TRUE){
        
        //New and Confirm Password match Validation
        if(strcmp($newPass, $confirmPass) == 0){
            //Password Length Validation
            if(strlen($newPass) >= 8){

                //Password Character Validation
                if(preg_match("/[a-z]/", $newPass) == 0 || preg_match("/[A-Z]/", $newPass) == 0 || preg_match("/[0-9]/", $newPass) == 0 || preg_match("/[!@#$%]/", $newPass) == 0){     //must contain atleast 1 lower case, 1 upper case, 1 digit and 1 symbol
                    $_SESSION['msg'] = "Password must contain atleast 1 lower case character, 1 upper case character, 1 digit and 1 special symbol!!!";
                    $_SESSION['class'] = "danger";
                    header("Location: ../view/settings.php");
                    exit;
                }
                else{
                    $newPass = password_hash($newPass, PASSWORD_BCRYPT);
                    $update = new Users();
                    $result = $update->UpdateUserPrivacyInfo($id, $newPass);
                
                    if($result == 0){
                        $_SESSION['msg'] = "SQL Error occured";
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
            }
            else{
                $_SESSION['msg'] = "Password must be atleast 8 characters long!!";
                $_SESSION['class'] = "danger";
                header("Location: ../view/settings.php");
                exit;
            }
        }
        else{
            $_SESSION['msg'] = "New & Confirm password do not match!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/settings.php");
                exit;
        }

    }
    else{
        $_SESSION['msg'] = "Incorrect old Password!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
}

else{
    header("Location: ../");
    exit;
}