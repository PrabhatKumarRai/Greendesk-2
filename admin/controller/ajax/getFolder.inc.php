<?php
session_start();

include_once '../../modal/folder.class.php';
include_once '../../modal/post.class.php';

if(!isset($_POST['c_id']) || empty($_POST['c_id'])){
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}

$c_id = htmlentities($_POST['c_id']);
$post_id = htmlentities($_POST['p_id']);

$folder = new Folder();
$post = new Post();

$result = $folder->getAllfolder($c_id);
if($post_id !== ''){
    $result2 = $post->ReadSinglePost($post_id);
    $row2 = $result2->fetch_assoc();
        
    if($result != '' && $result != '0'){
        while($row = $result->fetch_assoc()){
    ?>
            <option value="<?= $row['f_id']; ?>" <?= ($row2['f_id'] == $row['f_id'])? "selected": ''; ?>><?= $row['name']; ?></option>
    <?php
        }
    }
}
else{
    if($result != '' && $result != '0'){
        while($row = $result->fetch_assoc()){
    ?>
            <option value="<?= $row['f_id']; ?>"><?= $row['name']; ?></option>
    <?php
        }
    }
}