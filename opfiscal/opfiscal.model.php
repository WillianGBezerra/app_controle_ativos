<?php

class opfiscal {
	private $id;
	private $opdescricao;
	private $sigla_op_fiscal;
	private $cfop_id;
	private $prazo;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}

?>