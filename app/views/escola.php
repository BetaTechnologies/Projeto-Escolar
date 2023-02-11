<?php
    
    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if (!isset($_SESSION['school_selected'])) {
        hd("/selecionar-escola");
    }

    $school_selected = $_SESSION['school_selected'];
    $select = $pdo->query("SELECT * FROM escola WHERE ID = '$school_selected'")->fetch();
    $email = $select['Email'];
    $tel = $select['Telefone'];

    $teacher =  $pdo->query("SELECT * FROM professor WHERE ID_Escola = 1 ORDER BY ID DESC LIMIT 3")->fetchAll();

?>
<html lang="pt-br">
<head>
    <title><?php echo $select['Nome']; ?></title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/escola.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <h1><?php echo $select['Nome']; ?></h1>
        <div class="visao-geral">
            <div class="text">
                <h3>Visão Geral</h3>
                <p><?php echo $select['Descricao']; ?></p>
            </div>
            <div class="image">
                <img src="<?php echo $select['Imagem']; ?>" alt="">
            </div>
        </div>

        <div class="funcionarios">
            <div class="cargo">
                <h3>Professores</h3>
                <?php foreach ($teacher as $key) { ?>
                    <div class="func">
                        <img class="imagg" src="<?php echo $key['Imagem']; ?>" alt="">
                        <p class="name"><?php echo $key['Nome']; ?></p>
                        <p class="pipe"> | </p>
                        <p class="grad"><?php echo $key['Graduacao']; ?></p>
                    </div>
                <?php } ?>                                    
            </div>
        </div>

        <div class="faixa">
            <h2>Acompanhar rendimento do aluno</h2>
            <a href="/rendimento-escolar">Rendimento</a>
        </div>

        <div class="contato">
            <div class="card">
                <div class="title">
                    <img src="assets/images/email.png" alt="">
                    <h2>Email</h2>
                </div>
                <a href="<?php echo "mailto:$email"; ?>"><?php echo $email; ?></a>
            </div>
            <div class="card">
                <div class="title">
                    <img src="assets/images/telephone.png" alt="">
                    <h2>Telefone</h2>
                </div>
                <a href="<?php echo "tel:+55 18 $tel"; ?>"><?php echo $tel; ?></a>
            </div>
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
                        <li><a href="/entrar">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>