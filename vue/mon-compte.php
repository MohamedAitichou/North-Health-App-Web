                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">January - March</a>
                        <a class="dropdown-item" href="#">March - June</a>
                        <a class="dropdown-item" href="#">June - August</a>
                        <a class="dropdown-item" href="#">August - November</a>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card ">
                <div class="card-body mt-auto">
                    <h4 class="card-title">Mes informations</h4>
                    <p class="card-description">
                    Vous avez la main sur vos informations...
                    </p>
                    <?php if(isset($_COOKIE['MODIFICATION']) && $_COOKIE['MODIFICATION'] == 'OK'){ ?>
                    <div class="alert alert-success" role="alert">
                        Vos données ont bien été mises à jour...
                    </div>
                    <?php } ?>
                    <?php if(isset($_COOKIE['MODIFICATION']) && $_COOKIE['MODIFICATION'] == 'KO'){ ?>
                    <div class="alert alert-danger" role="alert">
                        Une erreur est survenue pendant l'enregistrement ! Veuillez recommencer...
                    </div>
                    <?php } ?>
                    <form class="forms-sample" action="<?php echo SERVER; ?>modifier-info-patient" method="POST">
                        <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" class="form-control" id="prenom" value="<?php echo USER_INFO['prenomPatient']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="email" class="form-control" id="nom" value="<?php echo USER_INFO['nomPatient']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo USER_INFO['emailPatient']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="adresse" placeholder="<?php echo USER_INFO['adressePatient']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" class="form-control" id="ville" placeholder="<?php echo USER_INFO['villePatient']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="cp">Code postal</label>
                            <input type="text" name="cp" class="form-control" id="cp" placeholder="<?php echo USER_INFO['cpPatient']; ?>">
                        </div>
                        <div class="form-group">
                            <?php if(USER_INFO['numeroSecuPatient'] == NULL){ ?>
                                <label for="numSecu">N° Sécurité social</label>
                                <input type="text" name="numSecu" class="form-control" id="numSecu" placeholder="Saisir votre numéro de sécurité sociale">
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                        <button type="reset" class="btn btn-light">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Ma date de niassance</p>
                        <p class="fs-20 mb-2"><b><?php echo USER_INFO['dateNaissancePatient']; ?></b></p>
                        
                    </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Mon médecin traitant déclaré</p>
                        <p class="fs-20 mb-2"><b><?php echo USER_INFO['medecinTraitant']; ?></b></p>
                    </div>
                    </div>
                </div>
                <?php if(USER_INFO['numeroSecuPatient'] != NULL){ ?>
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Numéro de sécurité Sociale</p>
                            <p class="fs-20 mb-2"><b><?php echo USER_INFO['numeroSecuPatient']; ?></b></p>
                        </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
            </div>
        </div>
    </div>