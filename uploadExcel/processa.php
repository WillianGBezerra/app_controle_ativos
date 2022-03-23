<?php
	
	require "../../../app_controle_ativos/pais/pais.model.php";
	require "../../../app_controle_ativos/pais/pais.service.php";
	require "../../../app_controle_ativos/conexao.php";
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);

	//Verifica se o usuario selecionou um arquivo xml
	if(!empty($_FILES['arquivo']['tmp_name'])){
		$arquivo = new DOMDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);

		$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);

		$primeira_linha = true;

		foreach($linhas as $linha){
			if($primeira_linha == false){
				//$pais_nome = $linha->getElementsByTagName("Data")->Item(0)->nodeValue;
				echo "pais_nome: $pais_nome <br>";

				//$pais_sigla = $linha->getElementsByTagName("Data")->Item(1)->nodeValue;
				echo "pais_sigla: $pais_sigla <br>";
				echo "<hr>";

				$pais = new Pais();
				$sigla = new Pais();
				$pais->__set('pais', $linha->getElementsByTagName("Data")->Item(0)->nodeValue;);
				$sigla->__set('sigla', $linha->getElementsByTagName("Data")->Item(1)->nodeValue);

				$conexao = new Conexao();

				$paisService = new PaisService($conexao, $pais, $sigla);
				$paisService->inserir();

				//Inserir o usuário no BD 
				//$result_usuario = "INSERT INTO tb_pais (pais_nome, pais_sigla) VALUES ('$pais_nome', '$pais_sigla')";
				//$resultado_usuario = mysqli_query($conn, $result_usuario);
			}
			$primeira_linha = false;
		}


	}		
?>