<?php

    namespace app\controllers;

    class HomeController
    {

        public function principal(){
            include '../app/views/principal.php';
        }

        public function entrar(){
            include '../app/views/entrar.php';
        }
        
        public function entrarFunction(){
            include '../app/functions/entrar.php';
        }

        public function sair(){
            include '../app/functions/sair.php';
        }

    }

