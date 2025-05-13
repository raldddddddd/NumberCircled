<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numbercircld | Movie Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../script/script.js"></script>
    <script src="movie_review_script.js"></script>
    <link rel="stylesheet" href="movie_review_style.css" />


</head>
<?php session_start();?>
<body>
    <!-- Navbar -->
    <nav class="navbar custom-navbar px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <!-- Left: Logo + Brand -->
            <div class="d-flex align-items-center">
                <img src="/NumberCircled/assets/logo-white-text.png" alt="Logo" width="40" height="40" class="me-2" />
                <span class="navbar-brand mb-0 h5 text-white fw-bold">Numbercircld</span>
            </div>

            <!-- Center: Search bar -->
            <form class="flex-grow-1 mx-4" style="max-width: 500px;">
                <div class="input-group">
                    <input type="text" class="form-control rounded-start-pill" placeholder="What do you want to watch?" />
                    <span class="input-group-text bg-white rounded-end-pill">
                        <i class="fas fa-search text-dark"></i>
                    </span>
                </div>
            </form>

            <!-- Right: Logout + Menu icon -->
            <div class="d-flex align-items-center">
                <a class="genre-pill" href="../login.php" id="go-back">Logout</a>
                <label for="profile-btn">
        <img src="/NumberCircled/assets/def-profile.png" alt="Logo" width="40" height="40" class="me-2" />
        </label>
        <button id="profile-btn" name="profile-btn"  hidden>
            </div>
        </div>
    </nav>


    <!-- Hero Section - Background image -->
    <div class="hero-section"></div>

    <!-- Main Content that overlaps with hero -->
    <input type="hidden" name="movie_id" id="movie_id" value=<?php echo $_SESSION['movie_id'];?>>
    <input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['user_id'];?>>
    <input type="hidden" name="existing_review" id="existing_review" value=<?php echo $_SESSION['existing_review'];?>>
    <div class="container content-wrapper">
        <div class="row">
            <!-- Left Column - Movie Poster -->
            <div class="col-md-5">
                <div class="movie-card">
                    <div class="img-fluid w-100 movie-card-poster" name="image_url"></div>
                    <div class="title-overlay">
                        <h2 class="mb-1" name="name">Spider-man: Into the Spider Verse</h2>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger rounded-1 me-2 d-flex align-items-center px-3">
                                <i class="fas fa-play me-2"></i> Play Now
                            </button>
                            <button class="btn btn-dark rounded-circle me-2" style="width: 38px; height: 38px;">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                            <button class="btn btn-dark rounded-circle me-2" style="width: 38px; height: 38px;">
                                <i class="fas fa-thumbs-up text-white"></i>
                            </button>
                            <button class="btn btn-dark rounded-circle" style="width: 38px; height: 38px;">
                                <i class="fas fa-volume-mute text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Movie Details -->
            <div class="col-md-7">
                <!-- Description Card -->
                <div class="info-card mb-3">
                    <h6 class="section-title">Description</h6>
                    <p class="section-content mb-0" name="description">
                        After reuniting with Gwen Stacy, Brooklyn's full-time, friendly
                        neighborhood Spider-Man is catapulted across the Multiverse,
                        where he encounters a team of Spider-People charged with
                        protecting its very existence. However, when the heroes clash on
                        how to handle a new threat, Miles finds himself pitted against the
                        other Spiders. He must soon redefine what it means to be a hero
                        so he can save the people he loves most.
                    </p>
                </div>

                <!-- Additional Info Card -->
                <div class="info-card">
                    <!-- Released Year Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-calendar-alt text-secondary me-2"></i>
                            <h6 class="section-title m-0">Released Year</h6>
                        </div>
                        <p class="section-content mb-0" name="release_date">2022</p>
                    </div>

                    <!-- Ratings Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="far fa-star text-secondary me-2"></i>
                            <h6 class="section-title m-0">Ratings</h6>
                        </div>
                        <div class="d-flex">
                            <p class="section-content mb-0"><i class="fas fa-thumbs-up me-2"></i><span name="sentiment_category"></span></p>
                        </div>
                    </div>

                    <!-- Genres Section -->
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-film text-secondary me-2"></i>
                            <h6 class="section-title m-0">Genres</h6>
                        </div>
                        <div class="genre-list">
                            <!-- genres <span class="genre-pill">Action</span> -->
                            
                        </div>
                    </div>
                    
                </div>
                <a class="genre-pill" href="../main_page/main_page.html" id="go-back">Back to Main Page</a>
            </div>
        </div>
    </div>


    <!-- User Reviews Section -->
    <div class="review-section-wrapper mx-auto py-5 px-3">
        <div class="container">
            <div class="container my-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-muted-custom">Reviews</h5>
                    <button class="btn btn-outline-light" id="addReviewBtn">
                        <i class="fas fa-plus me-2"></i><span id="reviewBtn">Add Your Review</span>
                    </button>
                </div>
                <div class="row g-4 review-loader">
                    <!-- Review Card (Example) -->
            </div>
        </div>
    </div>

    <!--Review Modal-->
    <div class="modal" id="reviewModal">
        <div class="modal-header">
            <h2>I watched…</h2>
            <span class="close" id="modalCloseBtn">&times;</span>
        </div>

        <div class="modal-body">
            <div class="modal-poster"></div>
            <div class="details">
                <h3><span class='modal-title'>Spider-Man: Into the Spider Verse</span> <span class="year modal-year">2022</span></h3>
                <form id="reviewForm">
                    <textarea placeholder="Add a review..." id="textReview" rows="8"></textarea>

                    <div class="rating-select" onmouseover="mouseOver()" onmouseleave="mouseLeave()">
                        <span>Rating:</span>
                        <div class="stars">
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-footer">
            <button class="save-button" id="saveReviewBtn">Save</button>
            <button class="save-button" id="deleteReviewBtn" hidden>Delete</button>
        </div>
    </div>

</body>
<footer class="custom-footer text-center py-4 mt-5">
    <div class="container">
        <!-- Social Icons -->
        <div class="mb-3">
            <a href="#" class="text-white mx-2"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
            <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#" class="text-white mx-2"><i class="fab fa-youtube fa-lg"></i></a>
        </div>


        <!-- Copyright -->
        <small class="text-muted-custom">© 2025 Numbercircld by JRP Group</small>
    </div>
</footer>

<script>
    let star = null;

    $('input[name="rating"]').on('change', function() {
        star = $(this).val();
    }); 

    function mouseOver() {
        $('input[name="rating"]').prop('checked', false);
    }

    function mouseLeave() {
        if (star !== null) {
            $('input[name="rating"][value="' + star + '"]').prop('checked', true);
        }
    }
</script>

</html>