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
            <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Prochain RDV</p>
                <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>Libelle Intervention</th>
                        <th>Type Etablissement</th>
                        <th>Adresse</th>
                        <th>Nom et Prénom Médecin</th>
                        <th>Numéro de Téléphone</th>
                        <th>Date Rendez vous</th>
                    </tr>  
                    </thead>
                    <tbody>
                        <?php if(!empty(NEXT_RDV)){ ?>
                        <?php foreach(NEXT_RDV as $rdv){ ?>
                        <tr>
                            <td><?php echo $rdv["libelleIntervention"]; ?></td>
                            <td><?php echo $rdv["typeEtabilissement"]; ?></td>
                            <td><?php echo $rdv["adresseEtabilissement"]." ". $rdv["codeCommune"]." ".$rdv["nomCommune"] ; ?></td>
                            <td><?php echo $rdv["nomSpecialiste"]." ".$rdv["prenomSpecialiste"] ; ?></td>
                            <td><?php echo $rdv["telSpecialiste"]; ?></td>
                            <td class="font-weight-medium"><div class="badge badge-success"><?php echo $rdv["creneau"]; ?></div></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Ancien RDV</p>
                <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>Libelle Intervention</th>
                        <th>Type Etablissement</th>
                        <th>Adresse</th>
                        <th>Nom et Prénom Médecin</th>
                        <th>Numéro de Téléphone</th>
                        <th>Date Rendez vous</th>
                    </tr>  
                    </thead>
                    <tbody>
                    <?php if(!empty(PREVIOUS_RDV)){ ?>
                    <?php foreach(PREVIOUS_RDV as $rdv){ ?>
                    <tr>
                        <td><?php echo $rdv["libelleIntervention"]; ?></td>
                        <td><?php echo $rdv["typeEtabilissement"]; ?></td>
                        <td><?php echo $rdv["adresseEtabilissement"]." ". $rdv["codeCommune"]." ".$rdv["nomCommune"] ; ?></td>
                        <td><?php echo $rdv["nomSpecialiste"]." ".$rdv["prenomSpecialiste"] ; ?></td>
                        <td><?php echo $rdv["telSpecialiste"]; ?></td>
                        <td class="font-weight-medium"><div class="badge badge-danger"><?php echo $rdv["creneau"]; ?></div></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>