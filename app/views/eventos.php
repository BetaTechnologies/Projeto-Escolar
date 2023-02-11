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

    $evento = $pdo->query("SELECT * FROM evento WHERE ID_escola = '$school_selected'")->fetchAll();
    $noticia = $pdo->query("SELECT * FROM noticia WHERE ID_escola = '$school_selected'")->fetchAll();
    
?>
<html lang="pt-br">
<head>
    <title><?php echo $select['Nome']; ?> - Eventos</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/eventos.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <h1><?php echo $select['Nome']; ?></h1>

        <div class="anuncio">
            <h2>Eventos</h2>
            <table>
                <?php 
                    foreach ($evento as $key) { 
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
                <?php } ?>
            </table>
        </div>

        <div class="anuncio">
            <h2>Notícias</h2>
            <table>
                <?php 
                    foreach ($noticia as $key) {
                        $id = $key['ID'];
                        $data = explode("-", $key['Data']);
                        $data = $data[2] . "/" . $data[1] . "/" . $data[0];
                ?>
                    <tr onclick="openNoticia(<?php echo $id; ?>)">
                        <td class="data"><?php echo $data; ?></td>
                        <td class="nome-anuncio"><?php echo $key['Nome']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="contato">
            <div class="card">
                <div class="title">
                    <img src="assets/images/email.png" alt="">
                    <h1>Email</h1>
                </div>
                <a href="<?php echo "mailto:$email"; ?>"><?php echo $email; ?></a>
            </div>
            <div class="card">
                <div class="title">
                    <img src="assets/images/telephone.png" alt="">
                    <h1>Telefone</h1>
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

    <script>
        
        function openEvento(id) {
            window.location.href = `evento?=${id}`;
        }
        
        function openNoticia(id) {
            window.location.href = `noticia?=${id}`;
        }
        
    </script>

</body>
</html>