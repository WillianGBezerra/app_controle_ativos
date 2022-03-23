<?php

class empresa {
	private $id;
	private $razao_social;
	private $nome_fantasia;
	private $cnpj;
	private $ie;
	private $endereco;
	private $cidade_id;
	private $cep;

	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}

?>