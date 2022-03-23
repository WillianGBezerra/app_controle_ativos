<?php
//CRUD
class CidadeService {

	private $conexao;
	private $cidade;
	private $estado_id;

	public function __construct(Conexao $conexao, Cidade $cidade, Cidade $estado_id) {
		$this->conexao = $conexao->conectar();
		$this->cidade = $cidade;
		$this->estado_id = $estado_id;
	}

	public function inserir() {
		$query = 'insert into tb_cidade(cidade, estado_id)values(:cidade, :estado_id)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cidade', $this->cidade->__get('cidade'));
		$stmt->bindValue(':estado_id', $this->estado_id->__get('estado_id'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select tb_cidade.id, tb_cidade.cidade, tb_cidade.estado_id, tb_estado.estado from tb_cidade, tb_estado WHERE tb_cidade.estado_id = tb_estado.id order by tb_cidade.cidade limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	public function recuperar2() {
		$query = 'select tb_cidade.id, tb_cidade.cidade, tb_cidade.estado_id, tb_estado.estado from tb_cidade, tb_estado WHERE tb_cidade.estado_id = tb_estado.id order by cidade, estado_id';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperartotal() {
			$query = "select * from tb_cidade";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
	}
	public function recuperarName() {
		$query = 'select pais_id, pais_nome, pais_sigla from tb_pais where pais_nome = :pais_nome';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':pais_nome', $_POST['pais_nome']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() {
		$query = 'update tb_cidade set cidade = :cidade, estado_id = :estado_id where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cidade', $this->cidade->__get('cidade'));
		$stmt->bindValue(':estado_id', $this->estado_id->__get('estado_id'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}

	public function remover() {
		$query = 'delete from tb_cidade where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']);
		return $stmt->execute();
	}
}
?>
