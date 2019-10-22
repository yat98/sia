<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>SIA | Login</title>
  <!-- Favicon -->
  <link href="<?= base_url('assets/img/brand/favicon.png')?>" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Bungee+Shade" rel="stylesheet">
  <!-- Icons -->
  <link href="<?= base_url('assets/vendor/nucleo/css/nucleo.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="<?= base_url('assets/css/argon.css?v=1.0.0') ?>" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow-lg border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h1 class="my-5" style="font-family: 'Bungee Shade';font-size:40px;">LOG-IN</h1>
              </div>
              <form role="form" action="<?= base_url('login') ?>" method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="Username" type="text" name="username" value="<?= $data->username ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" value="<?= $data->password ?>">
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?= base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- Argon JS -->
  <script src="<?= base_url('assets/js/argon.js?v=1.0.0') ?>"></script>
  <!-- SWEETALERT -->
  <script src="<?= base_url('assets/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>

  <?php
    $formErrorUsername = form_error('username');
    $formErrorPassword = form_error('password');
    if(!empty($formErrorUsername) || !empty($formErrorPassword)):
  ?>
    <!-- SCRIPT SWEETALERT INLINE -->
    <script>
      $(window).on('load',function(){
        let pesan = "<?= $formErrorUsername ?> \n <?= $formErrorPassword ?>";
        swal('Oops!',pesan,'error');
      });
    </script>
  <?php endif; ?>

  <?php
    $pesan = $this->session->flashdata('pesan_error');
    if(!empty($pesan)):
  ?>
    <!-- SCRIPT SWEETALERT INLINE -->
    <script>
      $(window).on('load',function(){
        let pesan = "<?= $pesan ?>";
        swal('Oops!',pesan,'error');
      });
    </script>
  <?php endif; ?>
</body>

</html>