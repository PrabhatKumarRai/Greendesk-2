                <!-- Add Category Modal -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?='../controller/category.inc.php'?>" method="POST" id="addCategoryForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" name="category" value="<?= (isset($_SESSION['category']))? $_SESSION['category']: ''; ?>">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="visibility" name="visibility" checked>
                                        <label class="form-check-label" for="visibility">Visible on Website</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="addCategory" name="addcategory">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Folder Modal -->
                <div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog" aria-labelledby="addFolderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFolderModalLabel">Add Folder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= '../controller/folder.inc.php'; ?>" method="POST" id="addFolderForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="c_id" class="form-control">
                                            <?php 
                                                include_once __DIR__."/../modal/category.class.php";
                                                $category = new Category();
                                                $result = $category->getAllCategory();
                                                if($result->num_rows > 0){
                                                    while($row = $result->fetch_assoc()){
                                            ?>
                                            <option value="<?= $row['c_id']; ?>"><?= $row['name']; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Folder Name</label>
                                        <input type="text" class="form-control" name="folder" value="<?= (isset($_SESSION['category']))? $_SESSION['category']: ''; ?>">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="foldervisibility" name="visibility" checked>
                                        <label class="form-check-label" for="foldervisibility">Visible on Website</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="addFolder" name="addFolder">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>          	
            <div class="py-2 text-center text-white">
                <span>Developed by Prabhat Kumar Rai</span>
            </div>
        </footer>

    </body>
</html>

<!-- Unsetting All Session Veriables except u_id -->
<?php
    foreach($_SESSION as $key => $val){

        if ($key != 'u_id' && $key != 'last_action')
        {
            unset($_SESSION[$key]);
        }

    }
?>