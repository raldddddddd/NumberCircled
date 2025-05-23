<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Signup | Numbercircle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="regis_login_style.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../script/script.js"></script>
</head>

<body>
  <div class="signup-container">
    <!-- Left Pane -->
    <div class="left-pane">
      <div class="left-pane-overlay">
        <div class="brand-header">
          <h1>Numbercircld</h1>
          <p>Definitely not Letterboxd</p>
        </div>
        <h2 class="my-4"><img src="/NumberCircled/assets/logo-white-text.png" class="me-2 img-fluid" style="max-height: 35px;" alt="Logo" />Your life in film.</h2>
        <div class="social-icons">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div>

    <!-- Right Pane -->
    <div class="form-box">
      <div class="form-container">
        <h3 class="mb-3">Sign Up</h3>
        <p class="text-muted-custom mb-4">Please complete your information below</p>
        <form id="registration_form">
          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-person"></i></span>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required/>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-person"></i></span>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required/>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-envelope"></i></span>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required/>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-lock"></i></span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="8" required/>
          </div>

          <div class="mb-4 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="Confirm Password" minlength="8" required/>
          </div>

          <div class="mb-3 text-end">
            <button class="btn btn-primary px-4 py-3  justify-content-center gap-2" style="width: 120px;">Next <i class="bi bi-caret-right-fill"></i></button>
          </div>
          <hr class="border-light opacity-50">

          <div class="d-flex justify-content-between mt-2">
            <span class="text-white">Already have an account?</span>
            <a href="login.php" class="text-primary text-decoration-none">Login to your account</a>
          </div>
        </form>
      </div>
    </div>
  </div>



</body>

</html>