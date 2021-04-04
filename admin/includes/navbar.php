<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="<?= ROOT_URL_ADMIN; ?>view/">Greendesk</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- Posts Starts -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Articles
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="categorylist.php">List</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="dashboardDetail.php?data=draft">Draft</a>
        </div>
      </li>
      <!-- Posts Ends -->
      <!-- Add Starts -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= ROOT_URL_ADMIN; ?>view/addpost.php">Article</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addFolderModal">Folder</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addCategoryModal">Category</a>
        </div>
      </li>
      <!-- Add Ends -->
      <!-- Enquiry Starts -->
      <li class="nav-item">
        <a class="nav-link" href="enquiry.php">Enquiry</a>
      </li>
      <!-- Account Starts -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= ROOT_URL_ADMIN; ?>view/settings.php">Settings</a>
            <div class="dropdown-divider"></div>
            <!-- Logout Section -->
            <form action="../controller/login.inc.php" method="POST">
                <button class="dropdown-item text-danger" name="logout">Logout</button>
            </form>
        </div>
      </li>
      <!-- Account Ends -->
      <li class="nav-item">
        <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>view/" target="_blank">Visit Website</a>
      </li>
    </ul>

    <!-- Search Section -->
    <form action="searchPost.php" method="GET" class="form-inline my-2 my-lg-0 position-relative">
      <input class="form-control mr-sm-2" type="text" name="search_text" id="search_text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 d-none" type="submit">Search</button>
      <div id="result" class="search-suggestions"></div>
    </form>
  </div>
</nav>