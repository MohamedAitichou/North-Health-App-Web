<?php


    class LoginController{

        private $view;

        public function __construct($view)
        {
            $this->view = $view;
        } 

        public function loadView(){

            require_once("vue\\".$this->view.".php");
        }

        public function verifyCredentials(){
            //TODO: Call Method to check if credntials are recognized...
            $context = new NorthHealthContext();
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
                session_unset();
            }
            
            if(isset($_POST["isadmin"]) && $_POST["isadmin"] == "on"){
                $user = $context->ifAdminExist($_POST);
            }else{
                $user = $context->ifUserExist($_POST);
            }
            
            if($user == True){
                //TODO: User identified...
                session_start();
                $_SESSION["SESSION_ID"] = bin2hex(random_bytes(16));
                foreach($user as $key => $value){
                    $_SESSION[$key] = $value;
                }
                if(isset($_POST["isadmin"]) && $_POST["isadmin"] == "on"){
                    header("Location: ".SERVER."admin");
                    exit;
                }
                header("Location: ".SERVER."mon-espace");
                exit;
            }else{
                //TODO: User dosen't exists...
                setcookie("CONNECTION", "KO", time() + 60);
                header("Location: ".SERVER);
                exit;
            }
        }

        public function seDeconnecter(){

            unset($_SESSION);
            session_unset();
            header("Location: ".SERVER);
            exit;
        }
    }