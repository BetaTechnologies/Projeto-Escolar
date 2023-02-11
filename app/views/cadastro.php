<?php 

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $city = $pdo->query("SELECT * FROM cidade")->fetchAll();

?>
<html lang="pt-br">
<head>
    <title>Cadastro</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/cadastro.css">
</head>
<body>
    
    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <img src="assets/images/back.png" alt="" id="back" onclick="window.history.go(-1)">
        <h1>Cadastro</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="campos">
                <div class="container">
                    <input type="email" name="schoolEmail" id="" placeholder="Email da instituição" required>
                    <input type="text" name="schoolName" id="" placeholder="Nome da instituição" required>
                    <input type="text" name="responsibleName" id="" placeholder="Nome do responsável" required>
                    <input type="text" name="responsibleCpf" id="" placeholder="CPF do responsável" required>
                    <select name="SchoolCity" id="SchoolCity">
                        <?php foreach ($city as $key) { ?>
                            <option value="<?php echo $key['ID']; ?>"><?php echo $key['nome']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="SchoolStreet" id="" placeholder="Rua da instituição" required>
                    <input type="text" name="SchoolDistrict" id="" placeholder="Bairro da instituição" required>
                    <input type="number" name="schoolNumber" id="" placeholder="Número da instituição" required>
                    <input type="text" name="SchoolTel" id="" placeholder="Telefone da instituição" required>
                    <textarea name="descricao" id="" cols="30" rows="10" placeholder="Visão Geral da instituição" required></textarea>
                    <input type="file" name="imagem" src="" alt="" accept=".jpg, .png, .jfif, .jpeg, .tiff" required>
                </div>
                <div class="container">
                    <input type="text" name="Usuario" id="" placeholder="Usuário" required>
                    <div class="inputBox">
                        <input type="password" name="Senha" id="pass" placeholder="Senha">
                        <img src="assets/images/show.png" alt="" id="image">
                    </div>
                    <div class="inputBox">
                        <input type="password" name="Senha" id="pass1" placeholder="Repete senha">
                        <img src="assets/images/show.png" alt=""  id="image1">
                    </div>
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </main>

    <script src="assets/js/form.js"></script>
</body>
</html>