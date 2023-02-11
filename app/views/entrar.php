<?php

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if (isset($_SESSION['permission'])) {
        $permission = $_SESSION['permission'];
        hd();
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/login.css">    
</head>
<body>

    <?php require_once '../app/views/menu/nav.php'; ?>
    
    <form action="/entrar" method="post">
        <img src="assets/images/back.png" alt="" id="back" onclick="window.history.go(-1)">
        <h1>Login</h1>
        <input type="text" name="Usuario" id="" placeholder="Usuário" required>
        <div class="inputBox">
            <input type="password" name="Senha" id="pass" placeholder="Senha" required>
            <img src="assets/images/show.png" alt="" id="image">
        </div>
        <a href="/cadastro">É uma instituição de ensino e não possui login? Cadastre-se</a>
        <input type="submit" value="Entrar">
    </form>
    
    <script src="assets/js/form.js"></script>
</body>
</html>