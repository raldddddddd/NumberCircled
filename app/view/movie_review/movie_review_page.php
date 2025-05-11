<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numbercircld | Movie Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="movie_review_script.js"></script>
    <link rel="stylesheet" href="movie_review_style.css" />


</head>

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
                <span class="text-white me-3">Log out</span>
                <button class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>


    <!-- Hero Section - Background image -->
    <div class="hero-section"></div>

    <!-- Main Content that overlaps with hero -->
    <div class="container content-wrapper">
        <div class="row">
            <!-- Left Column - Movie Poster -->
            <div class="col-md-5">
                <div class="movie-card">
                    <div class="img-fluid w-100 movie-card-poster"></div>
                    <div class="title-overlay">
                        <h2 class="mb-1">Spider-man: Into the Spider Verse</h2>
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
                    <p class="section-content mb-0">
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
                        <p class="section-content mb-0">2022</p>
                    </div>

                    <!-- Ratings Section -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="far fa-star text-secondary me-2"></i>
                            <h6 class="section-title m-0">Ratings</h6>
                        </div>
                        <div class="d-flex">
                            <p class="section-content mb-0"><i class="fas fa-thumbs-up me-2"></i>Mostly Positive</p>
                        </div>
                    </div>

                    <!-- Genres Section -->
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-film text-secondary me-2"></i>
                            <h6 class="section-title m-0">Genres</h6>
                        </div>
                        <div>
                            <span class="genre-pill">Action</span>
                            <span class="genre-pill">Adventure</span>
                        </div>
                    </div>
                </div>
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
                        <i class="fas fa-plus me-2"></i>Add Your Review
                    </button>
                </div>

                <div class="row g-4">
                    <!-- Review Card (Example) -->
                    <div class="col-md-6">
                        <div class="review-box p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>Aniket Roy</strong>
                                    <div class="text-muted-custom">From India</div>
                                </div>
                                <div class="rating-stars d-flex align-items-center">
                                    <span class="text-warning me-2">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="badge bg-dark-subtle text-white">4.5</span>
                                </div>
                            </div>
                            <p class="mb-0">
                                This movie was recommended to me by a very dear friend who went for the movie by herself. I went to the cinemas to watch but had a housefull board so couldn't watch it.
                            </p>
                        </div>
                    </div>

                    <!-- Repeat the above .col-md-6 block for each review -->
                    <!-- Example Sworaj Review -->
                    <div class="col-md-6">
                        <div class="review-box p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>Swaraj</strong>
                                    <div class="text-muted-custom">From India</div>
                                </div>
                                <div class="rating-stars d-flex align-items-center">
                                    <span class="text-warning me-2">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </span>
                                    <span class="badge bg-dark-subtle text-white">5</span>
                                </div>
                            </div>
                            <p class="mb-0">
                                A restless king promises his lands to the local tribals in exchange of a stone (Panjurli, a deity of Keraldi Village) wherein he finds solace and peace of mind.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                    <button class="btn btn-dark rounded-circle">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-dark rounded-circle">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
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
                <h3>Spider-Man: Into the Spider Verse <span class="year">2022</span></h3>
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