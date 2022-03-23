<?php 

//CRUD
class CfopService {

	private $conexao;
	private $cfop;
	private $descricao;

	public function __construct(Conexao $conexao, Cfop $cfop, Cfop $descricao) {
		$this->conexao = $conexao->conectar();
		$this->cfop = $cfop;
		$this->descricao = $descricao;
	}
	public function inserir() {
		$query = 'insert into tb_cfop(cfop, descricao)values(:cfop, :descricao)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cfop', $this->cfop->__get('cfop'));
		$stmt->bindValue(':descricao', $this->descricao->__get('descricao'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select id, cfop, descricao from tb_cfop order by cfop, descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperar2() {
		$query = 'select id, cfop, descricao from tb_cfop order by cfop, descricao';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperartotal() {
		$query = "select * from tb_cfop";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function atualizar() {
		$query = 'update tb_cfop set cfop = :cfop, descricao = :descricao where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cfop', $this->cfop->__get('cfop'));
		$stmt->bindValue(':descricao', $this->descricao->__get('descricao'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
	public function remover() {
		$query = 'delete from tb_cfop where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']);
		return $stmt->execute();
	}
	public function marcarDesabilitado() {
		$query = 'update tb_cfop set status_id = ? where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->cfop->__get('cfop'));
		$stmt->bindValue(':descricao', $this->id->__get('descricao'));
		$stmt->bindValue(':status_id', $this->status_id->__get('status_id'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
}

?>