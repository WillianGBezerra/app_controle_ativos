<?php
class remessa {
	private $id;
	private $opfiscal_id;
	private $notafiscal;
	private $chave_nfe_remessa;
	private $valor;
	private $emissao;
	private $entrada;
	private $ativo_id;
	private $retorno;
	private $origem_id;
	private $destino_id;
	private $status_id;


	public function __get($atributo) {
		return $this->atributo;
	}

	public function __set($atributo, $valor) {
		$this->atributo = $valor;
	}
}
?>
