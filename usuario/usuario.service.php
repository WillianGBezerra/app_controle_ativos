<?php 
	class UsuarioService {

		private $conexao;
		private $nome;
		private $email;
		private $senha;
		private $status_id;

		private function __construct(Conexao $conexao, Usuario $nome, Usuario $email, Usuario $senha, Usuario $status_id) {
			$this->conexao = $conexao->conectar();
			$this->nome = $nome;
			$this->email = $email;
			$this->senha = $senha;
			$this->status_id = $status_id;
		}
		public function inserir(){
			$query = 'insert into tb_usuario (nome, email, senha, status_id)values(:nome, :email, :senha, :status_id)'
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':nome', $this->nome->__get('nome'));
			$stmt->bindValue(':email', $this->email->__get('email'));
			$stmt->bindValue('senha', $this->senha->__get('senha'));
			$stmt->bindValue('status_id', $this->status_id->__get('status_id'));
			$stmt->execute();
		}
	}
?>