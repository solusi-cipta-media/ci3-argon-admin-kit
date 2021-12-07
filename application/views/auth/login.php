<!DOCTYPE html>
<html lang="id">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Project-title</title>
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
  <!-- Favicon -->
  <link rel="icon" href="<?= base_url() ?>public/assets/img/favicon_io/favicon-32x32.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/argon.min5438.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/spinner.css" type="text/css">
</head>

<body class="bg-primary">
  <noscript>Mohon gunakan javascript</noscript>
  <div class="main-content">
    <!-- Header -->
    <div class="header py-5 mb-3">
      <div class="container mt-4">
        <div class="header-body text-center mb-4">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <center>
                <img src="<?= base_url() ?>public/assets/img/tut.png" alt="" style="max-width: 100px;">
              </center>
              <!-- <hr class="my-1"> -->
              <h1 class="text-white">Project-name</h1>
              <p class="text-lead text-white">Slogan-bila ada</p>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div> -->
    </div>
    <!-- Page content -->
    <div class="container mt--6 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-3">
              <div class="text-center text-muted mb-4">
                <small>E-Library</small>
              </div>

              <div class="login-validation">
              </div>

              <form role="form" id="form-login">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input required name="username" class="form-control" placeholder="Username / email" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input required name="password" class="form-control" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
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
      _sh.setLoading(".login-validation");

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