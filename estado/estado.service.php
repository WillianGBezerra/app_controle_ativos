<?php
	//CRUD
	class EstadoService {

		private $conexao;
		private $estado;
		private $sigla;
		private $pais_nome;

		public function __construct(Conexao $conexao, Estado $estado, Estado $sigla, Estado $pais_id) {
			$this->conexao = $conexao->conectar();
			$this->estado = $estado;
			$this->sigla = $sigla;
			$this->pais_id = $pais_id;
		}
		public function inserir() {
			$query = 'insert into tb_estado(estado, sigla, pais_id)values(:estado, :sigla, :pais_id)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':estado', $this->estado->__get('estados'));
			$stmt->bindValue(':sigla', $this->sigla->__get('sigla'));
			$stmt->bindValue(':pais_id', $this->pais_id->__get('pais_id'));
			$stmt->execute();
		}
		public function recuperar($limit, $offset) {
			$query = "select tb_estado.id, tb_estado.estado, tb_estado.pais_id, tb_estado.sigla, tb_pais.pais from tb_estado, tb_pais WHERE tb_estado.pais_id = tb_pais.id order by tb_estado.estado limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperar2() {
			$query = "select id, estado, sigla from tb_estado order by estado";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperartotal() {
			$query = "select * from tb_estado";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
		}


		public function atualizar() {
			$query = 'update tb_estado set estado = :estado, sigla = :sigla, pais_id = :pais_id where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':estado', $this->estado->__get('estado'));
			$stmt->bindValue(':sigla', $this->sigla->__get('sigla'));
			$stmt->bindValue(':pais_id', $this->pais_id->__get('pais_id'));
			$stmt->bindValue(':id', $_POST['id']);
			return $stmt->execute();
		}
		public function remover() {
			$query = 'delete from tb_estado where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id',$_GET['id']);
			return $stmt->execute();
		} 
	}
?>
