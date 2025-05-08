<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../script/script.js"></script>
  <title>Registration</title>
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
              <form id="registration_form">
                <input type="hidden" name="user_id" id="user_id" />

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div data-mdb-input-init class="form-outline">
                      <input type="email" id="email" class="form-control form-control-lg" name="email" required />
                      <label class="form-label" for="email">Email</label>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="first_name" class="form-control form-control-lg" name="first_name" required />
                          <label class="form-label" for="first_name">First Name</label>
                        </div>

                        <div class="form-outline">
                          <input type="text" id="last_name" class="form-control form-control-lg" name="last_name" required />
                          <label class="form-label" for="last_name">Last Name</label>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6 mb-4">

                      <div data-mdb-input-init class="form-outline">
                        <input type="password" id="password" class="form-control form-control-lg" name="password" required />
                        <label class="form-label" for="password">Password</label>
                      </div>

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="role" class="form-control form-control-lg" name="role" required />
                        <label class="form-label" for="role">Role</label>
                      </div>

                    </div>
                  </div>


                  <div class="mt-4 pt-2">
                    <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Submit" />
                  </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php

  ?>

</body>

</html>