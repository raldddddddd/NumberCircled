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

                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <h2>Admin Dashboard - Movie Management</h2>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text" id="totalUsers"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Movies</h5>
                                <p class="card-text" id="totalMovies"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 rounded shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Reviews</h5>
                                <p class="card-text" id="totalReviews"></p>
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

                <!-- <div id="trending-movie-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($data['trendingMovies'] as $movie): ?>
                        <div class="bg-white p-4 rounded-xl shadow">
                            <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($movie['name']) ?></h3>
                            <p><strong>Recent Reviews:</strong> <?= $movie['recent_reviews'] ?></p>
                            <p><strong>Recent Rating:</strong> <?= $movie['recent_rating'] ?>/5</p>
                            <p><strong>Overall Rating:</strong> <?= $movie['overall_rating'] ?>/5</p>
                            <p><strong>Change:</strong>
                                <span class="<?= $movie['rating_diff'] > 0 ? 'text-green-600' : ($movie['rating_diff'] < 0 ? 'text-red-600' : '') ?>">
                                    <?= $movie['rating_diff'] >= 0 ? '+' : '' ?><?= $movie['rating_diff'] ?>
                                </span>
                            </p>
                            <canvas id="sentimentChart_<?= $movie['id'] ?>" height="150"></canvas>
                        </div>
                    <?php endforeach; ?>
                </div> -->

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

        <?php include("modalsemantics.php"); ?>
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

                const chartData = data.sentimentDistribution;
                const sentimentChart = new Chart(document.getElementById('sentimentChart'), {
                    type: 'pie',
                    data: {
                        labels: Object.keys(chartData),
                        datasets: [{
                            data: Object.values(chartData),
                            backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });


                $('#positive-words-list').empty();
                data.positiveWords.forEach(word => {
                    $('#positive-words-list').append(`<span class="badge bg-success">${word.word} ${word.frequency}</span>`);
                });

                $('#negative-words-list').empty();
                data.negativeWords.forEach(word => {
                    $('#negative-words-list').append(`<span class="badge bg-danger">${word.word} ${word.frequency}</span>`);
                });

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