<?php 
session_start();

include_once __DIR__.'/../../modal/post.class.php';

if(isset($_POST['update'])){
    $updatePostion = new Post();

    foreach($_POST['positions'] as $position){
        //Here the c_id is in the index [0] of $position array and the element position is in index [1] of the array $position
        $id = $position[0];
        $newPosition = $position[1];

        $result = $updatePostion->updatePostPosition($newPosition, $id);
        if($result != 1){
            $_SESSION['message'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit('SQL Error!!!');
        }
    }
    exit('success');
}