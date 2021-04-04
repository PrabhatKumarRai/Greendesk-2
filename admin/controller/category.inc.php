<?php

session_start();

include_once '../modal/category.class.php';


//Extract method extracts all the data from the given method
//While using the Extract method, we must add a '$' symbol before the name of the element
extract($_POST);


// Insert Section
if(isset($_POST['addcategory'])){
        
    //Checking weather or not the visibility checkbox is checked
    if(isset($_POST['visibility'])){
        $visibility = 1;
    }else{
        $visibility = 0;
    }

    
    if(empty($category)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }

    $insert = new Category();
    
    //Getting the total number of categories so that we can define the position for new category
    //Here we will take the total category + 1 as $position
    $totalCategory = $insert->getAllCategory();
    $position = $totalCategory->num_rows + 1;

    //Insert Category Operation
    $result = $insert->insertCategory($category, $position, $visibility);

    if($result == 0){
        $_SESSION["category"] = $category;
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Category Created Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Update Section
elseif(isset($_POST['updatecategory'])){
    $category = htmlentities($_POST['category']);
    $c_id = htmlentities($_POST['c_id']);
        
    //Checking weather or not the visibility checkbox is checked
    if(isset($_POST['visibility'])){
        $visibility = 1;
    }else{
        $visibility = 0;
    }

    
    if(empty($category) || empty($c_id)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    $update = new Category();
    $result = $update->updateCategory($category, $c_id, $visibility);

    if($result == 0){
        $_SESSION["category"] = $category;
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Post Updated Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Delete Category
elseif(isset($_POST['deletecategory'])){
    $c_id = htmlentities($_POST['c_id']);
    
    if(empty($c_id)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    $delete = new Category();
    $result = $delete->deleteCategory($c_id);

    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Category Deleted Successfully!!!";
        $_SESSION["class"] = "success";

        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}