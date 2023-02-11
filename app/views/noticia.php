<?php 
    
    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $verify = explode("?=", $_SERVER['REQUEST_URI']);

    if(count($verify) == 1) {
        hd("/eventos");
    } else {
        $notice_id = end($verify);
    }

    if (!isset($_SESSION['school_selected'])) {
        hd("/selecionar-escola");
    } else {
        $school_selected = $_SESSION['school_selected'];
    }

    $escola = $pdo->query("SELECT * FROM escola WHERE ID = '$school_selected'")->fetch();
    $noticia = $pdo->query("SELECT * FROM noticia WHERE ID = '$notice_id'")->fetch();

    $data = explode("-", $noticia['Data']);
    $data = $data[2] . "/" . $data[1] . "/" . $data[0];

    $noticias = $pdo->query("SELECT * FROM noticia WHERE ID_escola = '$school_selected'")->fetchAll();

?>
<html lang="pt-br">
<head>
    <title><?php echo $noticia['Nome']; ?></title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/eventos.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <h1><?php echo $escola['Nome']; ?></h1>

        <h2 class="titulo-evento"><?php echo $noticia['Nome']; ?></h2>

        <div class="apresentacao-evento">
            <div class="text">
                <h2>Descrição</h2>
                <p><?php echo $noticia['Descricao']; ?></p>
            </div>
        </div>

        <table class="situacao-evento">
            <tr>
                <th>Data de Publicação</th>
            </tr>
            <tr>
                <td><?php echo $data; ?></td>
            </tr>
        </table>

        <div class="anuncio">
            <h2>Mais Notícias</h2>
            <table>
                <?php 
                    foreach ($noticias as $key) { 
                        $id = $key['ID'];
                        $data = explode("-", $key['Data']);
                        $data = $data[2] . "/" . $data[1] . "/" . $data[0];
                ?>
                    <tr onclick="openNoticia(<?php echo $id; ?>)">
                        <td class="data"><?php echo $data; ?></td>
                        <td class="nome-anuncio"><?php echo $key['Nome']; ?></td>
                    </tr>
                <?php }?>            
            </table>
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
    
    <script>
        
        function openNoticia(id) {
            window.location.href = `noticia?=${id}`;
        }
        
    </script>

</body>
</html>