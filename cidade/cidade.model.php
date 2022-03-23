<?php
class cidade {
	private $id;
	private $cidade;
	private $estado_id;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}
?>
