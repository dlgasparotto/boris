<?
$controler = 'filmes';
$app->get($controler , [], 'listFilme');
$app->get($controler , ['id'], 'listFilme');
$app->post($controler, [], 'saveFilme' ); 
$app->delete($controler, ['id'], 'delFilme');
$app->put($controler , [], 'saveFilme');
?>