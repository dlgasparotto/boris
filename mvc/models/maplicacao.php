<?
Class Aplicacao {

	function __construct() {
		$this->hide400 = false;
		$this->verbo 	= strtoupper($_SERVER["REQUEST_METHOD"]);
		$this->prefixo = "/testes/api/";

		$uriori	= str_replace($this->prefixo, '', $_SERVER["REQUEST_URI"]);
		$uri = explode('?', $uriori)[0];
		$uria  	= explode('/', $uri) ;
		
		$this->rotasol = $uria[0];
		$this->rotasolpars = array_slice($uria, 1);

		$this->get 		= (object) $_GET;
		$this->post 	= (object) $_POST;
		$bodyreq = file_get_contents('php://input');
		$this->body = json_decode($bodyreq);
		
		$this->rotas 	= [];

	}

	function setRota(){
		$rotaname = $this->verbo . $this->rotasol . count($this->rotasolpars);
		for ($i = 0; $i< count($this->rotas); $i++){
			if ($rotaname == $this->rotas[$i]->name){
				$rota = $this->rotas[$i];
				for ($p = 0; $p < count($rota->pars); $p++) {
					$par = $rota->pars[$p];
					$this->get->$par = $this->rotasolpars[$p];
				}
				$this->rota = $rota;
				break;
			}
		}
	}
	

	function response($status = 200, $info = ''){
		http_response_code($status);
		$ret = new stdClass;
		if ($info <> '') $ret->message = $info;
		header('Content-Type: application/json');
		die(json_encode($ret));
	}

	function delete($rota, $pars, $funcao){
		array_push($this->rotas, new Rota('DELETE', $rota, $pars, $funcao));
	}

	function put($rota, $pars, $funcao){
		array_push($this->rotas, new Rota('PUT', $rota, $pars, $funcao));
	}

	function get($rota, $pars, $funcao){
		array_push($this->rotas, new Rota('GET', $rota, $pars, $funcao));
	}

	function post($rota, $pars, $funcao){
		array_push($this->rotas, new Rota('POST', $rota, $pars, $funcao));
	}

	

}


//*********************************************************************************** */

Class Rota {
	function __construct($verbo, $rota, $pars, $funcao){
		$this->name = $verbo . $rota . count($pars);
		$this->verbo = $verbo;
		$this->rota = $rota;
		$this->pars = $pars;
		$this->funcao = $funcao;
	}
}


?>