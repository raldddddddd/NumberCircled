<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark text-white position-fixed start-0 vh-100 overflow-auto p-0">

    <ul class="nav flex-column ">
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="reviews.php"><i class="fas fa-star"></i> User Reviews</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="false" aria-controls="userMenu">
                <i class="fas fa-clapperboard"></i> Manage Movies <i class="fas toggle-icon fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse" id="userMenu">
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="movies.php"><i class="fas fa-film"></i> Movie List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="genres.php"><i class="fas fa-book-open"></i> Genres</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="users.php"><i class="fas fa-user-cog"></i> Users & Admins</a>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="sentiment-chart.html"><i class="fas fa-chart-pie"></i> Sentiment Distribution</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="export-data.html"><i class="fas fa-file-csv"></i> Export Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="report.html"><i class="fas fa-chart-line"></i> Trend Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex px-2 py-2 align-items-center rounded text-white mx-2" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </li>
    </ul>
</nav>