<?php 
    if(!isset($_GET['c_id'])){
        header("Location: categorylist.php");
        exit;
    }

    include_once __DIR__.'/../includes/header.php';
    include_once __DIR__."/../modal/category.class.php";
    include_once '../modal/folder.class.php';
    include_once '../modal/post.class.php';
?>
<div>
    <?php 
    
        $post = new Post();

        $folder = new Folder();
        $result = $folder->getAllfolder($_GET['c_id']);

        if($result==''){
        ?>
            <div class="border px-4 py-4 text-center">
                <h3>No Folders Exists !!!</h3>            
                <a class="btn btn-primary px-4" href="#" data-toggle="modal" data-target="#addFolderModal">Add New</a>
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
        <div id="sortable" class="post-list" data-action="../controller/ajax/sortableFolder.inc.php">
    <?php

            while($row = $result->fetch_assoc()){
    ?>
                <div class="post-list-item jumbotron d-flex p-2 mb-3 rounded-0" data-index="<?= $row['f_id']; ?>" data-position="<?= $row['position']; ?>">
                    <div class="post-list-item-icon">
                        <img src="../../uploads/app/list-icon.png" alt="list icon">
                    </div>
                    <div>
                        <a href="postlist.php?f_id=<?= $row['f_id']; ?>" class="post-list-item-head">
                            <h3><?= $row['name']; ?></h3>
                        </a>
                        <!-- Articles details Starts -->
                        <div class="font-12 font-weight-500">
                            <?php 

                                $result1 = $post->ReadAllPostReverse($row['f_id']);
                                if($result1 != '' && $result1 != '0'){
                                    $row1 = $result1->num_rows;
                            ?>
                                    <?= $row1; ?> Article
                            <?php 
                                }else{
                            ?>
                                    0 Article
                            <?php
                                }
                            ?> 
                                
                            <!-- Draft Symbol Starts -->
                            <?= ($row['visibility'] != 1)? "&nbsp;<span class='text-success font-weight-500'>(Draft)</span>": ""; ?>
                            <!-- Draft Symbol Ends-->

                        </div>
                        <!-- Articles details Ends -->
                                            

                        <!-- Options Section Starts -->
                        <div class="post-menu btn-group dropleft">
                            <a href="#" class="post-menu-toggler" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editfolder<?= $row['f_id']; ?>">Update</a>
                            <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#deletefolder<?= $row['f_id']; ?>">Delete</a>
                            </div>
                        </div>
                        <!-- Options Section Ends -->
                    </div>
                    <!-- Edit Folder Modal -->
                    <div class="modal fade" id="editfolder<?= $row['f_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editfolderLabel<?= $row['f_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editfolderLabel<?= $row['f_id']; ?>">Edit Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/folder.inc.php" method="POST">
                                    <div class="modal-body">
                                        <div>
                                            <!-- Folder Name -->
                                            <div class="form-group">
                                                <label>Folder Name</label>
                                                <input type="text" class="form-control" name="folder" value="<?= $row['name']; ?>">
                                            </div>
                                            <!-- Category Name -->
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="c_id" class="form-control">
                                                    <?php 
                                                        $category = new Category();
                                                        $resultCategory = $category->getAllCategory();
                                                        if($resultCategory->num_rows > 0){
                                                            while($rowCategory = $resultCategory->fetch_assoc()){
                                                    ?>
                                                    <option value="<?= $rowCategory['c_id']; ?>" <?= ($row['c_id'] == $rowCategory['c_id'])? "Selected": ""; ?>><?= $rowCategory['name']; ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Visibility -->
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="foldervisibility1" name="visibility" <?= ($row['visibility'] == 1)? "checked": "" ?> >
                                                <label class="form-check-label" for="foldervisibility1">Visible on Website</label>
                                            </div>
                                            <input type="hidden" name="f_id" value="<?= $row['f_id']; ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="updatefolder">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Folder Modal -->
                    <div class="modal fade" id="deletefolder<?= $row['f_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deletefolderLabel<?= $row['f_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletefolderLabel<?= $row['f_id']; ?>">Delete folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div>
                                            <h5>Are you sure to delete the folder?</h5>
                                            <p class="text-danger">Note: All Posts in this folder will also be deleted</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="../controller/folder.inc.php" method="POST">                                        
                                            <input type="hidden" name="f_id" value="<?= $row['f_id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="deletefolder">Delete</button>
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