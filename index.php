<?php
header('Access-Control-Allow-Origin: *');
include 'autoload.php';
include 'mvc/models/mutil.php';
include 'mvc/models/mbd.php';

$app = new Aplicacao;

// Middewares
// Autenticação

// Adicionando rotas
include 'routes/all.php';

$app->setRota();

if (!isSet($app->rota)) {
	$infoRota = $app->hide400 ? '' : 'Rota não encontrada';
	$app->response(400, $infoRota);
}

if (!file_exists('mvc/controls/c' . $app->rotasol . '.php')) {
	$infoControl = $app->hide400 ? '' : 'Controlador[c' . $app->rotasol.'] não encontrado';
	$app->response(400,  $infoControl);
}

include 'mvc/controls/c' . $app->rotasol . '.php';

if (!function_exists($app->rota->funcao)) {
	$infoFuncao = $app->hide400 ? '' : 'Funcao['.$app->rota->funcao.'] inexistente no controlador';
	$app->response(400, $infoFuncao);
}

$prepare = new stdClass;
$prepare->get = $app->get;
$prepare->post = $app->post;
$prepare->body = $app->body;

call_user_func($app->rota->funcao, $prepare);

?>
