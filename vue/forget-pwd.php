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
              <h4>Mot de passe oublié ?</h4>
              <h6 class="font-weight-light">Pas de crainte, si votre adresse email figure dans notre système, vous receverez un lien, pour modifier votre mot de passe</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Identifiants ou email">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Envoyer</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 Vous souhaitez revenir à <a href="<?php echo SERVER.""?>" class="text-primary">l'accueil</a>
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
  <!-- container-scroller -->
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
