<?php 

//CRUD
class CategoriaService {

	private $conexao;
	private $codigo;
	private $categoria;

	public function __construct(Conexao $conexao, Categoria $codigo, Categoria $categoria) {
		$this->conexao = $conexao->conectar();
		$this->codigo = $codigo;
		$this->categoria = $categoria;
	}
	public function inserir() {
		$query = 'insert into tb_catativo(codigo, categoria)values(:codigo, :categoria)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':codigo', $this->codigo->__get('codigo'));
		$stmt->bindValue(':categoria', $this->categoria->__get('categoria'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select id, codigo, categoria from tb_catativo order by categoria limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperar2() {
		$query = "select id, codigo, categoria from tb_catativo order by categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}
	public function recuperartotal() {
		$query = "select * from tb_catativo";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function atualizar() {
		$query = 'update tb_catativo set codigo = :codigo, categoria = :categoria where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':codigo', $this->codigo->__get('codigo'));
		$stmt->bindValue(':categoria', $this->categoria->__get('categoria'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
	public function remover() {
		$query = 'delete from tb_catativo where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']);
		return $stmt->execute();
	}
	public function marcarDesabilitado() {
		$query = 'update tb_catativo set status_id = ? where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->cfop->__get('cfop'));
		$stmt->bindValue(':descricao', $this->id->__get('descricao'));
		$stmt->bindValue(':status_id', $this->status_id->__get('status_id'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
}

?>