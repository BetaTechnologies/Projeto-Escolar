<?php

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if (isset($_SESSION['school'])) {
        $school = $_SESSION['school'];
    }

    if (isset($_SESSION['permission'])) {
        $permission = $_SESSION['permission'];
    }

?>
<html lang="pt-br">
<head>
    <title>Beta</title>
    <?php require_once '../app/views/menu/head.php'; ?>
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <div class="carousel">
        <div class="slides">

            <div class="chevrons">
                <ion-icon name="chevron-back-outline" onclick="next(-1)"></ion-icon>
                <ion-icon name="chevron-forward-outline" onclick="next(1)"></ion-icon>
            </div>

            <div class="image">   
                <img class="carrousel-image" src="/assets/images/img-carousel-1.png" alt="">
            </div>
            <div class="image">
                <img class="carrousel-image" src="/assets/images/img-carousel-2.png" alt="">
            </div>
            <div class="image">
                <img class="carrousel-image" src="/assets/images/img-carousel-3.png" alt="">
            </div>

            <div class="bolls"></div>
        </div>
    </div>

    <main>
        <div class="text">
            <div class="title">
                <img src="/assets/images/search.png" alt="">
                <h1>Visão Geral</h1>
            </div>
            <p>O Beta é um site onde é possível os alunos verem seus rendimentos escolares sendo notas e faltas, visualizar os horários de aulas e seu perfil de estudante, os professores serão capazes de realizar chamadas e dar notas para os alunos e as escolas poderão gerenciar tanto os alunos quantos os professores, alem de poderem adicionar eventos e noticias.
Sua função principal é ser capaz de gerenciar todo o meio estudantil de maneira rápida e facil, tornando tudo mais simples e mais comunicativo.</p>
        </div>
        <div class="image">
            <img src="/assets/images/logo.png" alt="Logo Beta">
        </div>
    </main>

    <footer>
        <h1>Beta</h1>
        <div class="links">
            <div class="footerContainer">
                <h2>Contato</h2>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                </ul>
            </div>
            <div class="footerContainer">
                <h2>Opções</h2>
                <ul>
                    <li><a href="/selecionar-escola">Escolas</a></li>
                    <li><a href="/eventos">Eventos</a></li>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
                        <li><a href="/sair">Sair</a></li>
                    <?php } else { ?>
                        <li><a href="/entrar">Entrar</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/carousel.js"></script>
</body>
</html>