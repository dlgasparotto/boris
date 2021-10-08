<?
Class Filme {

	function __construct(){
		
		$this->db = Base::db1();
		
	}

	function lista($get) {
		
		$afiltros = array();
		if ($get->id <> '') array_push($afiltros, " id = '".$get->id."' ");
		if ($get->nome <> '') array_push($afiltros, " nome like '%".$get->nome."%' ");
		if (count($afiltros) > 0){
			$filtros = ' where ' . implode(' and ', $afiltros);
		} else {
			$filtros = '';
		}

		$sql = "select * from filmes $filtros";
		$rs = $this->db->query($sql);
		$result = array();
		while ($filme = $rs->fetchObject()){
			array_push($result, $filme);
		}

		return $result;
	}


	function delete($id){
		$sql = "delete from filmes where id = '$id'";
		$rs = $this->db->query($sql);
		return true;
	}

	function save($app){
		
		$filme = $app->body;

		if ($filme->id <> ''){
			$sql = "update filmes set
				nome = ':nome',
				tamanho = ':tamanho',
				idioma = ':idioma',
				local = ':local',
				capa = ':capa'
				where id = '".$filme->id."'";
		} else {
			$sql = "insert into filmes (nome, tamanho, idioma, local, capa)
				values (:nome, :tamanho, :idioma, :local, :capa)";
		}
		$rs = $this->db->prepare($sql);
		$rs->bindValue(':nome',$filme->nome);
		$rs->bindValue(':tamanho',$filme->tamanho);
		$rs->bindValue(':idioma',$filme->idioma);
		$rs->bindValue(':local',$filme->local);
		$rs->bindValue(':capa',$filme->capa);
		$rs->execute();
		
		if ($filme->id == ''){
			$sql = "select * from filmes order by id desc limit 1";
			$rs = $this->db->query($sql);
			$ultimo = $rs->fetchObject();
			$filme = $ultimo;
		}

		return $filme;
	}

}
?>