<?php
//CRUD 
class RemessaService {

	private $conexao;
	private $opfiscal_id;
	private $notafiscal;
	private $chave_nfe_remessa;
	private $valor;
	private $emissao;
	private $entrada;
	private $ativo_id;
	private $retorno;
	private $origem_id;
	private $destino_id;
	private $status_id;

	public function __construct(Conexao $conexao, Remessa $opfiscal_id, Remessa $notafiscal, Remessa $chave_nfe_remessa, Remessa $valor, Remessa $emissao, Remessa $entrada, Remessa $ativo_id, Remessa $retorno, Remessa $origem_id, Remessa $destino_id, Remessa $status_id) {
		$this->conexao = $conexao->conectar(); 
		$this->opfiscal_id = $opfiscal_id;
		$this->notafiscal = $notafiscal;
		$this->chave_nfe_remessa = $chave_nfe_remessa;
		$this->valor = $valor;
		$this->emissao = $emissao;
		$this->entrada = $entrada;
		$this->ativo_id = $ativo_id;
		$this->retorno = $retorno;
		$this->origem_id = $origem_id;
		$this->destino_id = $destino_id;
		$this->status_id = $status_id;

	} 
 
	public function inserir() {
		$query = 'insert into tb_remessa (opfiscal_id, notafiscal, chave_nfe_remessa, valor, emissao, entrada, ativo_id, retorno, origem_id, destino_id, status_id)values(:opfiscal_id, :notafiscal, :chave_nfe_remessa, :valor, :emissao, :entrada, :ativo_id, :retorno, :origem_id, :destino_id, :status_id)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':opfiscal_id', $this->opfiscal_id->__get('opfiscal_id'));
		$stmt->bindValue(':notafiscal', $this->notafiscal->__get('notafiscal'));
		$stmt->bindValue(':chave_nfe_remessa', $this->chave_nfe_remessa->__get('chave_nfe_remessa'));
		$stmt->bindValue(':valor', $this->valor->__get('valor'));
		$stmt->bindValue(':emissao', $this->emissao->__get('emissao'));
		$stmt->bindValue(':entrada', $this->entrada->__get('entrada'));
		$stmt->bindValue(':ativo_id', $this->ativo_id->__get('ativo_id'));
		$stmt->bindValue(':retorno', $this->retorno->__get('retorno'));
		$stmt->bindValue(':origem_id', $this->origem_id->__get('origem_id'));
		$stmt->bindValue(':destino_id', $this->destino_id->__get('destino_id'));
		$stmt->bindValue(':status_id', $this->status_id->__get('status_id'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, r.status_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, a.bloqueio, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE r.status_id = 1 AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarId($id) {
		$query = "select * from tb_remessa WHERE tb_remessa.id = $id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperarbydate($limit, $offset, $coluna, $data_inicial, $data_final) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, a.bloqueio, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE $coluna BETWEEN '$data_inicial' AND '$data_final' AND r.status_id = 1 AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarbynfe($nfe) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, a.bloqueio, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE r.notafiscal = $nfe AND r.status_id = 1 AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorChassi($limit, $offset, $ativo_chassi) {
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status, a.bloqueio FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND a.chassi LIKE '$ativo_chassi' AND r.status_id LIKE 1
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorN_Ativo($limit, $offset, $n_ativo) {
		ini_set('default_charset', 'utf-8');
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND a.ativo LIKE '$n_ativo' AND r.status_id LIKE 1
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorPlaca($limit, $offset, $placa) {
		ini_set('default_charset', 'utf-8');
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND a.placa LIKE '$placa' AND r.status_id LIKE 1
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorColuna($limit, $offset, $coluna, $conteudo) {
		/*echo '<pre>';
		print_r('coluna service: '.$coluna);
		echo '</pre>';
		echo '<pre>';
		print_r('conteudo service: '.$conteudo);
		echo '</pre>';
		/*ini_set('default_charset', 'utf-8');*/
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, a.bloqueio, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
			INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
			INNER JOIN tb_empresa AS e ON r.origem_id = e.id
            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
			INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE r.status_id LIKE 1 AND $coluna LIKE $conteudo
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarTotalPorColuna($coluna, $conteudo) {
		/*ini_set('default_charset', 'utf-8');*/ 
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, a.bloqueio, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
			INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
			INNER JOIN tb_empresa AS e ON r.origem_id = e.id
            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
			INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE $coluna LIKE $conteudo AND r.status_id LIKE 1";      
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}	
	public function recuperarPorMovStatus($tipoMov, $stRegistro) {
		ini_set('default_charset', 'utf-8');
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, op.tipoMov, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
			INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
			INNER JOIN tb_empresa AS e ON r.origem_id = e.id
            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
			INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND op.tipoMov LIKE '$tipoMov' AND r.status_id LIKE '$stRegistro'
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarTodos($limit, $offset) {
		ini_set('default_charset', 'utf-8');
		$query = "select r.id, r.opfiscal_id, op.id AS opid, op.opdescricao, op.prazo, op.sigla_op_fiscal, op.tipoMov, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r  
			INNER JOIN tb_status AS s ON r.status_id = s.id
			INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
			INNER JOIN tb_empresa AS e ON r.origem_id = e.id
            INNER JOIN tb_empresa AS em ON r.destino_id = em.id
			INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id
            ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorMovEeStatus($limit, $offset, $tipom, $st) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam AS Eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE r.status_id = $st AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = $tipom AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarPorMovSeStatus($limit, $offset, $tipom, $st) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam AS Eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE r.status_id = $st AND r.opfiscal_id = op.id AND r.origem_id = $tipom AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperarTotalExcel($limit, $offset) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam AS Eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE r.status_id = $st AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao limit $limit offset $offset";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function recuperar2() { 
		$query = 'select id, opfiscal, 
					notafiscal, 
					valor,
					emissao, 
					entrada,
					ativo_id, 
					retorno, 
					origem_id, 
					destino_id 
					from remessa order by retorno';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function reportpdfEntrada($empresa, $status) {
		/*$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status, s.id AS idstatus FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s INNER JOIN r.origem_id = e.id AND r.status_id = s.id AND r.opfiscal_id = op.id AND r.destino_id = em.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao WHERE r.status_id = $status AND r.origem_id = $empresa";*/
		/*$query = "select * FROM tb_remessa
				INNER JOIN tb_status ON tb_remessa.status_id = tb_status.id
				INNER JOIN tb_opfiscal ON tb_remessa.opfiscal_id = tb_opfiscal.id
				INNER JOIN tb_empresa ON tb_remessa.destino_id = tb_empresa.id
				INNER JOIN tb_ativo ON tb_remessa.ativo_id = tb_ativo.id
			WHERE
    			tb_remessa.origem_id = $empresa AND tb_remessa.status_id = $status";*/
		$query = "select r.id, r.opfiscal_id, r.notafiscal, r.valor, r.emissao, r.chave_nfe_remessa, r.entrada, r.ativo_id, r.retorno, r.origem_id, r.destino_id, r.status_id, s.id AS sid, s.status, op.opdescricao, e.id AS Eempresa, e.nome_fantasia AS origem, em.id AS Emempresa, em.nome_fantasia destino, a.id AS ativo, a.descricao, a.placa, a.chassi FROM tb_remessa r
				INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND r.origem_id LIKE $empresa AND r.status_id LIKE $status
            ORDER BY R.emissao, r.retorno, r.destino_id, r.notafiscal, r.ativo_id, r.opfiscal_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function reportpdfSaida($empresa, $status) {
		/*$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status, s.id AS idstatus FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s INNER JOIN r.destino_id = em.id AND r.status_id = s.id AND r.opfiscal_id = op.id AND r.origem_id = e.id AND r.ativo_id = a.id AND r.status_id = s.id ORDER BY r.retorno, r.notafiscal, r.emissao, a.descricao WHERE r.status_id = $status AND r.destino_id = $empresa";*/
		/*$query = "select * FROM tb_remessa
				INNER JOIN tb_status ON tb_remessa.status_id = tb_status.id
				INNER JOIN tb_opfiscal ON tb_remessa.opfiscal_id = tb_opfiscal.id
				INNER JOIN tb_empresa ON tb_remessa.origem_id = tb_empresa.id
				INNER JOIN tb_ativo ON tb_remessa.ativo_id = tb_ativo.id
			WHERE
    			tb_remessa.destino_id = $empresa AND tb_remessa.status_id = $status";*/
		$query = "select r.id, r.opfiscal_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.ativo_id, r.retorno, r.origem_id, r.destino_id, r.status_id, s.id AS sid, s.status, op.opdescricao, e.id AS Eempresa, e.nome_fantasia AS origem, em.id AS Emempresa, em.nome_fantasia destino, a.id AS ativo, a.descricao, a.placa, a.chassi FROM tb_remessa r
				INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND r.destino_id LIKE $empresa AND r.status_id LIKE $status
            ORDER BY R.emissao, r.retorno, r.destino_id, r.notafiscal, r.ativo_id, r.opfiscal_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function reportpdfAll() {
		$query = "select r.id, r.opfiscal_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.ativo_id, r.retorno, r.origem_id, r.destino_id, r.status_id, s.id AS sid, s.status, op.opdescricao, e.id AS Eempresa, e.nome_fantasia AS origem, em.id AS Emempresa, em.nome_fantasia destino, a.id AS ativo, a.descricao, a.placa, a.chassi FROM tb_remessa r
				INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id AND r.destino_id = em.id AND r.origem_id = e.id AND r.status_id = s.id
            ORDER BY R.emissao, r.retorno, r.destino_id, r.notafiscal, r.ativo_id, r.opfiscal_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	} 
	public function reportcsv() {
		$query = "select r.id, r.opfiscal_id, r.notafiscal, r.chave_nfe_remessa, r.valor, r.emissao, r.entrada, r.ativo_id, r.retorno, r.origem_id, r.destino_id, r.status_id, s.id AS sid, s.status, op.opdescricao, e.id AS Eempresa, e.nome_fantasia AS origem, em.id AS Emempresa, em.nome_fantasia destino, a.id AS ativo, a.descricao, a.placa, a.chassi FROM tb_remessa r
				INNER JOIN tb_status AS s ON r.status_id = s.id
				INNER JOIN tb_opfiscal AS op ON r.opfiscal_id = op.id
				INNER JOIN tb_empresa AS e ON r.origem_id = e.id
                INNER JOIN tb_empresa AS em ON r.destino_id = em.id
				INNER JOIN tb_ativo AS a ON r.ativo_id = a.id
			WHERE
    			r.opfiscal_id = op.id AND r.ativo_id = a.id
            ORDER BY R.emissao, r.retorno, r.destino_id, r.notafiscal, r.ativo_id, r.opfiscal_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function recuperartotal() {
		$query = "select * from tb_remessa WHERE tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	/*public function recuperartotalbydate($coluna, $data_inicial, $data_final) {
		$query = "select r.id, r.opfiscal_id, op.opdescricao, op.prazo, op.sigla_op_fiscal, r.origem_id, r.destino_id, r.notafiscal, r.valor, r.emissao, r.entrada, r.retorno, r.ativo_id, e.nome_fantasia as origem, em.nome_fantasia as destino, a.id AS idativo, a.descricao, a.placa, a.eam, a.chassi, a.ativo, s.status AS status FROM tb_remessa r, tb_opfiscal op, tb_empresa e, tb_empresa em, tb_ativo a, tb_status s WHERE $coluna BETWEEN '$data_inicial' AND '$data_final' AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}*/
	public function recuperartotalbyAtivo_id($ativo_id) {
		$query = "select * from tb_remessa WHERE tb_remessa.ativo_id = $ativo_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbynfe($nfe) {
		$query = "select * from tb_remessa WHERE tb_remessa.notafiscal = $nfe AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbydate($coluna, $data_inicial, $data_final) {
		$query = "select * from tb_remessa WHERE $coluna BETWEEN '$data_inicial' AND '$data_final' AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbychassi($ativo_chassi) {
		$query = "select * from tb_remessa, tb_ativo WHERE tb_remessa.ativo_id = tb_ativo.id AND  tb_ativo.chassi = $ativo_chassi AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbyN_Ativo($n_ativo) {
		$query = "select * from tb_remessa, tb_ativo WHERE tb_remessa.ativo_id = tb_ativo.id AND tb_ativo.ativo = $n_ativo AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbyPlaca($placa) {
		$query = "select * from tb_remessa, tb_ativo WHERE tb_remessa.ativo_id = tb_ativo.id AND tb_ativo.placa = $placa AND tb_remessa.status_id = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalbyMovStatus($tipoMov, $stRegistro) {
		$query = "select * from tb_remessa, tb_opfiscal WHERE tb_remessa.opfiscal_id = tb_opfiscal.id AND tb_opfiscal.tipoMov = $tipoMov AND tb_remessa.status_id = '$stRegistro'";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalPdfS($empresa, $status) {
		$query = "select * from tb_remessa WHERE origem_id LIKE $empresa AND status_id LIKE $status";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function recuperartotalPdfE($empresa, $status) {
		$query = "select * from tb_remessa WHERE destino_id LIKE $empresa AND status_id LIKE $status";
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
		$query = 'update tb_remessa set opfiscal_id =:opfiscal_id, notafiscal = :notafiscal, chave_nfe_remessa = :chave_nfe_remessa, valor =:valor, emissao =:emissao, entrada =:entrada, ativo_id =:ativo_id, origem_id =:origem_id, destino_id =:destino_id, retorno =:retorno where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':opfiscal_id', $this->opfiscal_id->__get('opfiscal_id'));
		$stmt->bindValue(':notafiscal', $this->notafiscal->__get('notafiscal'));
		$stmt->bindValue(':chave_nfe_remessa', $this->chave_nfe_remessa->__get('chave_nfe_remessa'));
		$stmt->bindValue(':valor', $this->valor->__get('valor'));
		$stmt->bindValue(':emissao', $this->emissao->__get('emissao'));
		$stmt->bindValue(':entrada', $this->entrada->__get('entrada'));
		$stmt->bindValue(':ativo_id', $this->ativo_id->__get('ativo_id'));
		$stmt->bindValue(':origem_id', $this->origem_id->__get('origem_id'));
		$stmt->bindValue(':destino_id', $this->destino_id->__get('destino_id'));
		$stmt->bindValue(':retorno', $this->retorno->__get('retorno'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}

	public function remover() {
		$query = 'delete from tb_remessa where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']); 
		return $stmt->execute();
	}
}
?>
