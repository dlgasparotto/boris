<?
$reuter->get('filmes' , [], 'listFilme');
$reuter->get('filmes' , ['id'], 'listFilme');
$reuter->post('filmes', [], 'saveFilme' ); 
$reuter->delete('filmes', ['id'], 'delFilme');
$reuter->put('filmes' , [], 'saveFilme');
?>