<?php
class retorno {
	private $id;
	private $nfretorno;
	private $emissaoret;
	private $remessa_id;
	private $dataRetorno;
	private $observacao;


	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}
?>