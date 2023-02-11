<?php 

    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $type = explode("-", $_SERVER['REQUEST_URI']);
    $dir = $type[0];
    $type = end($type);

    $school_selected = $_SESSION['school_selected'];

    if ($type == 'function') {
        $schoolEmail = $_POST['schoolEmail'];
        $schoolName = $_POST['schoolName'];
        $responsibleName = $_POST['responsibleName'];
        $responsibleCpf = $_POST['responsibleCpf'];
        $schoolNumber = $_POST['schoolNumber'];
        $SchoolCity = $_POST['SchoolCity'];
        $SchoolDistrict = $_POST['SchoolDistrict'];
        $SchoolTel = $_POST['SchoolTel'];

        $update = $pdo->prepare("UPDATE escola SET ID_cidade = :ID_cidade, Email = :Email, Telefone = :Telefone, Nome = :Nome, Bairro = :Bairro, Numero = :Numero, CPF_responsavel = :CPF_responsavel, Nome_responsavel = :Nome_responsavel WHERE ID = :ID");
        $update = $update->execute(array(
            'ID_cidade' => $SchoolCity,
            'Email' => $schoolEmail,
            'Telefone' => $SchoolTel,
            'Nome' => $schoolName,
            'Bairro' => $SchoolDistrict,
            'Numero' => $schoolNumber,
            'CPF_responsavel' => $responsibleCpf,
            'Nome_responsavel' => $responsibleName,
            'ID' => $school_selected)
        );
    } else if ($type == 'evento') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $dataInicio = $_POST['dataInicio'];
        $dataTermino = $_POST['dataTermino'];
        
        $diretorio = "assets/banco/evento/";
        $uniquid = uniqid();
        $extension = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $final = $diretorio . $uniquid . "." . $extension;
        $upload = move_uploaded_file($_FILES["imagem"]["tmp_name"], $final);

        $insert = $pdo->prepare("INSERT INTO evento VALUES (:ID, :ID_escola, :Nome, :Data_inicio, :Data_termino, :Descricao, :Imagem)");
        $insert = $insert->execute(array(
            'ID' => null,
            'ID_escola' => $school_selected,
            'Nome' => $nome,
            'Data_inicio' => $dataInicio,
            'Data_termino' => $dataTermino,
            'Descricao' => $descricao,
            'Imagem' => "/$final")
        );
    } else if ($type == 'noticia') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $dataNoticia = $_POST['dataNoticia'];
        
        $insert = $pdo->prepare("INSERT INTO noticia VALUES (:ID, :ID_escola, :Nome, :Descricao, :DataNoticia)");
        $insert = $insert->execute(array(
            'ID' => null,
            'ID_escola' => $school_selected,
            'Nome' => $nome,
            'Descricao' => $descricao,
            'DataNoticia' => $dataNoticia)
        );
    } else if ($type == 'aluno') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $turma = $_POST['turma'];
        $dataNascimento = $_POST['dataNascimento'];

        $diretorio = "assets/banco/aluno/";
        $uniquid = uniqid();
        $extension = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $final = $diretorio . $uniquid . "." . $extension;
        $upload = move_uploaded_file($_FILES["imagem"]["tmp_name"], $final);

        $insert = $pdo->prepare("INSERT INTO aluno VALUES (:ID, :ID_Escola, :CPF, :Nome, :Imagem, :ID_turma, :Data_Nascimento)");
        $insert = $insert->execute(array(
            'ID' => null,
            'ID_Escola' => $school_selected,
            'CPF' => $cpf,
            'Nome' => $nome,
            'Imagem' => "/$final",
            'ID_turma' => $turma,
            'Data_Nascimento' => $dataNascimento)
        );
    } else if ($type == 'docente') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $graduacao = $_POST['graduacao'];
        $dataNascimento = $_POST['dataNascimento'];

        $diretorio = "assets/banco/professor/";
        $uniquid = uniqid();
        $extension = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $final = $diretorio . $uniquid . "." . $extension;
        $upload = move_uploaded_file($_FILES["imagem"]["tmp_name"], $final);

        $insert = $pdo->prepare("INSERT INTO professor VALUES (:ID, :ID_Escola, :Nome, :CPF, :Graduacao, :Imagem, :Data_nascimento)");
        $insert = $insert->execute(array(
            'ID' => null,
            'ID_Escola' => $school_selected,
            'Nome' => $nome,
            'CPF' => $cpf,
            'Graduacao' => $graduacao,
            'Imagem' => "/$final",
            'Data_nascimento' => $dataNascimento)
        );
    }

    hd("$dir-escola");