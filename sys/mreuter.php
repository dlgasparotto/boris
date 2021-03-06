<?

Class Reuter {

  function __construct(){ 

		$this->verbo 	= strtoupper($_SERVER["REQUEST_METHOD"]);
		$this->prefixo = str_replace("index.php", "", $_SERVER['PHP_SELF']); 

		if ($this->prefixo == '/'){
			$uriori = substr($_SERVER["REQUEST_URI"], 1);
		} else {
			$uriori	= str_replace($this->prefixo, '', $_SERVER["REQUEST_URI"]);
		}
		
		$uri  = explode('?', $uriori)[0];
		$uria = explode('/', $uri) ;
		
		$this->resource = $uria[0];
		$this->resourcePars = array_slice($uria, 1);

		$this->get = new stdClass;
    $this->rotas = [];

		$this->resourceRoutes = 'resources/' . $this->resource . '/r' . $this->resource . '.php';
		$this->resourceController = 'resources/' . $this->resource . '/c' . $this->resource . '.php';

  }
	
  function hasRoutes(){
		return file_exists($this->resourceRoutes);
	}

	function hasController(){
		return file_exists($this->resourceController);
	}

  function setRota(){

		$rotaName = $this->verbo . $this->resource . count($this->resourcePars);

		if (!isSet($this->rotas[$rotaName])){
			return false;
		}

		$this->rota = $this->rotas[$rotaName];
		foreach ($this->rota->pars as $key => $par){
			$this->get->$par = $this->resourcePars[$key];
		}
		return true;

	}

  function delete($rota, $funcao){
		$route = new Rota('DELETE', $rota, $funcao);
		$this->registerRoute($route);
	}

	function put($rota, $funcao){
		$route = new Rota('PUT', $rota, $funcao);
		$this->registerRoute($route);
	}

	function get($rota, $funcao){
		$route = new Rota('GET', $rota, $funcao);
		$this->registerRoute($route);
	}

	function post($rota, $funcao){
		$route = new Rota('POST', $rota, $funcao);
		$this->registerRoute($route);
	}

	function registerRoute($route){
		$this->rotas[$route->name] = $route;
	}

}


Class Rota {

	function __construct($verbo, $rota, $funcao){

		$rota = str_replace(':', '', $rota);
		$compRota = explode("/", $rota);
		$resource = $compRota[0];
		$pars = array_slice($compRota, 1);
		
		$this->name = $verbo . $resource . count($pars);
		$this->verbo = $verbo;
		$this->rota = $resource;
		$this->pars = $pars;
		$this->funcao = $funcao;

	}

}

?>