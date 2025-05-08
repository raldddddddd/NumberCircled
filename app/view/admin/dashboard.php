<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Movie Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-vh-100 bg-dark overflow-hidden">
    <?php include("nav.php"); ?>
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <?php include("sidebar.php"); ?>

        <div class="row flex-grow-1 pe-3 offset-lg-2 z-3">

            <main class="col-lg-12 px-4 pt-3 bg-white rounded shadow-sm overflow-auto">

                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <h2>Admin Dashboard - Movie Management</h2>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text" id="totalUsers">120</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Reviews</h5>
                                <p class="card-text" id="totalReviews">350</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Average Rating</h5>
                                <p class="card-text" id="averageRating">4.2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Sentiment Analysis</h4>
                    <div class="bg-light rounded p-3 shadow-sm" style="height: 300px;">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 text-center">
                        <h5 class="mb-3">Top Used Positive Words</h5>
                        <div id="positive-words-list" class="d-flex flex-wrap justify-content-center gap-2">
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="mb-3">Top Used Negative Words</h5>
                        <div id="negative-words-list" class="d-flex flex-wrap justify-content-center gap-2">
                        </div>
                    </div>
                </div>


                <!-- Trending Movies Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded shadow-sm">
                            <h3>Trending Movies</h3>
                            <table id="trending-movies" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Movie</th>
                                        <th>Recent Reviews</th>
                                        <th>Rating</th>
                                        <th>Sentiment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamically populated with trending movies data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities Section -->
                <div class="mb-4 mt-5">
                    <div class="bg-light rounded shadow-sm p-3">
                        <h4>Recent Activities</h4>
                        <div class="table-responsive">
                            <table id="recentActivitiesTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="script.js"></script>

    <script>
        // Sample data (replace this with real data from API or database)
        const sentimentData = {
            labels: ['Positive', 'Negative'],
            datasets: [{
                label: 'Sentiment Distribution',
                data: [70, 30], // Example values
                backgroundColor: ['#4CAF50', '#F44336'],
            }]
        };

        // Create Sentiment Analysis chart
        const ctx = document.getElementById('sentimentChart').getContext('2d');
        const sentimentChart = new Chart(ctx, {
            type: 'pie',
            data: sentimentData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Example dynamic population for top used words
        const positiveWords = [{
                word: 'Great',
                frequency: 50
            },
            {
                word: 'Amazing',
                frequency: 45
            },
            {
                word: 'Excellent',
                frequency: 30
            }
        ];

        const negativeWords = [{
                word: 'Boring',
                frequency: 40
            },
            {
                word: 'Terrible',
                frequency: 35
            },
            {
                word: 'Bad',
                frequency: 30
            }
        ];

        // Populate Top Used Positive Words
        positiveWords.forEach(word => {
            $('#positive-words-list').append(`
                <span class="badge rounded-pill bg-success">${word.word} - ${word.frequency} times</span>
            `);
        });

        // Populate Top Used Negative Words
        negativeWords.forEach(word => {
            $('#negative-words-list').append(`
                <span class="badge rounded-pill bg-danger">${word.word} - ${word.frequency} times</span>
            `);
        });

        // Example dynamic population for Trending Movies
        const trendingMovies = [{
                name: 'Action Movie',
                reviews: 25,
                rating: 4.5,
                sentiment: 'positive'
            },
            {
                name: 'Comedy Movie',
                reviews: 18,
                rating: 3.8,
                sentiment: 'negative'
            },
            {
                name: 'Drama Movie',
                reviews: 15,
                rating: 4.2,
                sentiment: 'positive'
            }
        ];

        // Populate Trending Movies Table
        trendingMovies.forEach(movie => {
            $('#trending-movies tbody').append(`
                <tr>
                    <td>${movie.name}</td>
                    <td>${movie.reviews}</td>
                    <td>${movie.rating}</td>
                    <td>${movie.sentiment}</td>
                </tr>
            `);
        });

        // Example dynamic population for Recent Activities
        const recentActivities = [{
                activity: 'New movie added: Action Movie',
                date: '01/05/2025'
            },
            {
                activity: 'New user registered: John Doe',
                date: '01/05/2025'
            },
            {
                activity: 'New review submitted for: Comedy Movie',
                date: '01/05/2025'
            }
        ];

        // Populate Recent Activities Table
        recentActivities.forEach(activity => {
            $('#recentActivitiesTable tbody').append(`
                <tr>
                    <td>${activity.activity}</td>
                    <td>${activity.date}</td>
                </tr>
            `);
        });

        $(document).ready(function() {
            $('#trending-movies').DataTable();
            $('#recentActivitiesTable').DataTable();
        });
    </script>
</body>

</html>