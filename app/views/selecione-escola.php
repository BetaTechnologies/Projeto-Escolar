<?php  
    
    require_once '../vendor/autoload.php';
    require_once '../app/config/settings.php';

    $select = $pdo->query("SELECT * FROM escola WHERE Status = 'Ativo'")->fetchAll();

    if (isset($_POST['school_selected'])) {
        $school_selected = $_POST['school_selected'];
        $_SESSION['school_selected'] = $school_selected;
        hd("/escola");
    }

?>
<html lang="pt-br">
<head>
    <title>Beta</title>
    <?php require_once '../app/views/menu/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/not-found.css">
</head>
<body>

    <?php require_once '../app/views/menu/nav.php'; ?>

    <main>
        <h1>Nenhuma escola selecionada!</h1>
        <form action="" method="post">
            <select name="school_selected" id="school">
                <option disabled selected>Escolha uma escola</option>
                <?php foreach ($select as $key) { ?>
                    <option value="<?php echo $key['ID']; ?>"><?php echo $key['Nome']; ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Avançar">
        </form>
    </main>

</body>
</html>