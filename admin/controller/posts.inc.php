<?php

session_start();

include_once __DIR__.'/../modal/post.class.php';

//Add Post
if(isset($_POST['insert'])){

    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $category = $_POST['c_id'];
    $folder = $_POST['f_id'];
    $tags = htmlentities($_POST['tags']);

    if(empty($title) || empty($content) || empty($category) || empty($folder)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["tags"] = $tags;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: ../view/addPost.php");
        exit;

    }
    else{
        $insert = new Post();
    
        //Getting the total number of Post so that we can define the position for new Post
        //Here we will take the total Post + 1 as $position
        $totalPost = $insert->ReadAllPostReverse($folder);
        $position = $totalPost->num_rows + 1;
    
        //Insert Category Operation
        $result = $insert->InsertPost($title, $content, $tags, $category, $folder, $position);

        if($result == 0){
            $_SESSION["title"] = $title;
            $_SESSION["content"] = $content;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ../view/addPost.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Post Created Successfully!!!";
            $_SESSION["class"] = "success";
    
            header("Location: ../view/postList.php?f_id=$folder");
            exit;
        }

    }
}

//New Draft Section
elseif(isset($_POST['draft'])){

    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $category = $_POST['c_id'];
    $folder = $_POST['f_id'];
    $tags = htmlentities($_POST['tags']);
    $draft = 1;

    if(empty($title) || empty($content) || empty($category) || empty($folder)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: ../view/addPost.php");
        exit;

    }
    else{
        $insert = new Post();
    
        //Getting the total number of Post so that we can define the position for new Post
        //Here we will take the total Post + 1 as $position
        $totalPost = $insert->ReadAllPostReverse($folder);
        $position = $totalPost->num_rows + 1;
        echo $folder;
        echo "<br>".$position;
        //Insert Post Operation
        $result = $insert->InsertPost($title, $content, $tags, $category, $folder, $draft, $position);

        if($result == 0){
            $_SESSION["title"] = $title;
            $_SESSION["content"] = $content;
            $_SESSION["tags"] = $tags;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ../view/addPost.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Draft Saved Successfully!!!";
            $_SESSION["class"] = "success";
    
            header("Location: ../view/postList.php?f_id=$folder");
            exit;
        }

    }
}

//Update Post Section
elseif(isset($_POST['update'])){
    $id = htmlentities($_POST['id']);
    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $category = $_POST['c_id'];
    $folder = $_POST['f_id'];

    if(empty($title) || empty($content) || empty($category) || empty($folder)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }
    else{

        $update = new Post();
    
        $result = $update->UpdatePost($id, $title, $content, $tags, 0, $category, $folder);

        
        if($result == 0){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/updatePost.php?post_id=$id&f_id=$folder");
            exit;
        }
        else{
            $_SESSION['msg'] = "Article Updated Successfully";
            $_SESSION['class'] = "success";
            header("Location: ../view/PostDetail.php?post_id=$id&f_id=$folder");
            exit;
        }
    }

}

//Update Draft Section
elseif(isset($_POST['updatedraft'])){

    $id = htmlentities($_POST['id']);
    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $category = $_POST['c_id'];
    $folder = $_POST['f_id'];

    if(empty($title) || empty($content) || empty($category) || empty($folder)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }
    else{

        $update = new Post();
    
        $result = $update->UpdatePostDraft($id, $title, $content, $tags, 0, $category, $folder);

        if($result == 0){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/updatePost.php?post_id=$id&f_id=$folder");
            exit;
        }
        else{
            $_SESSION['msg'] = "Draft Saved Successfully";
            $_SESSION['class'] = "success";
            header("Location: ../view/PostDetail.php?post_id=$id&f_id=$folder");
            exit;
        }
    }

}


//Delete Section
elseif(isset($_POST['deletepost'])){

    $id = $_POST['post_id'];
    $f_id = $_POST['f_id'];
    
    $delete = new Post();

    $result = $delete->DeletePost($id);

    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Post Deleted Successfully!!!";
        $_SESSION["class"] = "success";

        header("Location: ../view/postlist.php?f_id=$f_id");
        exit;
    }

}

else{
    header("Location: ../");
    exit;
}