
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card ">
                <div class="card-body mt-auto">
                    <h4 class="card-title">Ajouter un spécialiste</h4>
                    <p class="card-description">
                        Sans plus tarder il est désormais possible de prendre rendez-vous en quelques cliques...
                    </p>
                    <?php if(isset($_COOKIE['INSERTION_SP']) && $_COOKIE['INSERTION_SP'] == 'OK'){ ?>
                    <div class="alert alert-success" role="alert">
                        L'ajout a été confirmé
                    </div>
                    <?php } ?>
                    <?php if(isset($_COOKIE['INSERTION_SP']) && $_COOKIE['INSERTION_SP'] == 'KO'){ ?>
                    <div class="alert alert-danger" role="alert">
                        Une erreur est survenue... ! Veuillez recommencer
                    </div>
                    <?php } ?>
                    <form class="forms-sample" action="<?php echo SERVER; ?>ajouter-specialiste" method="POST">
                        <div class="form-group">
                            <input type="text" name="nom" class="form-control form-control-lg"  placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <input type="text" name="prenom" class="form-control form-control-lg"  placeholder="Prénom">
                        </div>
                        <div class="form-group">
                            <input type="text" name="adresse" class="form-control form-control-lg"  placeholder="Adresse">
                        </div>
                        <div class="form-group">
                            <input type="phone" name="tel" class="form-control form-control-lg"  placeholder="Téléphone">
                        </div>
                        <div class="form-group">
                            <label for="region">Choisissez la ville</label>
                            <select class="form-control" name="cp" id="etab">
                                <?php foreach(COMMUNE as $commune){ ?>
                                    <option value="<?php echo $commune["codePostal"]; ?>"><?php echo $commune["nomCommune"] ." (".$commune["codePostal"].") Dans la région ".$commune["nomRegion"] ; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="region">Choisissez la spécialité</label>
                            <select class="form-control" name="idSp" id="etab">
                                <?php foreach(SPECIALITE as $sp){ ?>
                                    <option value="<?php echo $sp["idSpecialite"]; ?>"><?php echo $sp["libelleSpecialite"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>             
                        <button type="submit" id="confirme" class="btn btn-primary mr-2">Enregistrer</button>
                        <button type="reset" id="reset" class="btn btn-light">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    