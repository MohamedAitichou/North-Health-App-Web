<?php


    class AdminController{

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

        public function getAllEtab(){
            $model = new NorthHealthContext();
            define("ETAB", $model->allEtab());
        }

        public function addExam($data){
            $model = new NorthHealthContext();
            $stat = $model->addExam($data);
            if($stat){
                setcookie("INSERTION_EXAM", "OK", time()+20);
            }else{
                setcookie("INSERTION_EXAM", "KO", time()+20);
            }

            header("Location: ".SERVER."ajouter-type-exam");
            exit;
        }

        public function addSpecialiste($data){
            $model = new NorthHealthContext();
            $stat = $model->addSpecialiste($data);
            if($stat){
                setcookie("INSERTION_SP", "OK", time()+20);
            }else{
                setcookie("INSERTION_SP", "KO", time()+20);
            }

            header("Location: ".SERVER."ajouter-specialiste");
            exit;
        }
        public function getAllSpecialite(){
            $model = new NorthHealthContext();
            define("SPECIALITE", $model->allSpecialite());
        }

        public function getAllCommune(){
            $model = new NorthHealthContext();
            define("COMMUNE", $model->allCommune());
        }
        
    }