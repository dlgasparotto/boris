<?
Class Aplicacao {

	function __construct() {

		$bodyreq = file_get_contents('php://input');
		$configs = file_get_contents('sys/configs.json');
		$this->configs = json_decode($configs);
		//var_dump($this->configs);
		//$this->hide400 = false;
		$this->get 		= (object) $_GET;
		$this->post 	= (object) $_POST;
		$this->body = json_decode($bodyreq);

	}

	function auth($resource){

		$authType = $this->configs->auth->authType;
		$header = getallheaders();

		switch ($authType) {

			case 'none':
				return true;

			case 'tokenUser':
				$tokenUser = $this->configs->auth->authSets->tokenUser;
				if (!isSet($header[$tokenUser->key])) {
					$this->response(400, 'Auth fail');
				}
				if ($header[$tokenUser->key] <> $tokenUser->secret) {
					$this->response(400, 'Auth fail');
				}
				break;

			case 'basicAuth':

				break;

		}

	}

	function response($status = 200, $info = ''){

		$ret = new stdClass;
		$bloqInfo = false;
		$bloqInfo = ($status == 400 and $this->configs->hide400);
		if ($info <> '' and !$bloqInfo) $ret->message = $info;
		
		http_response_code($status);
		header('Content-Type: application/json');
		die(json_encode($ret));

	}

}

?>