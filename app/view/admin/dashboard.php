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
                                <p class="card-text" id="totalUsers"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 rounded shadow-sm">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
    <script src="../../../script/script.js"></script>
</body>

</html>