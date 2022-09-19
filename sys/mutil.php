<?

Class Util {

  //#########################################################################
  // Metodos padrao
  

  //#########################################################################
  static function resSuccess($data){

    if (gettype($data) == 'string') {
      echo $data;
    } else {
      echo json_encode($data);
    }
    die();

  }
	
  //#########################################################################
  static function resInvalidReq($message){

    $ret = new stdClass;
    $ret->message = $message;
    http_response_code(400);
    echo json_encode($ret);
    die();

  }
  
  //#########################################################################
	static function trataApo($string){

		return str_replace("'","''",$string);

	}
  
  //#########################################################################
	static function fnum($txt){

		return preg_replace('/\D/', '', $txt);

	}

  //#########################################################################
  // App - Colocar a partir daqui as funções do app

  
}