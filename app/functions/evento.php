<?php 
    
    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if ($_SESSION['permission'] != 'aluno') {
        hd();
    }

    $verify = explode("?=", $_SERVER['REQUEST_URI']);

    if(count($verify) == 1) {
        hd("/eventos");
    } else {
        $event_id = end($verify);
    }

    if (!isset($_SESSION['school_selected'])) {
        hd("/selecionar-escola");
    } else {
        $school_selected = $_SESSION['school_selected'];
    }

    $id = $_SESSION['id'];

    $verify = $pdo->query("SELECT * FROM eventosalvo WHERE ID_aluno = '$id' AND ID_evento = '$event_id'")->fetch();
    
    if ($verify == false) {
        $insert = $pdo->query("INSERT INTO eventosalvo VALUES (null, '$id', '$event_id')");
    } 
    
    hd("/evento?=$event_id");


?>
<html lang="pt-br">
<head>
    <title><?php echo $evento['Nome']; ?></title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/eventos.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>

        <div class="cont">
            <a href="<?php echo "/evento-salvar?=" . $evento['ID']; ?>" class="salvar">
                <img src="/assets/images/save.png" alt="">
                <p>Salvar</p>
            </a>
        </div>

        <h1><?php echo $escola['Nome']; ?></h1>

        <h2 class="titulo-evento"><?php echo $evento['Nome']; ?></h2>

        <div class="apresentacao-evento">
            <div class="text">
                <h2>Descrição</h2>
                <p><?php echo $evento['Descricao']; ?></p>
            </div>
            <div class="image">
                <img src="<?php echo $evento['Imagem']; ?>" alt="">
            </div> 
            <!-- Se der tempo troco para um carrosel -->
        </div>

        <table class="situacao-evento">
            <tr>
                <th>Data de Início</th>
                <th>Data de Término</th>
                <th>Estado do Evento</th>
            </tr>
            <tr>
                <td><?php echo $dataInicio; ?></td>
                <td><?php echo $dataTermino; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
        </table>

        <div class="anuncio">
            <h2>Mais Eventos</h2>
            <table>
                <?php 
                    foreach ($eventos as $key) { 
                        $id = $key['ID'];
                        $data = explode(" ", $key['Data_inicio']);
                        $data = $data[0];
                        $data = explode("-", $data);
                        $data = $data[2] . "/" . $data[1] . "/" . $data[0];
                ?>
                    <tr onclick="openEvento(<?php echo $id; ?>)">
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
        
        function openEvento(id) {
            window.location.href = `evento?=${id}`;
        }
        
    </script>
</body>
</html>