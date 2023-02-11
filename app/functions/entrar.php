<?php

    require '../vendor/autoload.php';
    require '../app/config/settings.php';

    $Usuario = $_POST['Usuario'];
    $Senha = $_POST['Senha'];

    //Validation
    $verify = $pdo->prepare("SELECT * FROM escola WHERE Usuario = :Usuario AND Senha = :Senha");
    $verify->execute(array(
        'Usuario' => $Usuario, 
        'Senha' => $Senha)
    );

    $student = $pdo->prepare("SELECT * FROM aluno WHERE CPF = :Usuario");
    $student->execute(array(
        'Usuario' => $Usuario)
    );

    $teacher = $pdo->prepare("SELECT * FROM professor WHERE CPF = :Usuario");
    $teacher->execute(array(
        'Usuario' => $Usuario)
    );

    //Session Validation
    if ($verify->rowCount() >= 1) {
        $verify = $verify->fetch();
        $_SESSION['login'] = true;
        $_SESSION['school'] = $verify['ID'];
        $_SESSION['permission'] = 'escola';
        hd();
    } else if ($teacher->rowCount() >= 1){ 
        $teacher = $teacher->fetch();
        $date = explode('-', $teacher['Data_nascimento']);
        $date = $date[2] . $date[1] . $date[0];

        if ($date != $Senha) {
            hd("/entrar");
        }

        $_SESSION['login'] = true;
        $_SESSION['permission'] = 'professor';
        hd();
    } else if ($student->rowCount() >= 1){ 
        $student = $student->fetch();
        $date = explode('-', $student['Data_Nascimento']);
        $date = $date[2] . $date[1] . $date[0];

        if ($date != $Senha) {
            hd("/entrar");
        }

        $_SESSION['login'] = true;
        $_SESSION['id'] = $student['ID'];
        $_SESSION['permission'] = 'aluno';
        hd();
    } else { 
        $_SESSION['login'] = false;
        hd("/entrar");
    }

