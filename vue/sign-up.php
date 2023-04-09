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
              <h4>Bonjour ! Créer un compte</h4>
              <h6 class="font-weight-light">Une fois inscrit vous pourrez consulter vos activités médicales</h6>

              <?php if(isset($_COOKIE["INSERTION"]) && $_COOKIE["INSERTION"] == "OK"){?>
              <div class="alert alert-success" role="alert">
                Votre compte a bien été crée! Veuillez vous connecter
              </div>
              <?php }?>
              
              <?php if(isset($_COOKIE["INSERTION"]) && $_COOKIE["INSERTION"] == "KO"){?>
              <div class="alert alert-danger" role="alert">
                Une erreur est survenue ! Veuillez recommencer...
              </div>
              <?php }?>

              <form class="pt-3" action="<?php echo SERVER."traiter-donnees-iscription";?>" method="POST">
                <div class="form-group">
                  <input type="text" name="nom" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre nom">
                </div>
                <div class="form-group">
                  <input type="text" name="prenom" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre email">
                </div>
                <div class="form-group">
                  <input type="password" name="pwd" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                  <input type="text" name="adresse" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre adresse">
                </div>
                <div class="form-group">
                  <input type="text" name="ville" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre ville">
                </div>
                <div class="form-group">
                  <input type="text" name="cp" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre code postale">
                </div>
                <div class="form-group">
                  <input type="date" name="datenaissance" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Date de naissance">
                </div>
                <div class="form-group">
                  <input type="text" name="numsecu" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Numéro de sécurité social">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">S'enregistrer</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 avez-vous déjà un compte? <a href="<?php echo SERVER.""?>" class="text-primary">Se connecter</a>
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
  <!-- plugins:js -->
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
