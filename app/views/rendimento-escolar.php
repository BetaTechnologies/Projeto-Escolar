<?php 
    
    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if ($_SESSION['permission'] != 'aluno') {
        hd();
    }
    
    $verify = explode("?=", $_SERVER['REQUEST_URI']);

    if (count($verify) > 1) {
        $verify = end($verify);
        $verify = $pdo->query("DELETE FROM eventosalvo WHERE ID = '$verify'");
        hd("/rendimento-escolar");
    }
    
    $id = $_SESSION['id'];
    $aluno = $pdo->query("SELECT * FROM aluno WHERE ID = '$id'")->fetch();
    $escola_id = $aluno['ID_Escola'];
    $turma_id = $aluno['ID_turma'];
    $escola = $pdo->query("SELECT * FROM escola WHERE ID = '$escola_id'")->fetch();
    $turma = $pdo->query("SELECT * FROM turma WHERE ID = '$turma_id'")->fetch();
    $eventos = $pdo->query("SELECT * FROM eventosalvo WHERE ID_aluno = '$id'")->fetchAll();

    $dataNascimento = $aluno['Data_Nascimento'];
    $dataNascimento = explode("-", $dataNascimento);
    $dataNascimento = $dataNascimento[0];

    $date = date('Y-m-d');
    $date = explode("-", $date);
    $date = $date[0];
    
    //   (*/ω＼*)   //

    $final = $date - $dataNascimento;

?>
<html lang="pt-br">
<head>
    <title>Rendimento Escolar</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/rendimento-escolar.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <img src="assets/images/back.png" alt="" id="back" onclick="window.history.go(-1)">
        <h1>Rendimento Escolar</h1>
        <div class="todasabas">
            <div class="abas">
                <div class="aba"><p>Notas</p></div>
                <div class="aba"><p>Faltas</p></div>
                <div class="aba"><p>Horários</p></div>
            </div>
            <div class="abas">
                <div class="aba sel"><p>Aluno</p></div>
            </div>
        </div>
        <div class="container">

            <div class="container-aba hidden" id="notas">
                <div class="cont">
                    <?php
                    for ($i = 0; $i < 18; $i++) {
                        echo '<div class="card">
                        <h2>MeteriaEx</h2>
                        <p>NOTA: 2</p>
                        </div>';
                    }                 
                    ?>           
                </div>
            </div>

            <div class="container-aba hidden" id="faltas">
                <div class="cont">
                    <?php
                    for ($i = 0; $i < 18; $i++) {
                        echo '<div class="card">
                        <h2>MeteriaEx</h2>
                        <p>Faltas: 2</p>
                        </div>';
                    }                 
                    ?>           
                </div>
            </div>

            <div class="container-aba hidden" id="horarios">
                <div class="cont">
                    <h1>Horarios</h1>
                    <img src="../images/horario_ads_2sem_2022_page-0001.jpg" alt="">
                    <a href="../images/horario_ads_2sem_2022_page-0001.jpg" download="">Download</a>
                </div>
            </div>
            
            <div class="container-aba" id="aluno">
                <div class="infos">
                    <div class="foto">
                        <img src="<?php echo $aluno['Imagem']; ?>" alt="">
                    </div>
                    <div class="infoAluno">
                        <p>Aluno: <span><?php echo $aluno['Nome']; ?></span></p>
                        <p>Escola: <span><?php echo $escola['Nome']; ?></span></p>
                        <p>Ano: <span><?php echo $turma['Ano']; ?></span></p>
                        <p>Idade: <span><?php echo $final; ?></span></p>
                    </div>
                </div>
                <div class="container-info-alunos">
                <h2>Eventos Salvos</h2>
                    <table>
                        <tr>
                            <th>Data início</th>
                            <th>Data Término</th>
                            <th>Nome</th>
                            <th>Ações</th>
                            <th>Estado do Evento</th>
                        </tr>
                        <?php
                            foreach ($eventos as $key) {
                                $save_id = $key['ID'];
                                $event_id = $key['ID_evento'];

                                $evento = $pdo->query("SELECT * FROM evento WHERE ID = '$event_id'")->fetch();

                                $dataInicio = explode(" ", $evento['Data_inicio']);
                                $dataInicio = $dataInicio[0];
                                $dataInicioStrtotime = strtotime($dataInicio);
                                $dataInicio = explode("-", $dataInicio);
                                $dataInicio = $dataInicio[2] . "/" . $dataInicio[1] . "/" . $dataInicio[0];

                                $dataTermino = explode(" ", $evento['Data_termino']);
                                $dataTermino = $dataTermino[0];
                                $dataTerminoStrtotime = strtotime($dataTermino);
                                $dataTermino = explode("-", $dataTermino);
                                $dataTermino = $dataTermino[2] . "/" . $dataTermino[1] . "/" . $dataTermino[0];

                                $dataAtualStrtotime = strtotime("now");

                                $verifyBeg = $dataInicioStrtotime - $dataAtualStrtotime;
                                $verifyEnd = $dataTerminoStrtotime - $dataAtualStrtotime;

                                if ($verifyBeg <= 0 && $verifyEnd <= 0) {
                                    $status = "Finalizado";
                                } else if ($verifyBeg <= 0 && $verifyEnd > 0) {
                                    $status = "Andamento";
                                } else {
                                    $status = "Em breve";
                                } 
                                
                        ?>
                                <tr>
                                    <td><?php echo $dataInicio; ?></td>
                                    <td><?php echo $dataTermino; ?></td>
                                    <td><?php echo $evento['Nome']; ?></td>
                                    <td><a href="<?php echo "/rendimento-escolar?=$save_id"; ?>">Excluir</a></td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                        <?php } ?>                
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/rendimento.js"></script>
</body>
</html>