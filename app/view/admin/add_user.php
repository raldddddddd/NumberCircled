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
            <h2 class="fw-bold mb-5">Add User</h2>
            <form id="userForm">
                <!-- id -->
                <input type="hidden" name="role_id" id="role_id" value=<?php echo $_SESSION['role_id']?>>
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="currentPage" id="currentPage" value="add_user">
                <!-- Name input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="first_name" class="form-control" name="first_name" required/>
                <label class="form-label" for="form3Example3">First Name</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="last_name" class="form-control" name="last_name" required/>
                <label class="form-label" for="form3Example3">Last Name</label>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input  type="email" id="email" class="form-control" name="email" required/>
                <label class="form-label" for="form3Example3">Email</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input  type="text" id="password" class="form-control" name="password" required/>
                <label class="form-label" for="form3Example3">Password</label>
                </div>


                <!-- Role Assigned -->
                <div data-mdb-input-init class="form-outline mb-4">
                <select class="form-select" id="role" aria-label="Default select example" name="role">
                    <option id='adminOpt' value='2'>Admin</option>
                    <option id='userOpt' value='3'>User</option>
                </select>
                <label class="form-label" for="form3Example3">Role</label>
                </div>

                

                <!-- Submit button -->
                <button id="submit-btn" type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Add User
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role ID</th>
                    <th>Created Time</th>
                    <th>Login Time</th>
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