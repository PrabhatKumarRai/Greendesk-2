<?php

    if(!isset($_GET['post']) || $_GET['post']==''){
        header("Location: ../");
        exit;
    }

    include_once __DIR__.'/../modal/category.class.php';
    include_once __DIR__.'/../modal/folder.class.php';
    include_once __DIR__.'/../modal/post.class.php';

    include_once '../includes/header.php';
    include_once 'alert.php';

    $category = new Category();

    $folder = new Folder();
    $result3 = $folder->getSignlefolder($_GET['folder']);
    $row3 = $result3->fetch_assoc();

    $post = new Post();
?>

<div class="post-detail-container d-flex justify-content-between flex-wrap">

    <!-- Post Section -->
    <div class="post-container index-container">
        <!-- Page Navigation Starts -->
        <div class="page-navigation-link">
            <a href="../">Solution Home</a>
            &nbsp; / &nbsp;
            <a href="category.php?category=<?= $_GET['category']; ?>"><?= $_GET['category']; ?></a>
            &nbsp; / &nbsp;
            <a href="folder.php?folder=<?= $_GET['folder']; ?>&category=<?= $_GET['category']; ?>"><?= $_GET['folder']; ?></a>
            &nbsp; /
        </div>
        <!-- Page Navigation Ends -->

        <div class="index-inner">
        <?php
            $result = $post->ReadSinglePost($_GET['post']);
            if($result != '' && $result != '0'){
                $row = $result->fetch_assoc();

                //Updating Post View Count
                if(empty($_SESSION['u_id']) && empty($_SESSION['last_action'])){
                    $view = $post->updateViews($row['post_id']);
                }
        ?>
                <div>
                    <div class="post-head">
                        <h1><?= $row['title']; ?></h1>
                    </div>
                    <div class="post-modified">
                        <span class="text-secondary">Modified on: <?= date('l, d M, Y, h:i A', strtotime($row['last_updated'])); ?></span>
                        <span class="post-actions">
                            <a href="#" onclick="window.print()">(Print)</a>
                          <?php if(isset($_SESSION['u_id'])){?>
                            <a href="<?= ROOT_URL_ADMIN ?>view/updatePost.php?post_id=<?= $row['post_id']; ?>" target="_blank">(Edit)</a>
                          <?php } ?>
                        </span>
                    </div>
                    <hr>
                    <div class="post-content">
                        <?= $row['content']; ?>
                    </div>
                </div>
        <?php

            }
        ?>
        </div>
    </div>

    <!-- Recent Post and Realted Post Section -->
    <div class="recent-articles-container border">
        <!-- Related Articles Section Starts -->
        <?php
            $result4 = $post->ReadAllPost($row3['f_id']);
            if($result4 != '0' || $result4 != ''){
        ?>
            <div class="mb-4">
                <div class="recent-articles-head">
                    <h4>Related Articles</h4>
                </div>
                <div class="recent-articles-body">
                    <?php
                        while($row4 = $result4->fetch_assoc()){
                    ?>
                        <div>
                            <i class="solution-post-icon fa fa-book mr-0" aria-hidden="true"></i> &nbsp;
                            <a href="postDetail.php?category=<?= $_GET['category']; ?>&folder=<?= $_GET['folder']; ?>&post=<?= $row4['title']; ?>">
                                <?= $row4['title']; ?>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>
        <!-- Related Articles Section Ends -->

        <!-- Recent Articles Section Starts -->
        <?php
            $result5 = $post->ReadLatestPost();
            if($result5 != '0' || $result5 != ''){
        ?>
            <div>
                <div class="recent-articles-head">
                    <h4>Recent Articles</h4>
                </div>
                <div class="recent-articles-body">
                    <?php
                        while($row5 = $result5->fetch_assoc()){
                    ?>
                        <div>
                            <i class="solution-post-icon fa fa-book mr-0" aria-hidden="true"></i> &nbsp;
                            <a href="postDetail.php?category=<?= $_GET['category']; ?>&folder=<?= $_GET['folder']; ?>&post=<?= $row5['title']; ?>">
                                <?= $row5['title']; ?>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>
        <!-- Recent Articles Section Ends -->
    </div>

</div>

<?php
    include_once __DIR__.'/../includes/footer.php';
?>
