<?php
	require "../../../app_controle_ativos/pais/pais.model.php";
	require "../../../app_controle_ativos/pais/pais.service.php";
	require "../../../app_controle_ativos/conexao.php";
 
	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$pais = new Pais();
	$sigla = new Pais();
	$conexao = new Conexao();
	$paisService = new PaisService($conexao, $pais, $sigla);
	$total_registros = $paisService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	require "../menu_rodape/cond_paginacao.php";
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if ( $acao =='inserir') {
		$pais = new Pais();
		$sigla = new Pais();
		$pais->__set('pais', $_POST['pais']);
		$sigla->__set('sigla', $_POST['sigla']);

		$conexao = new Conexao();

		$paisService = new PaisService($conexao, $pais, $sigla);
		$paisService->inserir();

		header('location: ../obj/pais.php?inclusao=1');
	} else if ($acao =='uploadExcel') {
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
					$pais = new Pais();
					$sigla = new Pais();

					$pais->__set('pais', $linha->getElementsByTagName("Data")->Item(0)->nodeValue);
					//echo "pais_nome: $pais_nome <br>";

					$sigla->__set('sigla', $linha->getElementsByTagName("Data")->Item(1)->nodeValue);
					//echo "pais_sigla: $pais_sigla <br>";
					//echo "<hr>";

					$conexao = new Conexao();
					$paisService = new PaisService($conexao, $pais, $sigla);
					$paisService->inserir();

					//Inserir o usuário no BD
					//$result_usuario = "INSERT INTO tb_pais (pais_nome, pais_sigla) VALUES ('$pais_nome', '$pais_sigla')";
					//$resultado_usuario = mysqli_query($conexao, $result_usuario);
				}
				$primeira_linha = false;
			}
			header('location: ../obj/todos.paises.php?pagina=1');
		}
	} else if ($acao == 'recuperar') {
		$pais = new Pais();
		$sigla = new Pais();
		$conexao = new Conexao();
		$paisService = new PaisService($conexao, $pais, $sigla);
		$paises = $paisService->recuperar($itens_por_pagina, $deslocamento);
		/*echo '<pre>';
		print_r($paises);
		echo '</pre>';*/
	}else if ($acao == 'recuperar2') {
		$pais = new Pais();
		$sigla = new Pais();
		$conexao = new Conexao();
		$paisService = new PaisService($conexao, $pais, $sigla);
		$paises = $paisService->recuperar2();
	}else if($acao == 'atualizar') {
		$id = new Pais();
		$pais = new Pais();
		$sigla = new Pais();
		$id->__set('id', $_POST['id']);
		$pais->__set('pais', $_POST['pais']);
		$sigla->__set('sigla', $_POST['sigla']);

		$conexao = new Conexao();

		$paisService = new PaisService($conexao, $pais, $sigla);
		if($paisService->atualizar()) {
			header('location: ../obj/todos.paises.php?pagina=1');
		}
	} else if($acao == 'remover') {
		$id = new Pais();
		$pais = new Pais();
		$sigla = new Pais();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$paisService = new PaisService($conexao, $pais, $sigla);
		$paisService->remover();
		header('location: ../obj/todos.paises.php?pagina=1&delete=success&id='.$_GET['id']);
	}
?>
