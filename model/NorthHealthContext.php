<?php

    // Ref Base de données...
    include(".secret/.config.php");

    class NorthHealthContext{

        private $connectionStat = null;
        private $OPTIONS = array (
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        );

        private function connectToMySQLDataBase(){
            try{
                $this->connectionStat = new PDO(DSN, USER, PWD, $this->OPTIONS);
            }catch(PDOException $e){
                throw "Error: ".$e->getMessage();
            }
        }

        public function addPatient($data){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "INSERT INTO `patient` (`nomPatient`, `prenomPatient`, `emailPatient`, `motDePasse`, `adressePatient`, `villePatient`, `cpPatient`, `dateNaissancePatient`, `numeroSecuPatient`, `photoPatient`, `medecinTraitant`) VALUES (:nom, :prenom, :email, :pwd, :adresse, :ville, :cp, :datenaissance, :numsecu, null, null)";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $row = $queryPrepared->execute($data);
                $this->connectionStat = null;
                if($row > 0){
                    return True;
                }
                return False;
            }
            return null;
        }

        public function ifUserExist($data){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `patient` WHERE `emailPatient` = :email AND `motDePasse` = :pwd";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute($data);
                $user = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($user)){
                    return $user;
                }
                return false;
            }
            return false;
        }

        public function ifAdminExist($data){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){

                unset($data['isadmin']);
                $queryString = "SELECT * FROM `admin` WHERE `login` = :email AND `pwd` = :pwd";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute($data);
                $user = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($user)){
                    return $user;
                }
                return false;
            }
            return false;
        }

        public function getInfoPatient($idPatient){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `patient` WHERE `idPatient` =:idPatient";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("idPatient"=>$idPatient));
                $infoPatient = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($infoPatient)){
                    return $infoPatient;
                }
                return false;
            }
        }

        public function modifierInfoPatient($idPatient, $data){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){

                try{
                    $data['idPatient'] = $idPatient;
                    if(isset($data['numSecu'])){
                        $queryString = "UPDATE `patient` SET `emailPatient`=:email, `adressePatient`=:adresse, `villePatient`=:ville, `cpPatient`=:cp, `numeroSecuPatient`=:numSecu WHERE `idPatient` =:idPatient";
                    }else{
                        $queryString = "UPDATE `patient` SET `emailPatient`=:email, `adressePatient`=:adresse, `villePatient`=:ville, `cpPatient`=:cp WHERE `idPatient` =:idPatient";
                    }

                    $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $queryPrepared->execute($data);
                    return true;
                }catch(PDOException $ex){
                    return false;
                }
                return false;
            }
            
        }

        public function selectAllRegion(){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT DISTINCT nomRegion FROM commune";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $regions = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($regions)){
                    return $regions;
                }
                return false;
            }
        }

        public function selectDepartementParRegion($region){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT DISTINCT nomDepartement, codeDepartement
                FROM commune
                WHERE nomRegion =:region";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("region"=>$region));
                $departement = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($departement)){
                    return $departement;
                }
                return false;
            }
        }
        
        public function selectCommuneParDepartement($departement){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT nomCommune, codePostal
                FROM commune
                WHERE nomDepartement=:departement
                ORDER BY nomCommune";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("departement"=>$departement));
                $departement = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($departement)){
                    return $departement;
                }
                return false;
            }
        }


        public function selectInterventionParVille($cp){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT ti.idTypeIntervention, ti.libelleIntervention, te.idTypeEtabilissement, te.typeEtabilissement, te.adresseEtabilissement
                FROM typeintervention ti
                INNER JOIN typeetabilissement te
                ON ti.idTypeEtabilissement = te.idTypeEtabilissement
                WHERE te.codePostalEtabilissement = :cp
                GROUP BY ti.libelleIntervention";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("cp"=>$cp));
                $intervention = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($intervention)){
                    return $intervention;
                }
                return false;
            }
        }

        public function selectLieuParExamen($libelle, $cp){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT te.idTypeEtabilissement, te.typeEtabilissement
                FROM typeintervention ti
                INNER JOIN typeetabilissement te
                ON ti.idTypeEtabilissement = te.idTypeEtabilissement
                WHERE te.codePostalEtabilissement = :cp
                AND ti.libelleIntervention = :libelle";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("cp"=>$cp, "libelle"=>$libelle));
                $lieu = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($lieu)){
                    return $lieu;
                }
                return false;
            }
        }

        public function praticienParEtab($etab){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM specialiste s INNER JOIN exercer e ON s.idSpecialite = e.idSpecialiste WHERE e.idTypeEtabilissement = :etab";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("etab"=>$etab));
                $praticien = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($praticien)){
                    return $praticien;
                }
                return false;
            }
        }
        
        public function creneauxPraticien($idPraticien) {
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT *
                FROM `creneaux`
                WHERE dateCreneau >= CURRENT_DATE
                AND idSpecialiste = :idPrat
                AND etatCreneau = 'D'";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("idPrat"=>$idPraticien));
                $creneaux = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($creneaux)){
                    return $creneaux;
                }
                return false;
            }
        }

        public function updateCreneau($creneaux, $idPraticien, $etat){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){

                try{
                    
                    $data = array("etat"=>$etat, "idPrat"=>$idPraticien, "dateCreneau"=>$creneaux);
                    $queryString = "UPDATE `creneaux` SET `etatCreneau` = :etat WHERE `idSpecialiste` = :idPrat AND `dateCreneau` = :dateCreneau";
                    $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $queryPrepared->execute($data);
                    return true;
                }catch(PDOException $ex){
                    return false;
                }
                return false;
            }
            
        }

        public function addRdv($data){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                try{
                    $queryString = "INSERT INTO `dossier` (`codeCommune`, `libelleIntervention`, `idTypeEtabilissement`, `idSpecialiste`, `creneau`, `idPatient`)
                    VALUES (:ville, :typeexam, :typeetab, :praticien, :creneau, :idPatient)";
                    $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $row = $queryPrepared->execute($data);
                    $this->connectionStat = null;
                    if($row > 0){
                        $this->updateCreneau($data["creneau"], $data["praticien"], "R");
                        return True;
                    }
                }catch(PDOException $e){
                    throw "Error: ".$e->getMessage();
                }
                
                return False;
            }
            return null;
        }

        public function nextRdv($idPatient){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT d.*, s.nomSpecialiste, s.prenomSpecialiste, s.telSpecialiste, c.nomCommune, c.codePostal, te.typeEtabilissement, te.adresseEtabilissement
                FROM dossier d
                INNER JOIN specialiste s
                ON d.idSpecialiste = s.idSpecialiste
                INNER JOIN typeetabilissement te
                ON te.idTypeEtabilissement = d.idTypeEtabilissement
                INNER JOIN commune c
                ON c.codePostal = d.codeCommune
                WHERE d.idPatient = :idPatient
                AND d.creneau > CURRENT_DATE";

                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("idPatient"=>$idPatient));
                $nextRdv = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($nextRdv)){
                    return $nextRdv;
                }
                return false;
            }
            return null;
        }


        public function previousRdv($idPatient){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT d.*, s.nomSpecialiste, s.prenomSpecialiste, s.telSpecialiste, c.nomCommune, c.codePostal, te.typeEtabilissement, te.adresseEtabilissement
                FROM dossier d
                INNER JOIN specialiste s
                ON d.idSpecialiste = s.idSpecialiste
                INNER JOIN typeetabilissement te
                ON te.idTypeEtabilissement = d.idTypeEtabilissement
                INNER JOIN commune c
                ON c.codePostal = d.codeCommune
                WHERE d.idPatient = :idPatient
                AND d.creneau <= CURRENT_DATE";

                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("idPatient"=>$idPatient));
                $nextRdv = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($nextRdv)){
                    return $nextRdv;
                }
                return false;
            }
            return null;
        }


        public function allEtab(){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `typeetabilissement`";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $nextRdv = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($nextRdv)){
                    return $nextRdv;
                }
                return false;
            }
            return null;
        }

        public function addExam($data){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "INSERT INTO `typeintervention` (`idTypeEtabilissement`, `libelleIntervention`) VALUES (:etabId, :libelleExam)";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $row = $queryPrepared->execute($data);
                $this->connectionStat = null;
                if($row > 0){
                    return True;
                }
                return False;
            }
            return null;
        }

        public function allCommune(){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `commune` ORDER BY nomCommune";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $nextRdv = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($nextRdv)){
                    return $nextRdv;
                }
                return false;
            }
            return null;
        }

        public function allSpecialite(){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `specialite` ORDER BY libelleSpecialite";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $nextRdv = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($nextRdv)){
                    return $nextRdv;
                }
                return false;
            }
            return null;
        }

        public function addSpecialiste($data){
            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "INSERT INTO `specialiste` (`nomSpecialiste`, `prenomSpecialiste`, `adresseSpecialiste`, `codePostalSpecialiste`, `telSpecialiste`, `idSpecialite`) VALUES (:nom, :prenom, :adresse, :cp, :tel, :idSp)";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $row = $queryPrepared->execute($data);
                $this->connectionStat = null;
                if($row > 0){
                    return True;
                }
                return False;
            }
            return null;
        }


        public function getPraticienPerId($id){

            $this->connectToMySQLDataBase();
            if($this->connectionStat != null){
                $queryString = "SELECT * FROM `specialiste` WHERE idspecialiste = :id";
                $queryPrepared = $this->connectionStat->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(["id"=>$id]);
                $praticien = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($praticien)){
                    return $praticien;
                }
                return false;
            }
            return null;
        }
    }