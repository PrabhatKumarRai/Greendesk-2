<?php 

    if(!isset($_GET['folder']) || $_GET['folder']==''){
        header("Location: ../");
        exit;
    }
    
    include_once __DIR__.'/../modal/category.class.php';
    include_once __DIR__.'/../modal/folder.class.php';
    include_once __DIR__.'/../modal/post.class.php';

    include_once '../includes/header.php';
    include_once 'alert.php';
?>


<div class="index-container">
    <div class="index-inner">
        <!-- Page Navigation Starts -->
        <div class="page-navigation-link">
            <a href="../">Solution Home</a>
            &nbsp; / &nbsp;
            <a href="category.php?category=<?= $_GET['category']; ?>"><?= $_GET['category']; ?></a>
            &nbsp; /
        </div>
        <!-- Page Navigation Ends -->
        
        <div>                                
            <?php 
                $folder = new Folder();
                $post = new Post();
                
                
                $result2 = $folder->getSignlefolder($_GET['folder']);

                if($result2 != '' && $result2 != '0'){
                    $row2 = $result2->fetch_assoc();
                        if($row2['visibility'] != 0){

                            //Getting Folder Wise Post Count
                            $result3 = $post->ReadAllPost($row2['f_id']);
                            if($result3 != '' && $result3 != '0'){

            ?>
                                <div>
                                    <!-- Folder Name -->
                                    <div class="page-head">
                                        <h5>                                                            
                                            <a href="folder.php?category=<?= $_GET['category']; ?>&folder=<?= $row2['name']; ?>" class="limit-1">
                                                <?= $row2['name']; ?> <span class="text-secondary font-weight-400 font-14">(<?= $result3->num_rows; ?>)</span>                                                                
                                            </a>
                                        </h5>
                                    </div>
                                    
                                    <?php 
                                        while($row4 = $result3->fetch_assoc()){ 
                                    ?>
                                        <!-- Post Name -->
                                        <div class="solution-post d-flex">
                                            <div class="solution-post-icon">
                                                <i class="fa fa-book" aria-hidden="true"></i>
                                            </div>
                                            <div class="solution-post-link limit-1">
                                                <a href="postDetail.php?category=<?= $_GET['category']; ?>&folder=<?= $row2['name']; ?>&post=<?= $row4['title']; ?>"><?= $row4['title']; ?></a>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    
                                </div>
            <?php 
                                                        
                            }
                        }
                }
            ?>
    </div>
</div>

<?php 
    include_once __DIR__.'/../includes/footer.php';
?>