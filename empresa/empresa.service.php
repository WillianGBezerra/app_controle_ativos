<?php 
//CRUD
class EmpresaService {

	private $conexao;
	private $razao_social;
	private $nome_fantasia;
	private $cnpj;
	private $ie;
	private $endereco;
	private $cidade_id;
	private $cep;

	public function __construct(Conexao $conexao, Empresa $razao_social, Empresa $nome_fantasia, Empresa $cnpj, Empresa $ie, Empresa $endereco, Empresa $cidade_id, Empresa $cep) {
		$this->conexao = $conexao->conectar();
		$this->razao_social = $razao_social;
		$this->nome_fantasia = $nome_fantasia;
		$this->cnpj = $cnpj;
		$this->ie = $ie;
		$this->endereco = $endereco;
		$this->cidade_id = $cidade_id;
		$this->cep = $cep;
	}
	
	public function inserir() {
		$query = 'insert into tb_empresa(razao_social, nome_fantasia, cnpj, ie, endereco, cidade_id, cep)values(:razao_social, :nome_fantasia, :cnpj, :ie, :endereco, :cidade_id, :cep)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':razao_social', $this->razao_social->__get('razao_social'));
		$stmt->bindValue(':nome_fantasia', $this->nome_fantasia->__get('nome_fantasia'));
		$stmt->bindValue(':cnpj', $this->cnpj->__get('cnpj'));
		$stmt->bindValue(':ie', $this->ie->__get('ie'));
		$stmt->bindValue(':endereco', $this->endereco->__get('endereco'));
		$stmt->bindValue(':cidade_id', $this->cidade_id->__get('cidade_id'));
		$stmt->bindValue(':cep', $this->cep->__get('cep'));
		$stmt->execute();
	}
	public function recuperar($limit, $offset) {
			$query = "select tb_empresa.id, tb_empresa.razao_social, tb_empresa.nome_fantasia, tb_empresa.cnpj, tb_empresa.ie, tb_empresa.endereco, tb_empresa.cidade_id, tb_empresa.cep, tb_cidade.cidade from tb_empresa, tb_cidade WHERE tb_empresa.cidade_id = tb_cidade.id order by tb_empresa.razao_social, tb_empresa.nome_fantasia, tb_empresa.cnpj, tb_empresa.ie, tb_empresa.id limit $limit offset $offset";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperar2() {
			$query = "select tb_empresa.id, tb_empresa.razao_social, tb_empresa.nome_fantasia, tb_empresa.cnpj, tb_empresa.ie, tb_empresa.endereco, tb_empresa.cidade_id, tb_empresa.cep, tb_cidade.cidade from tb_empresa, tb_cidade WHERE tb_empresa.cidade_id = tb_cidade.id order by tb_empresa.nome_fantasia";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function recuperartotal() {
			$query = "select * from tb_empresa";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
		}
	public function recuperarName() {
		$query = 'select id, razao_social, nome_fantasia, cnpj, ie, endereco, cidade_id, cep from tb_empresa where razao_social = :razao_social';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':razao_social', $_POST['razao_social']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); 
	}

	public function atualizar() {
		$query = 'update tb_empresa set razao_social = :razao_social, nome_fantasia = :nome_fantasia, cnpj = :cnpj, ie = :ie, endereco = :endereco, cidade_id = :cidade_id, cep = :cep where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':razao_social', $this->razao_social->__get('razao_social'));
		$stmt->bindValue(':nome_fantasia', $this->nome_fantasia->__get('nome_fantasia'));
		$stmt->bindValue(':cnpj', $this->cnpj->__get('cnpj'));
		$stmt->bindValue(':ie', $this->ie->__get('ie'));
		$stmt->bindValue(':endereco', $this->endereco->__get('endereco'));
		$stmt->bindValue(':cidade_id', $this->cidade_id->__get('cidade_id'));
		$stmt->bindValue(':cep', $this->cep->__get('cep'));
		$stmt->bindValue(':id', $_POST['id']);
		return $stmt->execute();
	}
	public function remover() {
		$query = 'delete from tb_empresa where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_GET['id']);
		return $stmt->execute();
	}
}

?>