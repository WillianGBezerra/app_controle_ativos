<?php

class categoria {
	private $id;
	private $codigo;
	private $categoria;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}

?>