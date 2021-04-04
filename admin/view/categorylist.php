<?php
    include_once __DIR__.'/../includes/header.php';
    include_once '../modal/category.class.php';
    include_once '../modal/folder.class.php';
    include_once '../modal/post.class.php';
?>

<div>
    <?php 
    
        $category = new Category();
        $result = $category->getAllCategory();
        
        if($result==''){
    ?>
        <div class="border px-4 py-4 text-center">
            <h3>No Categories Exists !!!</h3>            
            <a class="btn btn-primary px-4" href="#" data-toggle="modal" data-target="#addCategoryModal">Add New</a>
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
        <div id="sortable" class="post-list" data-action="../controller/ajax/sortableCategory.inc.php">
    <?php
            while($row = $result->fetch_assoc()){
    ?>
                <div class="post-list-item jumbotron d-flex p-2 mb-3 rounded-0" data-index="<?= $row['c_id']; ?>" data-position="<?= $row['position']; ?>">
                    <div class="post-list-item-icon">
                        <img src="../../uploads/app/list-icon.png" alt="list icon">
                    </div>
                    <div>
                        <a href="folderlist.php?c_id=<?= $row['c_id']; ?>" class="post-list-item-head">
                            <h3><?= $row['name']; ?></h3>
                        </a>

                        <!-- Section and Articles details Starts -->
                        <div class="font-12 font-weight-500">
                            <?php 
                                $folder = new Folder();
                                $post = new Post();

                                $result1 = $folder->getAllfolder($row['c_id']);
                                $result2 = $post->ReadAllPostByCategory($row['c_id']);

                                ($result1 != '' && $result1 != '0')? $row1 = $result1->num_rows: $row1 = 0;
                                ($result2 != '' && $result2 != '0')? $row2 = $result2->num_rows: $row2 = 0;
                            ?>
                                <?= $row1; ?> Folder &nbsp; - &nbsp; <?= $row2; ?> Article 
                                
                                <!-- Draft Symbol Starts -->
                                <?= ($row['visibility'] != 1)? "&nbsp;<span class='text-success font-weight-500'>(Draft)</span>": ""; ?>
                                <!-- Draft Symbol Ends-->
                        </div>
                        <!-- Section and Articles details Ends -->

                        <!-- Options Section Starts -->
                        <div class="post-menu btn-group dropleft">
                            <a href="#" class="post-menu-toggler" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editcategory<?= $row['c_id']; ?>">Update</a>
                            <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#deletecategory<?= $row['c_id']; ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                    <!-- Options Section Ends -->

                    

                    <div class="card-action d-flex justify-content-between">
                    </div>
                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editcategory<?= $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editcategoryLabel<?= $row['c_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editcategoryLabel<?= $row['c_id']; ?>">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/category.inc.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                        <!-- Category Name -->
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" name="category" value="<?= $row['name']; ?>">
                                        </div>
                                        <!-- Visibility -->
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="visibility" name="visibility" <?= ($row['visibility'] == 1)? "checked": "" ?> >
                                            <label class="form-check-label" for="visibility">Visible on Website</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="updatecategory">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Category Modal -->
                    <div class="modal fade" id="deletecategory<?= $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deletecategoryLabel<?= $row['c_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletecategoryLabel<?= $row['c_id']; ?>">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div>
                                            <h5>Are you sure to delete the Category?</h5>
                                            <p class="text-danger">Note: All folders and Posts in this category will also be deleted</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="../controller/category.inc.php" method="POST">                                        
                                            <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="deletecategory">Delete</button>
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