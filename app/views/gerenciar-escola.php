<?php

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    if (!isset($_SESSION['school_selected'])) {
        hd("/selecionar-escola");
    } else {
        $school_selected = $_SESSION['school_selected'];
    }

    $verify = explode("?=", $_SERVER['REQUEST_URI']);

    if (count($verify) > 1) {
        $type = end($verify);
        
        $accept  = explode("a", $type);
        $refuse  = explode("r", $type);

        if (count($accept) > 1) {
            $type = 'Ativo';
            $id = end($accept);
        } else if ($refuse > 1) {
            $type = 'Inativo';
            $id = end($refuse);
        }

        $pdo->query("UPDATE escola SET Status = '$type' WHERE ID = '$id'");
        hd("/gerenciar-escola");
    }

    $require = $pdo->query("SELECT * FROM escola WHERE Status = 'Pendente'")->fetchAll();

    $escola = $pdo->query("SELECT * FROM escola WHERE ID = '$school_selected'")->fetch();
    $city_id = $escola['ID_cidade'];
    $cidade = $pdo->query("SELECT * FROM cidade")->fetchAll();
    $turma = $pdo->query("SELECT * FROM turma")->fetchAll();

?>
<html lang="pt-br">
<head>
    <title>Administrar Escolas</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/gerenciamento.css">
</head>
<body>

    <?php require_once '../app/views/menu/nav.php'; ?>
    
    <main>
        <aside>
            <ul>
                <li class="sel" onclick="OpenWindow(1)">Escolas</li>
                <li onclick="OpenWindow(2)">Eventos e Notícias</li>
                <li onclick="OpenWindow(3)">Alunos e Docentes</li>
                <li onclick="OpenWindow(4)">Requisições de Cadastro</li>
            </ul>
        </aside>

        <section>
            <!-- Gerenciar Escolas -->
            <div class="escolas">
                <h2>Gerenciar Escola</h2>
                <form action="/gerenciar-escola-function" method="post">
                    <div class="txtBox">
                        <label for="schoolEmail">Email da instituição</label>
                        <input type="email" name="schoolEmail" id="schoolEmail" value="<?php echo $escola['Email']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="schoolName">Nome da instituição</label>
                        <input type="text" name="schoolName" id="schoolName" value="<?php echo $escola['Nome']; ?>">
                    </div>
                    <div class="txtBox">
                        <label for="responsibleName">Nome do responsável</label>
                        <input type="text" name="responsibleName" id="responsibleName" value="<?php echo $escola['Nome_responsavel']; ?>">
                    </div>
                    <div class="txtBox">
                        <label for="responsibleCpf">CPF do responsável</label>
                        <input type="text" name="responsibleCpf" id="responsibleCpf" value="<?php echo $escola['CPF_responsavel']; ?>">
                    </div>
                    <div class="txtBox">
                        <label for="schoolNumber">Número da instituição</label>
                        <input type="number" name="schoolNumber" id="schoolNumber" value="<?php echo $escola['Numero']; ?>">
                    </div>
                    <div class="txtBox">
                        <label for="SchoolCity">Cidade da instituição</label>
                        <select name="SchoolCity" id="SchoolCity">
                            <?php foreach ($cidade as $key) { ?>
                                <option value="<?php echo $key['ID']; ?>" <?=($key['ID'] == $city_id) ? 'selected' : ''?>><?php echo $key['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="txtBox">
                        <label for="SchoolDistrict">Bairro da instituição</label>
                        <input type="text" name="SchoolDistrict" id="SchoolDistrict" value="<?php echo $escola['Bairro']; ?>">
                    </div>
                    <div class="txtBox">
                        <label for="SchoolTel">Telefone da instituição</label>
                        <input type="text" name="SchoolTel" id="SchoolTel" value="<?php echo $escola['Telefone']; ?>">
                    </div>
                    <div class="submit">
                        <input type="submit" value="Atualizar">
                    </div>
                </form>
            </div>

            <!-- Eventos e Notícias -->
            <div class="eventos-noticias hidden">
                <div class="abas">
                    <div class="aba sel" onclick="OpenAba(1, 1)">Eventos</div>
                    <div class="aba" onclick="OpenAba(1, 2)">Notícias</div>
                </div>
                <div class="container">

                    <!-- Aba adicionar evento -->
                    <div class="eventos">
                        <h2>Adicionar Evento</h2>
                        <form action="/gerenciar-escola-evento" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do evento">
                            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição"></textarea>
                            <input placeholder="Data inicial" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataInicio" id="" placeholder="Data de início">
                            <input placeholder="Data término" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataTermino" id="" placeholder="Data de início">
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff" multiple>
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>
                    
                    <!-- Aba adicionar notícia -->
                    <div class="noticias hidden">
                        <h2>Adicionar Notícias</h2>
                        <form action="/gerenciar-escola-noticia" method="post">
                            <input type="text" name="nome" id="" placeholder="Nome da notícia">
                            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição"></textarea>
                            <input placeholder="Data da notícia" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataNoticia" id="" required>
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Alunos e Docentes -->
            <div class="alunos-docentes hidden">
                <div class="abas">
                    <div class="aba sel" onclick="OpenAba(2,1)">Alunos</div>
                    <div class="aba" onclick="OpenAba(2, 2)">Docentes</div>
                </div>
                <div class="container">
                    
                    <!-- Aba adicionar aluno -->
                    <div class="alunos">
                        <h2>Adicionar Aluno</h2>
                        <form action="/gerenciar-escola-aluno" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do aluno">
                            <input type="text" name="cpf" id="" placeholder="CPF do aluno">
                            <select name="turma" id="turma" required>
                                <?php foreach ($turma as $key) { ?>
                                    <option value="<?php echo $key['ID']; ?>"><?php echo $key['Sigla'] . " || " . $key['Ano']; ?></option>
                                <?php } ?>
                            </select>
                            <input placeholder="Data de nascimento" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataNascimento" id="">
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff">
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>

                    <!-- Aba adicionar Docente -->
                    <div class="docentes hidden">
                        <h2>Adicionar Docente</h2>
                        <form action="/gerenciar-escola-docente" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do docente">
                            <input type="text" name="cpf" id="" placeholder="CPF do docente">
                            <input type="text" name="graduacao" id="" placeholder="Graduação">
                            <input placeholder="Data de nascimento" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataNascimento" id="">
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff">
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Requisições de Cadastro -->
            <div class="requisicoes hidden">
                <h2>Requisições de Cadastro</h2>
                <table>
                    <tr>
                        <th>Data da requisição</th>
                        <th>Escola</th>
                        <th>Nome do responsável</th>
                        <th>Status</th>
                    </tr>
                    <?php 
                        foreach ($require as $key) { 
                            $id = $key['ID'];
                            $data = explode("-", $key['Data_cadastro']);
                            $data = $data[2] . "/" . $data[1] . "/" . $data[0];
                    ?>
                        <tr>
                            <td><?php echo $data; ?></td>
                            <td><?php echo $key['Nome']; ?></td>
                            <td><?php echo $key['Nome_responsavel']; ?></td>
                            <td>
                                <a href="<?php echo "/gerenciar-escola?=a$id"; ?>">Aceitar</a>
                                <a href="<?php echo "/gerenciar-escola?=r$id"; ?>">Recusar</a>
                            </td>
                        </tr>
                    <?php } ?>                        
                </table>
            </div>
        </section>
    </main>

    <script src="assets/js/gerenciamento.js"></script>
</body>
</html>