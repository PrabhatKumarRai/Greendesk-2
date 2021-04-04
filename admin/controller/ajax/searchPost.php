<?php

session_start();

include_once '../../modal/post.class.php';

$output = '';

if(isset($_POST["query"])){
    $search = htmlentities($_POST['query']);

    $searchPost = new Post();
    $result = $searchPost->SearchPost($search);

    if($result == '' || $result == '0'){
        echo "No Results Found!!!";
    }
    else{
        

?>
    <div class="px-3">
        <?php while($row = $result->fetch_assoc()){ ?>
            <div class="py-2">
                <a href="postdetail.php?post_id=<?= $row['post_id']; ?>" class="limit-1">
                    <?= $row['title']; ?>
                </a>
            </div>
            <hr class="my-0">
        <?php } ?>
    </div>
<?php
    }
}