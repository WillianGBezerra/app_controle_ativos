<?php 

//CRUD
class StatusService {

	private $conexao;
	private $status;

	public function __construct(Conexao $conexao, Status $status) {
		$this->conexao = $conexao->conectar();
		$this->status = $status;
	}
	public function inserir() {
		$query = 'insert into tb_status (status)values(:status)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':status', $this->status->__get('status'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select id, status from tb_status order by status limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperar2() {
		$query = 'select id, status from tb_status order by status';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperartotal() {
		$query = "select * from tb_status";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function atualizar() {
		$query = 'update tb_status set status = :status where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':status', $this->status->__get('status'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
	public function remover() {
		$query = 'delete from tb_status where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']); 
		return $stmt->execute();
	}
}
?>