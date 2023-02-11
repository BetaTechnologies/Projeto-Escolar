<?php

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if(isset($_SESSION['permission']) && $_SESSION['permission'] != 'professor') {
        hd();
    }
    
?>
<html lang="pt-br">
<head>
    <title>Professor</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/gerenciamento.css">
</head>
<body class="professor">

    <?php require_once '../app/views/menu/nav.php'; ?>  
    
    <main>
        <aside>
            <ul>
                <li class="sel" onclick="OpenWindow(1)">Faltas</li>
                <li onclick="OpenWindow(2)">Notas</li>
            </ul>
        </aside>

        <section>
            <!-- Gerenciar faltas -->
            <div class="faltas">
                <h2>Gerenciar Faltas</h2>
                <form action="">
                    <table>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Faltas</th>
                            <th>Presenças</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td><img src="assets/images/user.png" alt=""></td>
                            <td>Nome do Aluno</td>
                            <td>2</td>
                            <td>8</td>
                            <td>
                                <label for="faltou">Faltou</label>
                                <input type="radio" name="status" id="faltou">
                                <input type="radio" name="status" id="presente">
                                <label for="presente">Presente</label>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="assets/images/user.png" alt=""></td>
                            <td>Nome do Aluno</td>
                            <td>2</td>
                            <td>8</td>
                            <td>
                                <label for="faltou">Faltou</label>
                                <input type="radio" name="status" id="faltou">
                                <input type="radio" name="status" id="presente">
                                <label for="presente">Presente</label>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="assets/images/user.png" alt=""></td>
                            <td>Nome do Aluno</td>
                            <td>2</td>
                            <td>8</td>
                            <td>
                                <label for="faltou">Faltou</label>
                                <input type="radio" name="status" id="faltou">
                                <input type="radio" name="status" id="presente">
                                <label for="presente">Presente</label>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="assets/images/user.png" alt=""></td>
                            <td>Nome do Aluno</td>
                            <td>2</td>
                            <td>8</td>
                            <td>
                                <label for="faltou">Faltou</label>
                                <input type="radio" name="status" id="faltou">
                                <input type="radio" name="status" id="presente">
                                <label for="presente">Presente</label>
                            </td>
                        </tr>
                    </table>
                    <div class="inputSubmit">
                        <input type="submit" value="Salvar">
                    </div>
                </form>
            </div>

            <!-- Gerenciar notas -->
            <div class="notas hidden">
                <h2>Gerenciar Notas</h2>
            </div>
        </section>
    </main>

    <script src="assets/js/professor.js"></script>
</body>
</html>