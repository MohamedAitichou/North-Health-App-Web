
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
                    <h4 class="card-title">Prenez rendez-vous</h4>
                    <p class="card-description">
                        Sans plus tarder il est désormais possible de prendre rendez-vous en quelques cliques...
                    </p>
                    <?php if(isset($_COOKIE['INSERTION_RDV']) && $_COOKIE['INSERTION_RDV'] == 'OK'){ ?>
                    <div class="alert alert-success" role="alert">
                        Le rendez vous à été confirmer
                    </div>
                    <?php } ?>
                    <?php if(isset($_COOKIE['INSERTION_RDV']) && $_COOKIE['INSERTION_RDV'] == 'KO'){ ?>
                    <div class="alert alert-danger" role="alert">
                        Une erreur est survenue... ! Veuillez recommencer
                    </div>
                    <?php } ?>
                    <form class="forms-sample" action="<?php echo SERVER; ?>confirmer-rdv" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="region">Choisissez la région</label>
                            <select class="form-control" id="region">
                                <?php foreach(REGIONS as $region){ ?>
                                    <option value="<?php echo $region['nomRegion']; ?>"><?php echo $region['nomRegion']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div style="display:none" class="form-group" id="dep-div">
                            <label for="departement">Choisissez le département</label>
                            <select class="form-control" id="departement">
                            </select>
                        </div>
                        <div style="display:none" class="form-group" id="com-div">
                            <label for="commune">Choisissez la ville</label>
                            <select class="form-control" name="ville" id="commune"> 
                            </select>
                        </div>
                        <div style="display:none" class="form-group" id="type-exam">
                            <label for="examen">Choisissez le type d’examen</label>
                            <select class="form-control" name="typeexam" id="examen"> 
                            </select>
                        </div>
                        <div style="display:none" class="form-group" id="div-lieu">
                            <label for="lieu">Choisissez le type étabilissement</label>
                            <select class="form-control" name="typeetab" id="lieu"> 
                            </select>
                        </div>
                        <div style="display:none" class="form-group" id="div-praticien">
                            <label for="praticien">Choisissez le praticien</label>
                            <select class="form-control" name="praticien" id="praticien"> 
                            </select>
                        </div>

                        <div style="display:none" class="form-group" id="div-creneaux">
                            <label for="creneaux">Choisissez un créneaux disponible</label>
                            <select class="form-control" name="creneau" id="creneaux"> 
                            </select>
                        </div>
                        <input type="hidden" name="idPatient" value="<?php echo $_SESSION["idPatient"]; ?>">
                        <div style="display:none" class="form-group" id="load-documents">
                            <label>Déposer un ou plusieurs documents <span style='font-size:12px'>(exemple: certificat médical, ordonnance,... )</span> </label>
                            <input type="file" name="documents[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Mes documents à transmettre...">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Insérer un document</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" id="confirme" class="btn btn-primary mr-2">Confirmer le rendez-vous</button>
                        <button type="reset" id="reset" class="btn btn-light">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $("#confirme").hide();
            $("#reset").hide();

            $('#region').on('change', function() {
                $("#com-div").css('display', 'none');
                var selectedRegion = this.value;
                $.ajax({
                    url:"http://127.0.0.1/NorthHealth/departement-par-region",
                    type: "post",    //request type,
                    dataType: 'json',
                    data: {region: selectedRegion},
                    success:function(result){
                        var deptSelect = $("#departement");
                        deptSelect.empty();
                        deptSelect.append(new Option("...", ""));
                        for(var i = 0; i < result.length; i++){
                            var dptName = result[i].nomDepartement;
                            var dptCode =  result[i].codeDepartement;
                            var o = new Option(dptName+" ("+dptCode+")", dptName);
                            
                            $(o).html(dptName+" ("+dptCode+")");
                            deptSelect.append(o);
                        }
                        $("#dep-div").css('display', 'block');
                    }
                });
            });

            $('#departement').on('change', function() {
                var selectedDept = this.value;
                
                $.ajax({
                    url:"http://127.0.0.1/NorthHealth/commune-par-departement",
                    type: "post",    //request type,
                    dataType: 'json',
                    data: {departement: selectedDept},
                    success:function(result){
                        var communeSelect = $("#commune");
                        communeSelect.empty();
                        communeSelect.append(new Option("...", ""));
                        for(var i = 0; i < result.length; i++){
                            var communeName = result[i].nomCommune;
                            var communeCode =  result[i].codePostal;
                            var o = new Option(communeName+" ("+communeCode+")", communeCode);
                            
                            $(o).html(communeName+" ("+communeCode+")");
                            communeSelect.append(o);
                        }
                        $("#com-div").css('display', 'block');
                    }
                });
            });

            let cp = null;
            $('#commune').on('change', function() {
                var selectedCp = this.value;
                cp = selectedCp;
                $.ajax({

                    url:"http://127.0.0.1/NorthHealth/intervetion-par-ville",
                    type: "post",
                    dataType: "json",
                    data: {cp: selectedCp},
                    success:function(result){
                        var examenSelect = $("#examen");
                        examenSelect.empty();
                        examenSelect.append(new Option("...", ""));
                        // {idTypeIntervention: '3', libelleIntervention: 'Acide urique - dosage - sérum', idTypeEtabilissement: '1002', typeEtabilissement: 'Laboratoire Montgeron', adresseEtabilissement: '12 rue Pasteur'}
                        for(var i = 0; i < result.length; i++){
                            var libelleIntervention = result[i].libelleIntervention;
                            var idTypeIntervention = result[i].idTypeIntervention;
                            var o = new Option(libelleIntervention, libelleIntervention);
                            
                            $(o).html(libelleIntervention);
                            examenSelect.append(o);
                        }

                        $("#type-exam").css('display', 'block');
                    }
                });
            });

            $('#examen').on('change', function() {
                var selectedExam = this.value;
                var selectedCp = cp;

                $.ajax({

                    url:"http://127.0.0.1/NorthHealth/lieu-par-examen",
                    type: "post",
                    dataType: "json",
                    data: {libelle:selectedExam, cp: selectedCp},
                    success:function(result){
                        
                        var lieuSelect = $("#lieu");
                        lieuSelect.empty();
                        lieuSelect.append(new Option("...", ""));
                        // {idTypeIntervention: '3', libelleIntervention: 'Acide urique - dosage - sérum', idTypeEtabilissement: '1002', typeEtabilissement: 'Laboratoire Montgeron', adresseEtabilissement: '12 rue Pasteur'}
                        for(var i = 0; i < result.length; i++){
                            var typeEtabilissement = result[i].typeEtabilissement;
                            var idTypeEtabilissement = result[i].idTypeEtabilissement;
                            var o = new Option(typeEtabilissement, idTypeEtabilissement);
                            
                            $(o).html(typeEtabilissement);
                            lieuSelect.append(o);
                        }

                        $("#div-lieu").css('display', 'block');

                    }
                });
            });

            $('#lieu').on('change', function() {

                var lieuSelected = this.value;
                $.ajax({
                    url:"http://127.0.0.1/NorthHealth/praticien-par-etab",
                    type: "post",
                    dataType: "json",
                    data: {etab:lieuSelected},
                    success:function(result){
                        
                        var praticienSelect = $("#praticien");
                        praticienSelect.empty();
                        praticienSelect.append(new Option("...", ""));
                        
                        for(var i = 0; i < result.length; i++){
                            var nomSpecialiste = result[i].nomSpecialiste;
                            var prenomSpecialiste = result[i].prenomSpecialiste;
                            var idSpecialite = result[i].idSpecialite;

                            var o = new Option(nomSpecialiste +" "+ prenomSpecialiste , idSpecialite);
                            
                            $(o).html(nomSpecialiste +" "+ prenomSpecialiste);
                            praticienSelect.append(o);
                        }

                        $("#div-praticien").css('display', 'block');

                    }
                });
            });

            $('#praticien').on('change', function() {

                var praticienSelected = this.value;
                $.ajax({
                    url:"http://127.0.0.1/NorthHealth/creneaux-praticien",
                    type: "post",
                    dataType: "json",
                    data: {idPrat:praticienSelected},
                    success:function(result){
                        
                        console.log(result);
                        var creneauxSelect = $("#creneaux");
                        creneauxSelect.empty();
                        creneauxSelect.append(new Option("...", ""));
                        const format = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                        for(var i = 0; i < result.length; i++){
                            
                            var dateCreneau = result[i].dateCreneau;
                            const date = new Date(dateCreneau);
                            const formattedDate = date.toLocaleDateString('fr-FR', format);
                            var o = new Option(formattedDate, dateCreneau);
                            
                            $(o).html(formattedDate);
                            creneauxSelect.append(o);
                        }
                        $("#div-creneaux").css('display', 'block');
                    }
                });
            });
            $('#creneaux').on('change', function() {
                $("#load-documents").css('display', 'block');
                $("#confirme").show();
                $("#reset").show();
            });
        });
    </script>

    