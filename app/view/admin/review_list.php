<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logged</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../script/script.js"></script>
</head>
<body >
<?php session_start(); require_once("../menu.php");?>
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <!-- id -->
            <input type="hidden" name="currentPage" id="currentPage" value="review_list">
            <!-- Review Table -->
            <h2 class="fw-bold mb-5">Review List</h2>
            <div class="scrollwrapper">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="shemp" name="shemp" value="shemp">
            <label class="form-check-label">Filter Label</label>
            </div> 
        <table class="table table-striped" style="overflow-y:scroll">
            <thead>
                <tr class="table-primary">
                    <th abbr="id">ID</th>
                    <th abbr="first_name">Name</th>
                    <th abbr="movie">Movie</th>
                    <th abbr="rating">Rating</th>
                    <th abbr="sentiment_category">Sentiment Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableLoad">
                <!-- Student list will be loaded here via AJAX -->
            </tbody>
        </table>
        </div>

        </div>
      </div>
    </div>

    <p></p>
</body>
</html>