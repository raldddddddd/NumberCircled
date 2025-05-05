<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add EMPLOYEES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body >
<?php include("dashboard_menu.php"); ?>

<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/33.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Employee Form</h2>
          <form id="employeeForm">
            <!-- id -->
            <input type="hidden" name="id" id="id"/>
            <input type="hidden" name="employee_id" id="employee_id"/>
            <input type="hidden" name="editmode" id="editmode"/>
            <!-- fname input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="fname" class="form-control" name="fname" required/>
              <label class="form-label" for="form3Example3">Full name</label>
            </div>

            <!-- Position input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input  type="text" id="position" class="form-control" name="position" required/>
              <label class="form-label" for="form3Example3">Position</label>
            </div>

            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                  <input type="number" id="work_hrs" class="form-control" name="work_hrs" required/>
                  <label class="form-label" for="form3Example1">Hours Worked</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                  <input type="number" id="rate" class="form-control" name="rate" required/>
                  <label class="form-label" for="form3Example2">Rate per Hour</label>
                </div>
              </div>
            </div>

            <!-- Project Assigned -->
            <div data-mdb-input-init class="form-outline mb-4">
            <select class="form-select" aria-label="Default select example" name="project" id="project">
            </select>
              <label class="form-label" for="form3Example3">Project Name</label>
            </div>

            <!-- salary input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="number" id="salary" class="form-control" name="salary" disabled />
              <label class="form-label" for="form3Example3">Total Salary</label>
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
                    <th>Employee ID</th>
                    <th>Full Name</th>
                    <th>Position</th>
                    <th>Project ID</th>
                    <th>Rate per Hour</th>
                    <th>Hours Worked</th>
                    <th>Total Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="employeeTable">
                <!-- Student list will be loaded here via AJAX -->
            </tbody>
        </table>
        </div>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
    
    

    <script src="script/script.js"></script>
</body>
</html>