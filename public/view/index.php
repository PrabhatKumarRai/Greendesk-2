<?php 
    include_once __DIR__.'/../modal/category.class.php';
    include_once __DIR__.'/../modal/folder.class.php';
    include_once __DIR__.'/../modal/post.class.php';

    include_once '../includes/header.php';
    include_once 'alert.php';

?>


<div class="index-container">
    <div class="index-inner">
        <h4 class="solution-head">Knowledge Base</h4>
        <?php
            $category = new Category();        
            $result1 = $category->getAllCategory();

            if($result1 != '' && $result1 != '0'){
                while($row1 = $result1->fetch_assoc()){
                    if($row1['visibility'] != 0){

        ?>              
                        <div class="solution-container">
                            <!-- Category Name -->
                            <div class="solution-category">
                                <h5>
                                    <a href="category.php?category=<?= $row1['name']; ?>">
                                        <?= $row1['name']; ?>
                                    </a>
                                </h5>
                            </div>

                            <div class="d-flex justify-content-between flex-wrap">                                
                            <?php 
                                $folder = new Folder();
                                $post = new Post();
                                
                                
                                $result2 = $folder->getAllfolder($row1['c_id']);

                                if($result2 != '' && $result2 != '0'){
                                    while($row2 = $result2->fetch_assoc()){
                                        if($row2['visibility'] != 0){

                                            //Getting Folder Wise Post Count
                                            $result3 = $post->ReadAllPost($row2['f_id']);
                                            if($result3 != '' && $result3 != '0'){

                            ?>
                                                <div class="solution-folder-container">

                                                    <!-- Folder Name -->
                                                    <div class="solution-folder">
                                                        <h6>                                                            
                                                            <a href="folder.php?category=<?= $row1['name']; ?>&folder=<?= $row2['name']; ?>" class="limit-1">
                                                                <?= $row2['name']; ?> <span class="text-secondary font-weight-400 font-14">(<?= $result3->num_rows; ?>)</span>                                                                
                                                            </a>
                                                        </h6>
                                                    </div>
                                                    
                                                    <?php 
                                                        if($result3->num_rows > 5){
                                                            $limit = 5;
                                                            while(($row4 = $result3->fetch_assoc()) && ($limit > 0)){
                                                    ?>
                                                                    <div class="solution-post d-flex">
                                                                        <div class="solution-post-icon">
                                                                            <i class="fa fa-book" aria-hidden="true"></i>
                                                                        </div>
                                                                        <div class="solution-post-link limit-1">
                                                                            <a href="postDetail.php?category=<?= $row1['name']; ?>&folder=<?= $row2['name']; ?>&post=<?= $row4['title']; ?>">
                                                                                <?= $row4['title']; ?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                    <?php
                                                                $limit--;
                                                            }
                                                    ?>
                                                    <div class="solution-all-articles-link">
                                                        <a href="folder.php?category=<?= $row1['name']; ?>&folder=<?= $row2['name']; ?>">See all <?= $result3->num_rows; ?> articles</a>
                                                    </div>
                                                    <?php
                                                         }
                                                         else{
                                                            while($row4 = $result3->fetch_assoc()){ 
                                                    ?>
                                                            <!-- Post Name -->
                                                            <div class="solution-post d-flex">
                                                                <div class="solution-post-icon">
                                                                    <i class="fa fa-book" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="solution-post-link limit-1">
                                                                    <a href="postDetail.php?category=<?= $row1['name']; ?>&folder=<?= $row2['name']; ?>&post=<?= $row4['title']; ?>">
                                                                        <?= $row4['title']; ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    <?php
                                                            }
                                                         }
                                                    ?>
                                                    
                                                </div>
                            <?php 
                                                                      
                                            }
                                        }
                                    }
                                }
                            ?>
                            
                            </div>
                        </div>
        <?php
                    }
                }
            }
         ?>
    </div>
</div>


<?php include_once '../includes/footer.php'; ?>