<?php
$contador = 10;
//CRUD
class PaisService {

	private $conexao;
	private $pais;
	private $sigla;

	public function __construct(Conexao $conexao, Pais $pais, Pais $sigla) {
		$this->conexao = $conexao->conectar();
		$this->pais = $pais;
		$this->sigla = $sigla;
	}

	public function inserir() {
		$query = 'insert into tb_pais(pais, sigla)values(:pais, :sigla)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':pais', $this->pais->__get('pais'));
		$stmt->bindValue(':sigla', $this->sigla->__get('sigla'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select * from tb_pais order by tb_pais.pais, tb_pais.sigla, tb_pais.id limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperar2() {
		$query = 'select id, pais, sigla from tb_pais order by pais';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperartotal() {
		$query = "select * from tb_pais";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperarName() {
		$query = 'select id, pais, sigla from tb_pais where pais = :pais';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':pais', $_POST['pais']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() {
		$query = 'update tb_pais set pais = :pais, sigla = :sigla where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':pais', $this->pais->__get('pais'));
		$stmt->bindValue(':sigla', $this->sigla->__get('sigla'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}

	public function remover() {
		$query = 'delete from tb_pais where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']); 
		return $stmt->execute();
	}
}
?>
