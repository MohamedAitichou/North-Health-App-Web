<?php

    include("model/NorthHealthContext.php");
    class LandingController{

        private $view;

        public function __construct($view)
        {
            $this->view = $view;
        } 

        public function loadView(){

            require_once("vue\\".$this->view.".php");
        }

        public function insertNewPatient($data){

            $model = new NorthHealthContext();
            $insertStat = $model->addPatient($data);
            if($insertStat){
                setcookie("INSERTION", "OK", time() + (10000));
            }else{
                setcookie("INSERTION", "KO", time() + (10000));
            }

            header("Location: ".SERVER."creer-un-compte");
            exit;
        }
    }