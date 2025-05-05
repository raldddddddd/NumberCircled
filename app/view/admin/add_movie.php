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
<?php session_start(); require_once("../menu.php"); ?>
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Add Movie</h2>
            <form id="employeeForm">
                <!-- id -->
                <input type="hidden" name="id" id="id"/>
                <input type="hidden" name="currentPage" id="currentPage" value="add_movie">
                <!-- Movie Name input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="mname" class="form-control" name="mname" required/>
                <label class="form-label" for="form3Example3">Movie Name</label>
                </div>

                <!-- Category input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <select class="form-select" aria-label="Default select example" name="category" id="category">
                    <option>Hor Hor HorHor</option>
                    <option>Action</option>
                </select>
                <label class="form-label" for="form3Example3">Category</label>
                </div>

                <!-- Description input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="description" class="form-control" name="description"/>
                <label class="form-label" for="form3Example3">Description</label>
                </div>

                <!-- Image input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="image" class="form-control" name="image"/>
                <label class="form-label" for="form3Example3">Image</label>
                </div>

                <!-- Release Date input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="date" id="release_date" class="form-control" name="release_date"/>
                <label class="form-label" for="form3Example3">Release Date</label>
                </div>

                <!-- Submit button -->
                <button id="submit-btn" type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Add Employee
                </button>
            </form>
            <br></br>
            <!-- Employee Table -->
            <h2 class="fw-bold mb-5">Employee List</h2>
            <div class="scrollwrapper">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="shemp" name="shemp" value="shemp">
            <label class="form-check-label">Show only employees with projects</label>
            </div> 
        <table class="table table-striped" style="overflow-y:scroll">
            <thead>
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Movie</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Release Date</th>
                    <th>Image</th>
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
</body>
</html>