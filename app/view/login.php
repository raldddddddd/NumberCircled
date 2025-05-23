<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Numbercircld</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="regis_login_style.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../script/script.js"></script>
</head>

<body>
  <div class="login-container">
    <!-- Left Pane -->
    <div class="left-pane login-bg">
      <div class="left-pane-overlay">
        <div class="brand-header">
          <h1>Numbercircld</h1>
          <p>Definitely not Letterboxd</p>
        </div>
        <h2 class="my-4"><img src="/NumberCircled/assets/logo-white-text.png" class="me-2 img-fluid" style="max-height: 35px;" alt="Logo"/>Your life in film.</h2>
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
        <h3 class="mb-2">Log in</h3>
        <p class="text-muted-custom mb-4">Review your favorite films across time and space</p>
        <form id="login_form">
          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-envelope"></i></span>
            <input type="email" id="login_email" name="login_email" class="form-control" placeholder="E-mail" />
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text bg-white text-dark"><i class="bi bi-lock"></i></span>
            <input type="password" id="login_password" name="login_password" class="form-control" placeholder="Password" />
          </div>

          <div class="text-end mb-4">
            <button class="btn btn-primary px-4 py-3  justify-content-center gap-2" style="width: 120px;">Login <i class="bi bi-caret-right-fill"></i></button>
          </div>

          <hr class="border-light opacity-50" />

          <div class="d-flex justify-content-between">
            <span class="text-white">Don’t have an account?</span>
            <a href="registration.php" class="text-primary text-decoration-none">Click here to Sign Up!</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>