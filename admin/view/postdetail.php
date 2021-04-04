<?php 
    if(!isset($_GET['post_id']) && !isset($_GET['f_id'])){
        header("Location: categorylist.php");
        exit;
    }

    include_once __DIR__.'/../includes/header.php';
    include_once '../modal/post.class.php';
?>
<div>
    <?php 
    
        $folder = new Post();
        $result = $folder->ReadSinglePost($_GET['post_id']);

        if($result==''){
        ?>
            <div class="border px-4 py-4 text-center">
                <h3>No Post Exists !!!</h3>            
                <a class="btn btn-primary px-4" href="addPost.php">Add New</a>
            </div>
        <?php
        }
        elseif($result=='0'){
    ?>
        <div class="border px-4 py-4 text-center">
            <h3>SQL Error Occured !!!</h3>
        </div>
    <?php
        }
        else{
            while($row = $result->fetch_assoc()){
    ?>
                <div class="post-container px-4 py-4 mb-3">
                    <div class="post-header">
                        <!-- Post Title -->
                        <div class="post-title">
                                <h2><?= $row['title']; ?></h2>
                            </div>

                            <!-- Post Publish Details -->
                            <div class="post-publish-detail">
                                Published
                                <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['date'])); ?></span>
                            </div>
                            

                            <!-- Post Updated Section -->
                            <?php if(strcmp($row['date'], $row['last_updated']) != 0 && $row['last_updated'] != ''){ ?>    <!-- if the post creation date and the post updated dates are not the same then display the Last Updated Section -->
                                <div class="post-updated post-publish-detail">
                                    Last Updated : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['last_updated'])); ?></span>
                                </div>
                            <?php } ?>

                            
                            <!-- Draft Symbol Section Starts -->
                            <?php 
                                if($row['draft'] == 1){
                            ?>
                            <div class="text-success font-weight-500">
                                    (Draft Post)
                            </div>
                            <?php
                                }
                            ?>
                            <!-- Draft Symbol Section Ends -->
                        </div>
                        <hr>

                        <!-- Post Content Section Starts -->
                        <div class="post-content">
                            <?= $row['content']; ?>
                        </div>
                        <!-- Post Content Section Ends -->

                        <hr>

                        <!-- Post Tags Section Starts -->
                        <div class="post-tags">
                            <h6 class="text-secondary underline">
                                Tags:
                            </h6>
                            <?= $row['tags']; ?>
                        </div>
                        <!-- Post Tags Section Ends -->

                        <hr>

                        <!-- Post Views Section Starts -->
                        <div class="post-tags">
                            <h6 class="text-secondary underline">
                                Views:
                            </h6>
                            <?= $row['views']; ?>
                        </div>
                        <!-- Post Views Section Ends -->

                    <div class="post-actions d-flex justify-content-center flex-wrap">
                        <button onclick="window.print()" class="btn btn-success rounded-0 px-4 mr-3">Print</button>
                        <a href="updatePost.php?post_id=<?= $row['post_id']; ?>" class="btn btn-primary rounded-0 px-4 mr-3">Update</a>
                        <a href="#" class="btn btn-danger rounded-0 px-4" data-toggle="modal" data-target="#deletepost<?= $row['post_id']; ?>">Delete</a>
                    </div>
                    <!-- Delete Post Modal -->
                    <div class="modal fade" id="deletepost<?= $row['post_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deletepostLabel<?= $row['post_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletepostLabel<?= $row['post_id']; ?>">Delete Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div>
                                            <h5>Are you sure to delete this post?</h5>
                                            <p class="text-danger">Note: All the contents and Images in this post will also be deleted</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="../controller/posts.inc.php" method="POST">                                        
                                            <input type="hidden" name="post_id" value="<?= $row['post_id']; ?>">
                                            <input type="hidden" name="f_id" value="<?= $_GET['f_id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="deletepost">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php                
            }
    ?>
        </div>
    <?php
        }
    ?>
</div>

<?php    
    include_once __DIR__.'/../includes/footer.php';
?>