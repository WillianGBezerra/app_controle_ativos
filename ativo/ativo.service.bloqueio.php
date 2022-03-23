<?php
	class AtivoServiceBloqueio {

		private $conexao;
		private $bloqueio;

		public function __construct(Conexao $conexao, Ativo $bloqueio) {
			$this->conexao = $conexao->conectar();
			$this->bloqueio = $bloqueio;
		}
		public function bloqueio() {
			$query = 'update tb_ativo set bloqueio =:bloqueio where id = :a_id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':bloqueio', $this->bloqueio->__get('bloqueio'));
			$stmt->bindValue(':a_id', $_POST['ativo_id']);
			return $stmt->execute();
		}
		public function desbloqueio() {
			$query = 'update tb_ativo set bloqueio =:bloqueio where id = :a_id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':bloqueio', $this->bloqueio->__get('bloqueio'));
			$stmt->bindValue(':a_id', $_GET['ativo_id']);
			return $stmt->execute();
		} 
	}
?>	