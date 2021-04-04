<?php

session_start();

include_once '../modal/folder.class.php';
include_once '../modal/post.class.php';


//Extract method extracts all the data from the given method
//While using the Extract method, we must add a '$' symbol before the name of the element
extract($_POST);

print_r($_POST);
// Insert Section
if(isset($_POST['addFolder'])){
    
    //Checking weather or not the visibility checkbox is checked
    if(isset($_POST['visibility'])){
        $visibility = 1;
    }
    else{
        $visibility = 0;
    }
    
    if(empty($folder) || empty($c_id)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    $insert = new Folder();
    
    //Getting the total number of folder so that we can define the position for new folder
    //Here we will take the total folder + 1 as $position
    $totalFolder = $insert->getAllfolder($c_id);
    $position = $totalFolder->num_rows + 1;

    //Insert Folder Operation
    $result = $insert->insertfolder($folder, $c_id, $position, $visibility);
    
    if($result == 0){
        $_SESSION["folder"] = $folder;
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Folder Created Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Update Section
elseif(isset($_POST['updatefolder'])){
    $folder = htmlentities($_POST['folder']);
    $c_id = htmlentities($_POST['c_id']);
    $f_id = htmlentities($_POST['f_id']);
        
    //Checking weather or not the visibility checkbox is checked
    if(isset($_POST['visibility'])){
        $visibility = 1;
    }else{
        $visibility = 0;
    }
    
    if(empty($folder) || empty($c_id) || empty($f_id)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    $update = new Folder();
    $post = new Post();

    $result = $update->updatefolder($folder, $c_id, $f_id, $visibility);
    $result1 = $post->updatePostCategory($c_id, $f_id);

    if($result == 0 || $result1 == 0){
        $_SESSION["folder"] = $folder;
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Folder Updated Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Delete folder
elseif(isset($_POST['deletefolder'])){
    $f_id = htmlentities($_POST['f_id']);
    
    if(empty($f_id)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    $delete = new Folder();
    $result = $delete->deletefolder($f_id);

    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Folder deleted Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}

else{
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}