<?php
class pais {
	private $pais_id;
	private $pais_nome;
	private $pais_sigla;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}
?>
