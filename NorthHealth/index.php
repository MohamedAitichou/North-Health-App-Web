<?php
    
    // TODO: Import...
    include_once("controller/LandingController.php");
    include_once("controller/LoginController.php");
    include_once("controller/AdminController.php");
    include_once("controller/EspacePatientController.php");

    // TODO: Define...
    define("SERVER", "http://127.0.0.1/NorthHealth/");
    define("APP_NAME", "North Health");
    
    if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
        $request = str_replace("url=", "/", $_SERVER['REDIRECT_QUERY_STRING']);
    }else{
        $request = '/';
    }

    switch($request){

        case "/": 
            $controller = new LandingController("login");
            $controller->loadView();
            break;

        case "/creer-un-compte":
            $controller = new LandingController("sign-up");
            $controller->loadView();
            break;

        case "/mot-de-passe-oublie":
            $controller = new LandingController("forget-pwd");
            $controller->loadView();
            break;

        case "/traiter-donnees-iscription":
            $controller = new LandingController("sign-up");
            $controller->insertNewPatient($_POST);
            $controller->loadView();
            break;

        case "/verify-connection":
            $controller = new LoginController(null);
            $controller->verifyCredentials();
            break;

        case "/mon-espace":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new EspacePatientController("espace-personnel");
            $controller->loadView();
            break;

        case "/se-deconnecter":
            $controller = new LoginController("login");
            $controller->seDeconnecter();
            $controller->loadView();
            break;

        case "/mon-compte":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new EspacePatientController("mon-compte");
            $controller->infoPatient();
            $controller->loadView();
            break;

        case "/modifier-info-patient":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new EspacePatientController("mon-compte");
            $controller->modifierInfoPatient();
            $controller->loadView();
            break;

        case "/rendez-vous":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new EspacePatientController("rendez-vous");
            $controller->getRegion();
            $controller->loadView();
            break;
        
        // EndPoint
        case "/departement-par-region":
            $controller = new EspacePatientController(null);
            echo $controller->getDepartementParRegion($_POST['region']);
            break;

        // EndPoint
        case "/commune-par-departement":
            $controller = new EspacePatientController(null);
            echo $controller->getCommuneParDepartement($_POST['departement']);
            break;

        case "/intervetion-par-ville":
            $controller = new EspacePatientController(null);
            echo $controller->getInterventionParVille($_POST['cp']);
            break;

        case "/lieu-par-examen":
            $controller = new EspacePatientController(null);
            echo $controller->selectLieuParExamen($_POST['libelle'], $_POST['cp']);
            break; 
        case "/praticien-par-etab":
            $controller = new EspacePatientController(null);
            echo $controller->praticienParEtab($_POST['etab']);
            break;
        
        case "/creneaux-praticien":
            $controller = new EspacePatientController(null);
            echo $controller->creneauxPraticien($_POST['idPrat']);
            break;

        case "/confirmer-rdv":
            if(isset($_POST)){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $controller = new EspacePatientController("rendez-vous");
                $controller->addRdv($_POST);
                $controller->getRegion();
                $controller->loadView();
            }
            break;

        case "/mes-rendez-vous":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new EspacePatientController("mes-rendez-vous");
            $idPatient  = $_SESSION['idPatient'];
            $controller->getNextRdv($idPatient);
            $controller->getPreviousRdv($idPatient);
            $controller->loadView();
            break;
        case "/admin":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $controller = new AdminController("admin");
            $controller->loadView();

        case "/ajouter-type-exam":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new AdminController("ajout-exam");
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $controller->addExam($_POST);
            }
            
            $controller->getAllEtab();
            $controller->loadView();
            
            break;

        case "/ajouter-specialiste":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $controller = new AdminController("ajout-specialiste");
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $controller->addSpecialiste($_POST);
            }
            
            $controller->getAllSpecialite();
            $controller->getAllCommune();
            $controller->loadView();
            
            break;
        default:
            http_response_code(404);
            break;
    }