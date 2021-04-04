<?php 
    if(!isset($_GET['f_id'])){
        header("Location: categorylist.php");
        exit;
    }

    include_once __DIR__.'/../includes/header.php';
    include_once '../modal/post.class.php';
?>
<div>
    <?php 
    
        $folder = new Post();
        $result = $folder->ReadAllPostReverse($_GET['f_id']);

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
    ?>
        <div id="sortable" class="post-list" data-action="../controller/ajax/sortablePost.inc.php">
    <?php
            while($row = $result->fetch_assoc()){
    ?>
                <div class="post-list-item jumbotron d-flex p-2 mb-3 rounded-0" data-index="<?= $row['post_id']; ?>" data-position="<?= $row['position']; ?>">
                    <div class="post-list-item-icon">
                        <img src="../../uploads/app/list-icon.png" alt="list icon">
                    </div>
                    <div>
                        <a href="postdetail.php?post_id=<?= $row['post_id']; ?>&f_id=<?= $_GET['f_id']; ?>" class="post-list-item-head">
                            <h3><?= $row['title']; ?></h3>
                        </a>

                        <!-- Post Updated Section -->
                        <?php if($row['last_updated'] != ''){ ?>    <!-- if the post creation date and the post updated dates are not the same then display the Last Updated Section -->
                            <div class="font-12 font-weight-500">
                                Last Updated : <span class="text-dark underline"><?= date('d M, Y h:i:s a', strtotime($row['last_updated'])); ?></span>

                                &nbsp;&nbsp;

                                <!-- Total Views Starts -->
                                Total Views : <span class="text-dark"><?= $row['views']; ?></span>
                                <!-- Total Views Ends-->

                                &nbsp;

                                <!-- Draft Symbol Starts -->
                                <?= ($row['draft'] != 0)? "&nbsp;<span class='text-success font-weight-500'>(Draft)</span>": ""; ?>
                                <!-- Draft Symbol Ends-->
                            </div>
                        <?php } ?>

                        <!-- Options Section Starts -->
                        <div class="post-menu btn-group dropleft">
                            <a href="#" class="post-menu-toggler" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                            <a href="updatePost.php?post_id=<?= $row['post_id']; ?>" class="dropdown-item">Update</a>
                            <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#deletepost<?= $row['post_id']; ?>">Delete</a>
                            </div>
                        </div>
                        <!-- Options Section Ends -->
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