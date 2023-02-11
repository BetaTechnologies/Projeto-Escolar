<?php 

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $schoolEmail = $_POST['schoolEmail'];
    $schoolName = $_POST['schoolName'];
    $responsibleName = $_POST['responsibleName'];
    $responsibleCpf = $_POST['responsibleCpf'];
    $schoolNumber = $_POST['schoolNumber'];
    $SchoolCity = $_POST['SchoolCity'];
    $SchoolStreet = $_POST['SchoolStreet'];
    $SchoolDistrict = $_POST['SchoolDistrict'];
    $SchoolTel = $_POST['SchoolTel'];
    $descricao = $_POST['descricao'];

    $Usuario = $_POST['Usuario'];
    $Senha = $_POST['Senha'];

    $diretorio = "assets/banco/escola/";
    $uniquid = uniqid();
    $extension = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $final = $diretorio . $uniquid . "." . $extension;
    $upload = move_uploaded_file($_FILES["imagem"]["tmp_name"], $final);

    $update = $pdo->prepare("INSERT INTO escola VALUES (:ID, :ID_cidade, :Email, :Telefone, :Nome, :Bairro, :Rua, :Numero, :Imagem, :CPF_responsavel, :Nome_responsavel, :Descricao, :Usuario, :Senha, :Data_cadastro, :Status)");
    $update = $update->execute(array(
        'ID' => null,
        'ID_cidade' => $SchoolCity,
        'Email' => $schoolEmail,
        'Telefone' => $SchoolTel,
        'Nome' => $schoolName,
        'Bairro' => $SchoolDistrict,
        'Rua' => $SchoolStreet,
        'Numero' => $schoolNumber,
        'Imagem' => "/$final",
        'CPF_responsavel' => $responsibleCpf,
        'Nome_responsavel' => $responsibleName,
        'Descricao' => $descricao,
        'Usuario' => $Usuario,
        'Senha' => $Senha,
        'Data_cadastro' => date("Y-m-d"),
        'Status' => 'Pendente')
    );

    hd("/cadastro");