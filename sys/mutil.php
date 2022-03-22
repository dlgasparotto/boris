<?

Class Util {

  // -------------------------
  // Padrao
  
  static function resSuccess($data){
    echo json_encode($data);
  }
	
  static function resInvalidReq($message){
    $ret = new stdClass;
    $ret->message = $message;
    http_response_code(400);
    echo json_encode($ret);
  }

	static function trataApo($string){
		return str_replace("'","''",$string);
	}

	static function fnum($txt){
		return preg_replace('/\D/', '', $txt);
	}

  // App - Colocar a partir daqui as funções do app

  
}