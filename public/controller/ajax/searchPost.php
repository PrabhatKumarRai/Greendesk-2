<?php

include_once '../../modal/post.class.php';
include_once '../../modal/category.class.php';
include_once '../../modal/folder.class.php';


if(isset($_POST["query"])){
    $search = htmlentities($_POST['query']);

    $searchPost = new Post();
    $result = $searchPost->SearchPost($search);

    if($result == '' || $result == '0'){
        echo "<div class='p-2'>No Results Found!!!</div>";
    }
    else{

        $category = new Category();
        $folder = new Folder();
?>
    <div class="px-3">
        <?php
            while($row = $result->fetch_assoc()){
                $categoryName = $category->getSingleCategoryByID($row['c_id']);
                $folderName = $folder->getSignlefolderByID($row['f_id']);

                if($categoryName != '' && $categoryName != '0' && $folderName != '' && $folderName != '0'){
                $row2 = $categoryName->fetch_assoc();
                $row3 = $folderName->fetch_assoc();
        ?>
            <div class="py-2">
                <!-- Post Title -->
                <a href="postDetail.php?category=<?= $row2['name']; ?>&folder=<?= $row3['name']; ?>&post=<?= $row['title']; ?>" class="limit-1">
                    <?= $row['title']; ?>
                </a>
                <div class="search-section-details text-secondary limit-1">
                    <!-- Category Name -->
                    <a href="category.php?category=<?= $row2['name']; ?>" class="text-success">
                        <?= $row2['name']; ?>
                    </a>
                    &nbsp; - &nbsp;
                    <!-- Folder Name -->
                    <a href="folder.php?category=<?= $row2['name']; ?>&folder=<?= $row3['name']; ?>" class="text-primary">
                        <?= $row3['name']; ?>
                    </a>
                </div>
            </div>
            <hr class="my-0">
        <?php
                }
                else{
                    echo "<div class='p-2'>No Results Found!!!</div>";
                }
            }
        ?>
    </div>
<?php
    }
}
