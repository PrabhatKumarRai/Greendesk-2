<?php

include_once __DIR__.'/../includes/header.php';

if(!isset($_GET['search_text'])){
    header("Location: index.php");
    exit;
}


include_once __DIR__.'/../modal/post.class.php';
include_once __DIR__.'/../modal/category.class.php';
include_once __DIR__.'/../modal/folder.class.php';

?>


    <?php
        $searchText = htmlentities($_GET['search_text']);

        $search = new Post();
        $category = new Category();
        $folder = new Folder();

        $result = $search->SearchPost($searchText);

        if($result == ''){
    ?>
            <!-- No Records Found -->
            <div class="search-links-container w-100">
                <div class="search-links-inner text-center py-3">
                    <h4>No record matches your Search!!!</h4>
                </div>
            </div>
    <?php
        }
        elseif($result == '0'){
    ?>
            <div class="search-links-container">
                <div class="search-links-inner text-center py-3">
                    <h4>SQL Error Occured!!!</h4>
                </div>
            </div>
    <?php
        }
        else{

            while($row = $result->fetch_assoc()){

              $result2 = $category->getSingleCategoryByID($row['c_id']);
              $result3 = $folder->getSignlefolderByID($row['f_id']);

              if(!empty($result2) && !empty($result3)){
                $row2 = $result2->fetch_assoc();
                $row3 = $result3->fetch_assoc();

    ?>
            <div class="search-links-container">
                <div class="search-links-inner">
                    <!-- Post Title -->
                    <div class="search-links-title limit-1">
                        <a href="postDetail.php?category=<?= $row2['name']; ?>&folder=<?= $row3['name']; ?>&post=<?= $row['title']; ?>"><?= $row['title']; ?></a>
                    </div>
                    <!-- Post Publish Details -->
                    <div class='search-links-publish text-secondary limit-2'>
                        Published on
                        <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['date'])); ?></span>
                        <?php
                            if(strcmp($row['date'], $row['last_updated']) != 0){
                        ?>
                        Last Updated : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['last_updated'])); ?></span>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- Post Contents -->
                    <div class="search-links-content limit-2">
                        <?= $row['content']; ?>
                    </div>
                </div>
            </div>
    <?php
              }
            }
        }
    ?>


<?php include_once __DIR__.'/../includes/footer.php';?>
