<?php
	
	//Inicio da sessão
	session_start();

	//Autoload
	require "../vendor/autoload.php";

	//Slim
    use Slim\App;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use app\middlewares\HomeMiddleware;

    $config['displayErrorDetails'] = true;
	
	$app = new App(['settings' => $config]);
	
	//HomeController
	$app->get('/','app\controllers\HomeController:principal');
	$app->get('/entrar', 'app\controllers\HomeController:entrar');
	$app->post('/entrar', 'app\controllers\HomeController:entrarFunction');
	$app->get('/sair', 'app\controllers\HomeController:sair');

	//SchoolController
	$app->get('/administrador-escola', 'app\controllers\SchoolController:administradorEscola');
	$app->post('/administrador-escola-{type}', 'app\controllers\SchoolController:administradorEscolaFunction');

	$app->get('/cadastro', 'app\controllers\SchoolController:cadastro');
	$app->post('/cadastro', 'app\controllers\SchoolController:cadastroFunction');

	$app->get('/escola', 'app\controllers\SchoolController:escola');
	$app->get('/eventos', 'app\controllers\SchoolController:eventos');
	$app->get('/evento', 'app\controllers\SchoolController:evento');
	$app->get('/evento-salvar', 'app\controllers\SchoolController:eventoFunction');
	$app->get('/noticia', 'app\controllers\SchoolController:noticia');

	$app->get('/gerenciar-escola', 'app\controllers\SchoolController:gerenciarEscola');
	$app->post('/gerenciar-escola-{type}', 'app\controllers\SchoolController:gerenciarEscolaFunction');

	$app->get('/professor', 'app\controllers\SchoolController:professor');
	$app->get('/rendimento-escolar', 'app\controllers\SchoolController:rendimentoEscolar');
	
	$app->get('/selecionar-escola', 'app\controllers\SchoolController:selecionarEscola');
	$app->post('/selecionar-escola', 'app\controllers\SchoolController:selecionarEscola');
	
	$app->run();