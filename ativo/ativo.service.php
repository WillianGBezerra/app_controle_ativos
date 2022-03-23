<?php
	//CRUD
	class AtivoService {

		private $conexao;
		private $ativo;
		private $descricao;
		private $eam;
		private $placa;
		private $chassi;
		private $empresa_id;
		private $bloqueio;

		public function __construct(Conexao $conexao, Ativo $ativo, Ativo $descricao, Ativo $eam, Ativo $placa, Ativo $chassi, Ativo $empresa_id, Ativo $bloqueio) {
			$this->conexao = $conexao->conectar();
			$this->ativo = $ativo;
			$this->descricao = $descricao;
			$this->eam = $eam;
			$this->placa = $placa;
			$this->chassi = $chassi;
			$this->empresa_id = $empresa_id;
			$this->bloqueio = $bloqueio;
		}
		public function inserir() {
			$query = 'insert into tb_ativo (ativo, descricao, eam, placa, chassi, empresa_id, bloqueio)values(:ativo, :descricao, :eam, :placa, :chassi, :empresa_id, :bloqueio)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':ativo', $this->ativo->__get('ativo'));
			$stmt->bindValue(':descricao', $this->descricao->__get('descricao'));
			$stmt->bindValue(':eam', $this->eam->__get('eam'));
			$stmt->bindValue(':placa', $this->placa->__get('placa'));
			$stmt->bindValue(':chassi', $this->chassi->__get('chassi'));
			$stmt->bindValue(':empresa_id', $this->empresa_id->__get('empresa_id'));
			$stmt->bindValue(':chassi', $this->chassi->__get('chassi'));
			$stmt->bindValue(':bloqueio', $this->bloqueio->__get('bloqueio'));
			$stmt->execute();
		}
		public function recuperar($limit, $offset) {
			$query = "select tb_ativo.id, tb_ativo.ativo, tb_ativo.descricao, tb_ativo.eam, tb_ativo.placa, tb_ativo.chassi, tb_ativo.empresa_id, tb_ativo.bloqueio, tb_empresa.nome_fantasia from tb_ativo, tb_empresa WHERE tb_ativo.empresa_id = tb_empresa.id order by tb_ativo.ativo, tb_ativo.descricao, tb_ativo.placa, tb_ativo.chassi, tb_ativo.bloqueio limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarPorEmpresa($limit, $offset, $txtid) {
			$query = "select a.id, a.ativo, a.descricao, a.eam, a.placa, a.chassi, a.empresa_id, a.bloqueio, e.id AS empresa, e.razao_social, e.nome_fantasia, e.cnpj, e.ie, e.endereco, e.cidade_id, e.cep FROM tb_ativo AS a INNER JOIN tb_empresa AS e ON a.empresa_id = e.id WHERE a.empresa_id LIKE '%$txtid%' limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarPorColuna($limit, $offset, $coluna, $conteudo) {
			$query = "select a.id, a.ativo, a.descricao, a.eam, a.placa, a.chassi, a.empresa_id, a.bloqueio, e.id AS empresa, e.razao_social, e.nome_fantasia, e.cnpj, e.ie, e.endereco, e.cidade_id, e.cep FROM tb_ativo AS a INNER JOIN tb_empresa AS e ON a.empresa_id = e.id WHERE $coluna LIKE $conteudo limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarString($like){
			$query = "select * from tb_ativo where descricao like $like";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperar2() {
			$query = "select id, ativo, descricao, eam, placa, chassi, empresa_id, tb_ativo.bloqueio from tb_ativo order by ativo";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperartotal() {
			$query = "select * from tb_ativo";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
		}
		public function recuperartotalPorColuna($coluna, $conteudo) {
			$query = "select * from tb_ativo WHERE $coluna LIKE conteudo";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
		}
		public function atualizar() {
			$query = 'update tb_ativo set ativo = :ativo, descricao = :descricao, eam = :eam, placa = :placa, chassi = :chassi, empresa_id = :empresa_id, bloqueio = :bloqueio where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':ativo', $this->ativo->__get('ativo'));
			$stmt->bindValue(':descricao', $this->descricao->__get('descricao'));
			$stmt->bindValue(':eam', $this->eam->__get('eam'));
			$stmt->bindValue(':placa', $this->placa->__get('placa'));
			$stmt->bindValue(':chassi', $this->chassi->__get('chassi'));
			$stmt->bindValue(':empresa_id', $this->empresa_id->__get('empresa_id'));
			$stmt->bindValue(':bloqueio', $this->bloqueio->__get('bloqueio'));
			$stmt->bindValue(':id', $_POST['id']);
			return $stmt->execute();
		}
		public function remover() {
			$query = 'delete from tb_ativo where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id',$_GET['id']);
			$stmt->execute();
			
		}
	}
?>
