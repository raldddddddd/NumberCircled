<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top px-3 z-3">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../../../assets/logo-white-text.png" alt="Logo" width="50" height="50" class="me-2">
    </a>
    <div class="d-flex align-items-center ms-auto text-white">
        <span class="me-2">Logged in as <strong><?php echo $first_name . ' ' . $last_name; ?></strong></span>
        <img src="<?php echo $profile_image; ?>" alt="Profile" class="rounded-circle" width="32" height="32">
    </div>
</nav>