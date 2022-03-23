<?php 

//CRUD
class OpfiscalService {

	private $conexao;
	private $opdescricao;
	private $sigla_op_fiscal;
	private $cfop_id;
	private $prazo;

	public function __construct(Conexao $conexao, Opfiscal $opdescricao, Opfiscal $sigla_op_fiscal, Opfiscal $cfop_id, Opfiscal $prazo) {
		$this->conexao = $conexao->conectar();
		$this->opdescricao = $opdescricao;
		$this->sigla_op_fiscal = $sigla_op_fiscal;
		$this->cfop_id = $cfop_id;
		$this->prazo = $prazo;
	}

	public function inserir() {
		$query = 'insert into tb_opfiscal(opdescricao, sigla_op_fiscal, cfop_id, prazo)values(:opdescricao, :sigla_op_fiscal, :cfop_id, :prazo)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':opdescricao', $this->opdescricao->__get('opdescricao'));
		$stmt->bindValue(':sigla_op_fiscal', $this->sigla_op_fiscal->__get('sigla_op_fiscal'));
		$stmt->bindValue(':cfop_id', $this->cfop_id->__get('cfop_id'));
		$stmt->bindValue(':prazo', $this->prazo->__get('prazo'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select tb_opfiscal.id, tb_opfiscal.opdescricao, tb_opfiscal.sigla_op_fiscal, tb_opfiscal.prazo, tb_opfiscal.cfop_id, tb_cfop.cfop from tb_opfiscal, tb_cfop WHERE tb_opfiscal.cfop_id = tb_cfop.id order by tb_cfop.cfop, tb_opfiscal.sigla_op_fiscal, tb_opfiscal.opdescricao, tb_opfiscal.id limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperar2() {
		$query = 'select id, opdescricao, sigla_op_fiscal, cfop_id, prazo from tb_opfiscal';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperartotal() {
		$query = 'select * from tb_opfiscal';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function atualizar() {
		$query = 'update tb_opfiscal set opdescricao = :opdescricao, sigla_op_fiscal = :sigla_op_fiscal, cfop_id = :cfop_id, prazo =:prazo where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':opdescricao', $this->opdescricao->__get('opdescricao'));
		$stmt->bindValue(':sigla_op_fiscal', $this->sigla_op_fiscal->__get('sigla_op_fiscal'));
		$stmt->bindValue(':cfop_id', $this->cfop_id->__get('cfop_id'));
		$stmt->bindValue(':prazo', $this->prazo->__get('prazo'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
	public function remover() {
		$query = 'delete from tb_opfiscal where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']);
		return $stmt->execute();
	}
	public function prazo() {
		$query = 'select prazo from tb_opfiscal where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_POST['opfiscal_id']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>