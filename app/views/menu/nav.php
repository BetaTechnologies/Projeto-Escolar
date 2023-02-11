<nav>
    <a href="/">Beta</a>
    <ul>
        <li><a href="/selecionar-escola">Escolas</a></li>
        <li><a href="/eventos">Eventos</a></li>

        <?php if (isset($_SESSION['permission']) && $_SESSION['permission'] == 'aluno') { ?>
            <li><a href="/rendimento-escolar">Perfil</a></li>
        <?php } ?>

        <?php if (isset($_SESSION['permission']) && $_SESSION['permission'] == 'professor') { ?>
            <li><a href="/professor">Professor</a></li>
        <?php } ?>
        
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
            <li><a href="/sair">Sair</a></li>
        <?php } else { ?>
            <li><a href="/entrar">Login</a></li>
        <?php } ?>
    </ul>
</nav>