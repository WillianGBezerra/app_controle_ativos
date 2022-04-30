<?php
	class RetornoService {
		private $conexao;
		private $nfretorno;
		private $emissaoret;
		private $remessa_id;
		private $dataRetorno;
		private $observacao;

		public function __construct(Conexao $conexao, Retorno $nfretorno, Retorno $emissaoret, Retorno $dataRetorno, Retorno $observacao, Retorno $remessa_id) {
			$this->conexao = $conexao->conectar(); 
			$this->nfretorno = $nfretorno;
			$this->emissaoret = $emissaoret;
			$this->remessa_id = $remessa_id;
			$this->dataRetorno = $dataRetorno;
			$this->observacao = $observacao; 
		} 
		public function inserir() {
			$query = 'insert into tb_retorno (nfretorno, emissaoret, dataRetorno, observacao, remessa_id)values(:nfretorno, :emissaoret, :dataRetorno,:observacao, :remessa_id)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':nfretorno', $this->nfretorno->__get('nfretorno'));
			$stmt->bindValue(':emissaoret', $this->emissaoret->__get('emissaoret'));
			$stmt->bindValue(':dataRetorno', $this->dataRetorno->__get('dataRetorno'));
			$stmt->bindValue(':observacao', $this->observacao->__get('observacao'));
			$stmt->bindValue(':remessa_id', $this->remessa_id->__get('remessa_id'));
			$stmt->execute();
		}
		public function recuperar($limit, $offset) {
			$query = "select rt.id, rt.nfretorno, rt.emissaoret, rt.observacao, rt.dataRetorno, rt.remessa_id, r.id AS rid, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.opfiscal_id, op.opdescricao, op.prazo, a.id AS ativo_id, a.ativo, a.descricao, a.placa, a.eam, a.chassi, e.nome_fantasia AS origem, em.nome_fantasia AS destino FROM tb_retorno rt, tb_remessa r, tb_opfiscal op, tb_ativo a, tb_empresa e, tb_empresa em WHERE rt.remessa_id = r.id AND r.opfiscal_id = op.id AND r.ativo_id = a.id AND r.origem_id = e.id AND r.destino_id = em.id ORDER BY r.emissao, rt.dataRetorno, r.notafiscal, rt.nfretorno, a.ativo, a.descricao limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarPorColuna($coluna, $conteudo) {
			$query = "select rt.id, rt.nfretorno, rt.emissaoret, rt.remessa_id, rt.observacao,rt.dataRetorno, r.id AS rid, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.opfiscal_id, op.opdescricao, op.prazo, a.id AS ativo_id, a.ativo, a.descricao, a.placa, a.eam, a.chassi, e.nome_fantasia AS origem, em.nome_fantasia AS destino FROM tb_retorno rt 
				INNER JOIN tb_remessa AS r ON rt.remessa_id = r.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
	            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
				WHERE $coluna LIKE $conteudo
				ORDER BY r.emissao, rt.dataRetorno, r.notafiscal, rt.nfretorno, a.ativo, a.descricao";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarbynfe($coluna, $nfe) {
			$query = "select rt.id, rt.nfretorno, rt.emissaoret, rt.remessa_id, rt.observacao,rt.dataRetorno, r.id AS rid, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.opfiscal_id, op.opdescricao, op.prazo,a.ativo, a.descricao, a.placa, a.eam, a.chassi, e.nome_fantasia AS origem, em.nome_fantasia AS destino FROM tb_retorno rt 
				INNER JOIN tb_remessa AS r ON rt.remessa_id = r.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
	            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
				WHERE $coluna LIKE $nfe
				ORDER BY r.emissao, rt.dataRetorno, r.notafiscal, rt.nfretorno, a.ativo, a.descricao";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperarbydate($coluna, $data_inicial, $data_final) {
			$query = "select rt.id, rt.nfretorno, rt.emissaoret, rt.remessa_id, rt.observacao,rt.dataRetorno, r.id AS rid, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.opfiscal_id, op.opdescricao, op.prazo, a.ativo, a.descricao, a.placa, a.eam, a.chassi, e.nome_fantasia AS origem, em.nome_fantasia AS destino FROM tb_retorno rt, tb_remessa r, tb_opfiscal op, tb_ativo a, tb_empresa e, tb_empresa em WHERE $coluna BETWEEN '$data_inicial' AND '$data_final' AND rt.remessa_id = r.id AND r.opfiscal_id = op.id AND r.ativo_id = a.id AND r.origem_id = e.id AND r.destino_id = em.id ORDER BY r.emissao, rt.dataRetorno, r.notafiscal, rt.nfretorno, a.ativo, a.descricao";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperartotal() {
		$query = 'select * from tb_retorno';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
		/*
		"select rt.id, rt.nfretorno, rt.emissaoret, rt.remessa_id, r.id AS rid, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_retorno rt, tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE rt.remessa_id = r.id, r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		*/
		}
		public function remover() {
		$query = 'delete from tb_retorno where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']); 
		return $stmt->execute();
		}
		public function atualizar() {
		$query = 'update tb_retorno set nfretorno =:nfretorno, emissaoret = :emissaoret, dataRetorno =:dataRetorno, observacao =:observacao, remessa_id =:remessa_id where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nfretorno', $this->nfretorno->__get('nfretorno'));
		$stmt->bindValue(':emissaoret', $this->emissaoret->__get('emissaoret'));
		$stmt->bindValue(':dataRetorno', $this->dataRetorno->__get('dataRetorno'));
		$stmt->bindValue(':observacao', $this->observacao->__get('observacao'));
		$stmt->bindValue(':remessa_id', $this->remessa_id->__get('remessa_id'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
		}
	}
?>