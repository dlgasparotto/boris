<?

Class Pessoa {

  function __construct(){

    $this->db = Base::db1();
    $this->resource = 'pessoas';

  }

  function get($get) {
  	$afiltros = array();
  	if ($get->id <> '') array_push($afiltros, " id = '".$get->id."' ");
  	if (count($afiltros) > 0){
  		$filtros = ' where ' . implode(' and ', $afiltros);
  	} else {
  		$filtros = '';
  	}
  	$sql = "select * from $this->resource $filtros";
  	$rs = $this->db->query($sql);
  	$result = array();
  	while ($item = $rs->fetchObject()){
  		array_push($result, $item);
  	}
  
  	return $result;
  }

  function delete($id){
  	$sql = "delete from $this->resource where id = '$id'";
  	$rs = $this->db->query($sql);
  	return true;
  }

  function save($app){
  	$item = $app->body;
  	if ($item->id <> ''){
  		$sql = "update $this->resource set
  			campo1 = :campo1,
  			campo2 = :campo2
  			where id = '".$item->id."'";
  	} else {
  		$sql = "insert into $this->resource (campo1, campo2)
  			values (:campo1, :campo2)";
  	}
  	$rs = $this->db->prepare($sql);
  	$rs->bindValue(':campo1',$item->campo1);
  	$rs->bindValue(':campo2',$item->campo2);
  	$rs->execute();
  	
  	if ($item->id == ''){
  		$sql = "select id from $this->resource order by id desc limit 1";
  		$rs = $this->db->query($sql);
  		$ultimo = $rs->fetchObject();
  		$item->id = $ultimo->id;
  	}
    
  	return $item;
  }
 }
 ?>