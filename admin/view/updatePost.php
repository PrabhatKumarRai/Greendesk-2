<?php 
    if(!isset($_GET['post_id']) || $_GET['post_id'] == ''){
        header("Location: categorylist.php");
        exit;
    }
    
    include_once __DIR__.'/../includes/header.php';
    include_once __DIR__."/../modal/category.class.php";
    include_once __DIR__."/../modal/folder.class.php";
    include_once __DIR__."/../modal/post.class.php";

    $post = new Post();
    $result = $post->ReadSinglePost($_GET['post_id']);
    $row = $result->fetch_assoc();
?>


<div>
    <form action="../controller/posts.inc.php" method="POST">
    <!-- Hidden ID field -->
    <input type="hidden" name="id" value="<?= $_GET['post_id']; ?>">

    <!-- Title -->
        <div class="form-group">
            <label for="title">Title<span class="text-danger">*</span> : </label>
            <input type="text" class="form-control" name="title" value="<?php echo (isset($_SESSION['title'])) ? $_SESSION['title'] : $row['title']; ?>" required>
        </div>
        <!-- Description -->
        <div class="mb-4">
            <label for="content">Description<span class="text-danger">*</span> : </label>
            <textarea class="ckeditor" name="content" id="content" required><?php echo (isset($_SESSION['content'])) ? $_SESSION['content'] : $row['content'];; ?></textarea>
        </div>
        <hr>

<script>
    window.onload = function() {
        folderFromCategory(<?= $row['c_id'] ?>, <?= $row['post_id'] ?>);
    };
</script>

        <!-- Article Properties -->
        <h5>Article Properties</h5>
        <div class="d-flex flex-wrap">
            <!-- Category Starts -->
            <div class="form-group flex-grow-1 mr-2">
                <label>Category</label>
                <select name="c_id" class="form-control" onchange="folderFromCategory(this.value, <?= $row['post_id'] ?>)">
                    <option>Select Category</option>
                    <?php 
                        $category = new Category();
                        $result = $category->getAllCategory();
                        if($result->num_rows > 0){
                            while($row1 = $result->fetch_assoc()){
                    ?>
                    <option value="<?= $row1['c_id']; ?>" <?= ($row['c_id'] == $row1['c_id'])? "selected": ""; ?>><?= $row1['name']; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <!-- Category Ends -->
            <!-- Folder Starts -->
            <div class="form-group flex-grow-1 ml-2">
                <label>Folder</label>
                <select class="form-control" name="f_id" id="getFolder">
                    <option>Select Folder</option>
                </select>
            </div>
            <!-- Folder Ends -->
            <!-- Tgas Starts -->
            <div class="d-flex flex-wrap w-100">
                <div class="form-group flex-grow-1 mr-2">
                    <label for="article-tags">Tags <span class="text-danger font-14">(Seperate tags with comma ',')</span></label>
                    <textarea class="form-control" name="tags" id="article-tags"><?php echo (isset($_SESSION['tags'])) ? $_SESSION['tags'] : $row['tags']; ?></textarea>
                </div>
            </div>
            <!-- Tags Ends -->
        </div>        
        

        <button type="submit" name="update" class="btn btn-primary pl-4 pr-4">Update Article</button>
        <button type="submit" name="updatedraft" class="btn btn-info px-3">Save as Draft</button>
    </form>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>