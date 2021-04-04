<?php
session_start();

include_once __DIR__.'/../modal/enquiry.class.php';

if(isset($_POST['submit'])){

    $name = htmlentities($_POST['enquiry-name']);
    $email = htmlentities($_POST['enquiry-email']);
    $subject = htmlentities($_POST['enquiry-subject']);
    $detail = htmlentities($_POST['enquiry-detail']);

    if(empty($name) || empty($email) || empty($subject) || empty($detail)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/enquiry.php?name=$name&email=$email&subject=$subject&detail=$detail");
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['msg'] = "Invalid Email ID!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/enquiry.php?name=$name&email=$email&subject=$subject&detail=$detail");
        exit;
    }

    $enquiry = new Enquiry();
    $result = $enquiry->InsertEnquiry($name, $email, $subject, $detail);

    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/enquiry.php?name=$name&email=$email&subject=$subject&detail=$detail");
        exit;
    }
    else{
        $_SESSION['msg'] = "Enquiry Sent Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/enquiry.php");
        exit;
    }

}

else{
    header("Location: ../view");
}
