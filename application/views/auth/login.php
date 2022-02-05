<!DOCTYPE html>
<html lang="id">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AppSens</title>
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
  <!-- Favicon -->
  <link rel="icon" href="<?= base_url() ?>public/assets/img/favicon_io/favicon-32x32.png" type="image/png">
  <!-- Fonts -->
  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/argon.min5438.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css" type="text/css">
</head>

<body>
  <noscript>Mohon gunakan javascript</noscript>
  <div class="main-content bg-image">
    <div class="container py-5">
      <div class="row justify-content-center justify-item-center position-relative w-100" style="min-height: 100vh; margin: 0; padding: 0;">
        <div class="col-lg-12 col-md-12 mx-0 mt-auto mb-auto row">
          <div class="card border-0 mb-0 col-lg-6 py-4" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
            <div class="card-body px-lg-5 py-lg-3">
              <h4 class="mb-5"> <?php $this->load->view('svg/logo'); ?> AppSens</h4>

              <h1>Login</h1>
              <p class="mb-4">Log in with your data that you entered during
                your registration.</p>
              <div class="login-validation">
              </div>

              <form role="form" id="form-login">
                <div class="form-group mb-3">
                  <label for="username">Username</label>
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input required name="username" id="username" class="form-control" placeholder="Username / email" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input required id="password" name="password" class="form-control" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4 btn-block">Sign in</button>
                </div>
                <p class="text-center">Don't have account? <a href="#">Sign up</a></p>
                <p class="text-center"><a href="#">Forgot password?</a></p>
              </form>
            </div>
          </div>
          <div class="card border-0 mb-0 col-lg-6 shadow-none under-sm-d-none" style="background: rgba(55, 84, 219, 0.57);backdrop-filter: blur(20px);border-radius: 0px 15px 15px 0px;">
            <div class="card-body px-lg-5 py-lg-3 position-relative">
              <div class="mt-auto d-block text-white position-absolute pb-5" style="height: max-content; bottom: 0;">
                <h4 class="mb-3"> <?php $this->load->view('svg/logo'); ?> <span class="text-white">AppSens</span></h4>
                <h1 class="text-white mb-5" style="font-size: 64px; line-height: 1.1;">
                  Smart <br> Attendance <br> System
                </h1>
                <h4 class="text-white">Developed by SCM</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <!-- <footer class="py-5 text-center" style="display: block;">
    <div class="copyright text-center text-muted">
      &copy; copyright <?= $unit->name ?> 2020 <a href="solusiciptamedia.com" class="font-weight-bold ml-1" target="_blank">Support by Solusi Cipta Media</a>
    </div>
  </footer> -->
  <script src="<?= base_url() ?>public/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/argon.min5438.js?v=1.2.0"></script>
  <script src="<?= base_url() ?>public/assets/js/demo.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/scm-helper.js"></script>
</body>
<script>
  const base_url = "<?= base_url() ?>";
</script>
<script>
  class Login {
    set_invalid() {
      $(".login-validation").html(
        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Ooops!</strong> username dan password salah!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>`
      )
    }
  }
</script>
<script>
  const login = new Login()
  const loginValidation = $(".login-validation");
  $(function(e) {
    $("#form-login").on("submit", function(e) {
      e.preventDefault()
      $(".login-validation").setLoading();

      const form = $(this).serialize()

      $.ajax({
        url: base_url + "auth/login/submit",
        type: "POST",
        data: form,
        success: function(data) {
          loginValidation.html("")
          location.href = base_url
        },
        error: function(x, s, e) {
          login.set_invalid()
        }
      })
    })
  })
</script>

</html>