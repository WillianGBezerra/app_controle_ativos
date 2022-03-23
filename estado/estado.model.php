<?php
class estado {
	private $id;
	private $estado;
	private $sigla;
	private $pais_id;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}
?>
