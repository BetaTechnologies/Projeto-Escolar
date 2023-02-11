<?php

    namespace app\controllers;

    class SchoolController
    {

        public function administradorEscola(){
            include '../app/views/administrador-escola.php';
        }

        public function administradorEscolaFunction(){
            include '../app/functions/escola-function.php';
        }

        public function cadastro(){
            include '../app/views/cadastro.php';
        }

        public function cadastroFunction(){
            include '../app/functions/cadastro.php';
        }

        public function escola(){
            include '../app/views/escola.php';
        }

        public function eventos(){
            include '../app/views/eventos.php';
        }

        public function evento(){
            include '../app/views/evento.php';
        }

        public function eventoFunction(){
            include '../app/functions/evento.php';
        }

        public function noticia(){
            include '../app/views/noticia.php';
        }

        public function gerenciarEscola(){
            include '../app/views/gerenciar-escola.php';
        }

        public function gerenciarEscolaFunction(){
            include '../app/functions/escola-function.php';
        }

        public function professor(){
            include '../app/views/professor.php';
        }

        public function rendimentoEscolar(){
            include '../app/views/rendimento-escolar.php';
        }

        public function selecionarEscola(){
            include '../app/views/selecione-escola.php';
        } 

    }

