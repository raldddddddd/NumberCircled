<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$profile_image = $_SESSION['profile_image'];
?>

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
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="text-dark">🎬 Admin Dashboard</h2>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white mb-3 shadow" style="background-color: #b91c1c;">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text" id="totalUsers"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 shadow" style="background-color: #b91c1c;">
                            <div class="card-body">
                                <h5 class="card-title">Total Movies</h5>
                                <p class="card-text" id="totalMovies"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 shadow" style="background-color: #b91c1c;">
                            <div class="card-body">
                                <h5 class="card-title">Total Reviews</h5>
                                <p class="card-text" id="totalReviews"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 shadow" style="background-color: #b91c1c;">
                            <div class="card-body">
                                <h5 class="card-title">Total Genres</h5>
                                <p class="card-text" id="totalGenres"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h4 class="text-dark">📊 Sentiment Distribution</h4>
                    <div class="bg-light rounded p-3 shadow-sm" style="height: 300px;">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 text-center">
                        <h5 class="mb-3 text-dark">Top Used Positive Words</h5>
                        <div id="positive-words-list" class="d-flex flex-wrap justify-content-center gap-2"></div>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="mb-3 text-dark">Top Used Negative Words</h5>
                        <div id="negative-words-list" class="d-flex flex-wrap justify-content-center gap-2"></div>
                    </div>
                </div>

                <div class="mb-5 mt-5">
                    <h5 class="text-dark">🎥 Reviews Per Movie</h5>
                    <canvas id="reviewsPerProductChart" height="100"></canvas>
                </div>

                <div class="mb-3">
                    <label for="movieSelect" class="form-label fw-bold text-dark">Sentiment Trend for Movie</label>
                    <select id="movieSelect" class="form-select border border-dark">
                        <option value="">Select a movie</option>
                    </select>
                </div>
                <div class="mb-5">
                    <canvas id="sentimentTrendChart" height="100"></canvas>
                </div>

                <div class="mb-4 mt-5">
                    <div class="bg-light rounded shadow-sm p-3">
                        <h4 class="text-dark">🕒 Recent Activities</h4>
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
    <script src="../../../script/script.js"></script>
    <script>
        $.ajax({
            url: '/NumberCircled/app/controller/dashboard-data.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#totalUsers').text(data.totalUsers);
                $('#totalMovies').text(data.totalMovies);
                $('#totalReviews').text(data.totalReviews);
                $('#totalGenres').text(data.totalGenres);

                // Sentiment Distribution Pie
                const sentimentChart = new Chart(document.getElementById('sentimentChart'), {
                    type: 'pie',
                    data: {
                        labels: Object.keys(data.sentimentDistribution),
                        datasets: [{
                            data: Object.values(data.sentimentDistribution),
                            backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                if (Array.isArray(data.reviewsPerProduct)) {
                    new Chart(document.getElementById('reviewsPerProductChart'), {
                        type: 'bar',
                        data: {
                            labels: data.reviewsPerProduct.map(r => r.name),
                            datasets: [{
                                label: 'Number of Reviews',
                                data: data.reviewsPerProduct.map(r => r.review_count),
                                backgroundColor: '#4C51BF'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }

                let sentimentTrendChart = null;

                function populateMovieDropdown(movies) {
                    const movieSelect = document.getElementById('movieSelect');
                    movieSelect.innerHTML = '<option value="">Select a movie</option>';

                    movies.forEach(movie => {
                        const option = document.createElement('option');
                        option.value = movie.id;
                        option.textContent = movie.name;
                        movieSelect.appendChild(option);
                    });
                }

                // Load dropdown on page load
                $.get('/NumberCircled/app/controller/fetch/fetch_options.php?type=movies', function(data) {
                    populateMovieDropdown(data);
                });

                // Listen for dropdown change
                $('#movieSelect').on('change', function() {
                    const movieId = $(this).val();
                    if (movieId) {
                        loadSentimentTrend(movieId);
                    }
                });

                // Load sentiment trend chart
                function loadSentimentTrend(movieId) {
                    $.get('/NumberCircled/app/controller/fetch/fetch_sentiment_trend.php', {
                        movie_id: movieId
                    }, function(data) {
                        const labels = data.map(entry => entry.date);
                        const positive = data.map(entry => entry.positive);
                        const neutral = data.map(entry => entry.neutral);
                        const negative = data.map(entry => entry.negative);

                        if (sentimentTrendChart) sentimentTrendChart.destroy();

                        sentimentTrendChart = new Chart(document.getElementById('sentimentTrendChart'), {
                            type: 'line',
                            data: {
                                labels,
                                datasets: [{
                                        label: 'Positive',
                                        data: positive,
                                        borderColor: '#4CAF50',
                                        backgroundColor: 'rgba(76, 175, 80, 0.2)',
                                        fill: false
                                    },
                                    {
                                        label: 'Neutral',
                                        data: neutral,
                                        borderColor: '#FFC107',
                                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                                        fill: false
                                    },
                                    {
                                        label: 'Negative',
                                        data: negative,
                                        borderColor: '#F44336',
                                        backgroundColor: 'rgba(244, 67, 54, 0.2)',
                                        fill: false
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                }


                // Sentiment Words
                $('#positive-words-list').empty();
                data.positiveWords.forEach(word => {
                    $('#positive-words-list').append(`<span class="badge bg-success">${word.word} ${word.frequency}</span>`);
                });

                $('#negative-words-list').empty();
                data.negativeWords.forEach(word => {
                    $('#negative-words-list').append(`<span class="badge bg-danger">${word.word} ${word.frequency}</span>`);
                });

                // Recent Activities Table
                if ($.fn.DataTable.isDataTable('#recentActivitiesTable')) {
                    $('#recentActivitiesTable').DataTable().clear().destroy();
                }

                $('#recentActivitiesTable tbody').empty();
                data.recentActivities.forEach(activity => {
                    $('#recentActivitiesTable tbody').append(`
                    <tr>
                        <td>${activity.activity}</td>
                        <td>${activity.date}</td>
                    </tr>
                `);
                });

                $('#recentActivitiesTable').DataTable({
                    order: [
                        [1, 'desc']
                    ]
                });
            },
            error: function() {
                alert('Failed to fetch dashboard data.');
            }
        });
    </script>

</body>

</html>