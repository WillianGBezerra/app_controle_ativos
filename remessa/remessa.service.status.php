<?php
	class RemessaServiceStatus {

	private $conexao;
	private $status_id;
	
	public function __construct(Conexao $conexao, Remessa $status_id) {
		$this->conexao = $conexao->conectar();
		$this->status_id = $status_id;
	} 
	public function UpdateStatus() {
		$query = 'update tb_remessa set status_id =:status_id where id = :idr';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':status_id', $this->status_id->__get('status_id'));
		$stmt->bindValue(':idr', $_POST['remessa_id']);
		return $stmt->execute();
	}
	public function UpdateStatusD() {
		$query = 'update tb_remessa set status_id =:status_id where id = :idr';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':status_id', $this->status_id->__get('status_id'));
		$stmt->bindValue(':idr', $_GET['remessa_id']);
		return $stmt->execute();
	}
}
?>