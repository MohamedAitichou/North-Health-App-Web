<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Se connecter</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo SERVER; ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo SERVER; ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo SERVER; ?>assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo SERVER; ?>assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo SERVER; ?>assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo SERVER; ?>assets/images/logo.svg" alt="logo">
              </div>
              <h4>Bonjour ! Connectez-vous</h4>
              <h6 class="font-weight-light">Vous pouvez consulter vos activités médicales</h6>

              <form class="pt-3" action="<?php echo SERVER."verify-connection" ?>" method="POST">
                <?php if(isset($_COOKIE["CONNECTION"]) && $_COOKIE["CONNECTION"] == "KO"){?>
                <div class="alert alert-danger" role="alert">
                  Login et ou le mot de passe est incorrect! Veuillez recommencer...
                </div>  
                <?php }?>
                <?php if(isset($_COOKIE["ACTION"]) && $_COOKIE["ACTION"] == "NOT_ALLOWED"){?>
                <div class="alert alert-danger" role="alert">
                  [403] action non Autorisée...
                </div>  
                <?php }?>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Identifiants ou email">
                </div>
                <div class="form-group">
                  <input type="password" name="pwd" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Se connecter</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input name="isadmin" type="checkbox" class="form-check-input">
                      je suis admin
                    </label>
                  </div>
                  <a href="<?php echo SERVER."mot-de-passe-oublie"?>" class="auth-link text-black">Mot de passe oublié?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 Vous n'avez pas de compte? <a href="<?php echo SERVER."creer-un-compte"?>" class="text-primary">S'inscrire</a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    });
  </script>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo SERVER; ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo SERVER; ?>assets/js/off-canvas.js"></script>
  <script src="<?php echo SERVER; ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo SERVER; ?>assets/js/template.js"></script>
  <script src="<?php echo SERVER; ?>assets/js/settings.js"></script>
  <script src="<?php echo SERVER; ?>assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
