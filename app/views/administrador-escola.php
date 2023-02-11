<?php 

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $school = $_SESSION['school'];
    $select = $pdo->query("SELECT * FROM escola WHERE ID = '$school'")->fetch();

    $city_id = $select['ID_cidade'];
    $city = $pdo->query("SELECT * FROM cidade")->fetchAll();

    $turma = $pdo->query("SELECT * FROM turma")->fetchAll();

?>
<html lang="pt-br">
<head>
    <title>Adm - <?php echo $select['Nome']; ?></title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/gerenciamento.css">
</head>
<body class="adm-escola">

    <?php require_once '../app/views/menu/nav.php'; ?>
    
    <main>
        <aside>
            <ul>
                <li class="sel" onclick="OpenWindow(1, true)">Escola</li>
                <li onclick="OpenWindow(2, true)">Eventos e Notícias</li>
                <li onclick="OpenWindow(3, true)">Alunos e Docentes</li>
            </ul>
        </aside>

        <section>
            <!-- Gerenciar Escolas -->
            <div class="escolas">
                <h2>Gerenciar Escola</h2>
               
                <form action="/administrador-escola-function" method="post">
                    <div class="txtBox">
                        <label for="schoolEmail">Email da instituição</label>
                        <input type="email" name="schoolEmail" id="schoolEmail" value="<?php echo $select['Email']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="schoolName">Nome da instituição</label>
                        <input type="text" name="schoolName" id="schoolName" value="<?php echo $select['Nome']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="responsibleName">Nome do responsável</label>
                        <input type="text" name="responsibleName" id="responsibleName" value="<?php echo $select['Nome_responsavel']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="responsibleCpf">CPF do responsável</label>
                        <input type="text" name="responsibleCpf" id="responsibleCpf" value="<?php echo $select['CPF_responsavel']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="schoolNumber">Número da instituição</label>
                        <input type="number" name="schoolNumber" id="schoolNumber" value="<?php echo $select['Numero']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="SchoolCity">Cidade da instituição</label>
                        <select name="SchoolCity" id="SchoolCity">
                            <?php foreach ($city as $key) { ?>
                                <option value="<?php echo $key['ID']; ?>" <?=($key['ID'] == $city_id) ? 'selected' : ''?>><?php echo $key['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="txtBox">
                        <label for="SchoolDistrict">Bairro da instituição</label>
                        <input type="text" name="SchoolDistrict" id="SchoolDistrict" value="<?php echo $select['Bairro']; ?>" required>
                    </div>
                    <div class="txtBox">
                        <label for="SchoolTel">Telefone da instituição</label>
                        <input type="text" name="SchoolTel" id="SchoolTel" value="<?php echo $select['Telefone']; ?>" required>
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

                        <form action="/administrador-escola-evento" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do evento" required>
                            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição" required></textarea>
                            <input placeholder="Data inicial" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataInicio" id="" placeholder="Data de início" required>
                            <input placeholder="Data término" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataTermino" id="" placeholder="Data de término" required>
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff" required>
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>
                    
                    <!-- Aba adicionar notícia -->
                    <div class="noticias hidden">
                        <h2>Adicionar Notícias</h2>

                        <form action="/administrador-escola-noticia" method="post">
                            <input type="text" name="nome" id="" placeholder="Nome da notícia" required>
                            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição" required></textarea>
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

                        <form action="/administrador-escola-aluno" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do aluno" required>
                            <input type="text" name="cpf" id="" placeholder="CPF do aluno" required>
                            <select name="turma" id="turma" required>
                                <?php foreach ($turma as $key) { ?>
                                    <option value="<?php echo $key['ID']; ?>" <?=($key['ID'] == $city_id) ? 'selected' : ''?>><?php echo $key['Sigla'] . " || " . $key['Ano']; ?></option>
                                <?php } ?>
                            </select>
                            <input placeholder="Data de nascimento" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataNascimento" id="" required>
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff" required>
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>

                    <!-- Aba adicionar Docente -->
                    <div class="docentes hidden">
                        <h2>Adicionar Docente</h2>

                        <form action="/administrador-escola-docente" method="post" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome do docente" required>
                            <input type="text" name="cpf" id="" placeholder="CPF do docente" required>
                            <input type="text" name="graduacao" id="" placeholder="Graduação" required>
                            <input placeholder="Data de nascimento" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dataNascimento" id="" required>
                            <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff" required>
                            <input type="submit" value="Adicionar">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/gerenciamento.js"></script>
</body>
</html>