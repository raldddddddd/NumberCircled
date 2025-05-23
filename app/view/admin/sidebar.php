<?php
$current_page = basename($_SERVER['PHP_SELF']);
$is_movies_section = in_array($current_page, ['movies.php', 'genres.php']);
?>
<input type="hidden" id="sessionRole" value="<?= $_SESSION['role_id'] ?>">
<input type="hidden" id="sessionUserId" value="<?= $_SESSION['user_id'] ?>">
<input type="hidden" id="currentPage" value="<?= htmlspecialchars($current_page) ?>">
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark text-white position-fixed start-0 vh-100 overflow-auto p-0">

    <ul class="nav flex-column ">
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2 <?= ($current_page == 'dashboard.php') ? 'active-page' : 'text-white' ?>" href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2  <?= ($current_page == 'reviews.php') ? 'active-page' : 'text-white' ?>" href="reviews.php"><i class="fas fa-star"></i> User Reviews</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2"
                data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="<?= $is_movies_section ? 'true' : 'false' ?>" aria-controls="userMenu">
                <i class="fas fa-clapperboard"></i> Manage Movies
                <i class="fas toggle-icon fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse <?= $is_movies_section ? 'show' : '' ?>" id="userMenu">
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2 <?= $current_page == 'movies.php' ? 'active-page' : '' ?>" href="movies.php">
                            <i class="fas fa-film"></i> Movie List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2 <?= $current_page == 'genres.php' ? 'active-page' : '' ?>" href="genres.php">
                            <i class="fas fa-book-open"></i> Genres
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2 <?= $current_page == 'users.php' ? 'active-page' : '' ?>" href="users.php"><i class="fas fa-user-cog"></i> Users & Admins</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="/NumberCircled/app/controller/export.php"><i class="fas fa-file-csv"></i> Export Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="#" id="editSemanticsBtn">
                <i class="fas fa-pen"></i> Edit Semantics
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="/NumberCircled/app/controller/logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </li>
    </ul>
</nav>

<?php include("modalsemantics.php"); ?>