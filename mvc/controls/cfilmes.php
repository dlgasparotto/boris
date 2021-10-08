<?
header('Content-Type: application/json');

// ---------------------------------------------

function listFilme($app){

  $filme = new Filme;
  $result = $filme->lista($app->get);

  Util::resSuccess($result);

}

// ---------------------------------------------

function delFilme($app){
  
  $filme = new Filme;
  $id = $app->get->id;
  $result = $filme->delete($id);

  Util::resSuccess(true);

}

// ---------------------------------------------

function saveFilme($app){

  $filme = new Filme;
  $result = $filme->save($app);
  Util::resSuccess($result);

}

// ---------------------------------------------

?>