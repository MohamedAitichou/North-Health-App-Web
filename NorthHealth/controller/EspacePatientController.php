<?php

    class EspacePatientController{

        private $view;

        public function __construct($view)
        {
            $this->view = $view;
        } 

        public function loadView(){
        
            // TODO: Load Header...
            require_once("vue\\Shared\\header.php");
            // TODO: Load Body...
            require_once("vue\\".$this->view.".php");
            // TODO: Load Footer...
            require_once("vue\\Shared\\footer.php");
            
            
        }

        public function infoPatient(){
            if(!empty($_SESSION['SESSION_ID'])){
                $idPatient  = $_SESSION["idPatient"];
                $model = new NorthHealthContext();
                $infoPatient = $model->getInfoPatient($idPatient);
                define("USER_INFO", $infoPatient);
            }
        }

        public function modifierInfoPatient(){
            if(!empty($_SESSION['SESSION_ID'])){
                $idPatient  = $_SESSION["idPatient"];
                $model = new NorthHealthContext();
                $infoPatient = $model->modifierInfoPatient($idPatient, $_POST);
                if($infoPatient){
                    define("USER_INFO", $model->getInfoPatient($idPatient));
                    // Update Session...
                    foreach(USER_INFO as $key => $value){
                        $_SESSION[$key] = $value;
                    }
                    setcookie("MODIFICATION", "OK", time()+20);
                }else{
                    setcookie("MODIFICATION", "KO", time()+20);
                }

                header("Location: ".SERVER."mon-compte");
                exit;
                

            }
        }

        public function getRegion(){
            $model = new NorthHealthContext();
            $allRegions = $model->selectAllRegion();
            define("REGIONS", $allRegions);
        }

        public function getDepartementParRegion($nomRegion){
            $model = new NorthHealthContext();
            $allDepartement = $model->selectDepartementParRegion($nomRegion);
            return json_encode($allDepartement);
        }

        public function getCommuneParDepartement($nomDepartement){
            $model = new NorthHealthContext();
            $allCommune = $model->selectCommuneParDepartement($nomDepartement);
            return json_encode($allCommune);
        }

        public function getInterventionParVille($cp){
            $model = new NorthHealthContext();
            $allIntervention = $model->selectInterventionParVille($cp);
            return json_encode($allIntervention);
        }

        public function selectLieuParExamen($libelle, $cp){
            $model = new NorthHealthContext();
            $lieux = $model->selectLieuParExamen($libelle, $cp);
            return json_encode($lieux);
        }

        public function praticienParEtab($etab){
            $model = new NorthHealthContext();
            $praticien = $model->praticienParEtab($etab);
            return json_encode($praticien);
        }

        public function creneauxPraticien($idPrat){
            $model = new NorthHealthContext();
            $praticien = $model->creneauxPraticien($idPrat);
            return json_encode($praticien); 
        }
        
        public function addRdv($data){
            $model = new NorthHealthContext();
            $praticien = $model->getPraticienPerId($data['praticien']);
            $status = $model->addRdv($data);
            if($status == TRUE){
                // TODO: Envoie d'une synthése du RDV pour le patient...

                $this->sendEmailConfirmationRDV($data, $praticien);
                setcookie("INSERTION_RDV", "OK", time()+20);
            }else{
                setcookie("INSERTION_RDV", "KO", time()+20);
            }
            header("Location: ".SERVER."rendez-vous");
            exit;
        }

        public function getNextRdv($idPatient){
            $model = new NorthHealthContext();
            $nextRdv = $model->nextRdv($idPatient);
            define("NEXT_RDV", $nextRdv);
        }

        public function getPreviousRdv($idPatient){
            $model = new NorthHealthContext();
            $previousRDV = $model->previousRdv($idPatient);
            define("PREVIOUS_RDV", $previousRDV);
        }

        public function sendEmailConfirmationRDV($data, $praticien){
            // Destinataire et sujet du message
            $from = "hamzaessamami97@gmail.com";
            $to = "hamza.essamami.sio@gmail.com";
            $subject = "NORTH HEALTH / Confirmation de votre RDV";
            // {
            //     "ville": "75001",
            //     "typeexam": "ACE - Antigène Carcino Embryonnaire - sérum",
            //     "typeetab": "1001",
            //     "praticien": "2",
            //     "creneau": "2023-04-04 09:30:00",
            //     "idPatient": "9"
            //   }
            // Corps du message en HTML avec du CSS dans le header
            $message = "
            <html>
            <head>
            <title>Confirmation RDV n°</title>
            <style>
                h1 {
                color: #333;
                font-size: 24px;
                text-align: center;
                }
                p {
                font-size: 16px;
                line-height: 1.5;
                margin-bottom: 20px;
                }
                ul {
                list-style: none;
                margin: 0;
                padding: 0;
                }
                li {
                margin-bottom: 10px;
                }
            </style>
            </head>
            <body>
            <h1>Veuillez consulter la synthése de votre RDV</h1>
            <p>Informations du RDV :</p>
            <ul>
                <li><b>Type Examen:</b> ".$data['typeexam']."</li>
                <li><b>Date RDV:</b> ".$data['creneau']."</li>
                <li><b>Praticien:</b> ".$praticien['nomSpecialiste']." ".$praticien['prenomSpecialiste']."</li>
            </ul>
            </body>
            </html>
            ";

            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();


            
            // Envoi du message
            return mail($to, $subject, $message, $headers);

        }
        
    }