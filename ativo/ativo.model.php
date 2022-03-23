<?php

class ativo {
	private $id;
	private $ativo;
	private $descricao;
	private $eam;
	private $placa;
	private $chassi;
	private $empresa_id;
	private $bloqueio;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}

?>