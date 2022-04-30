<?php
	require "../../../app_controle_ativos/ativo/ativo.model.php";
	require "../../../app_controle_ativos/ativo/ativo.service.php";

	require "../../../app_controle_ativos/remessa/remessa.model.php";
	require "../../../app_controle_ativos/remessa/remessa.service.php";

	require_once "../../../app_controle_ativos/conexao.php"; 

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$ativo = new Ativo();
	$descricao = new Ativo();
	$eam = new Ativo();
	$placa = new Ativo();
	$chassi = new Ativo();
	$empresa_id = new Ativo();
	$categoria_id = new Ativo();
	$bloqueio = new Ativo();
	$conexao = new Conexao();
	$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
	
	$total_registros = $ativoService->recuperartotal();
	
		/*echo '<pre>';
		print_r("total de registros ".$total_registros);
		echo '</pre>';*/
	


	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	/*echo '<pre>';
		print_r("total_registros ".$total_registros);
		print_r(" itens_por_pagina  ".$itens_por_pagina);
		print_r(" Numero de paginas ".$numero_paginas);
		echo '</pre>';*/
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros.' | Número de páginas '.$numero_paginas;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {require "../menu_rodape/cond_paginacao.php";}
	/*if ($pagina < $numero_paginas) {
		$total_em_tela = $itens_por_pagina * $pagina;
	} else if ($pagina = $numero_paginas) {
		// $total_em_tela = $total_registros - (($pagina - 1) * $total_registros);
		$total_em_tela = ($total_registros - ($itens_por_pagina *($pagina-1))) + (($pagina - 1) * $itens_por_pagina); 
	}*/
	/*echo '<pre>';
	print_r($total_em_tela);
	echo '</pre>';*/ 
	$acao5 = isset($_GET['acao5']) ? $_GET['acao5'] : $acao5;

	if ( $acao5 =='inserir') {
		$ativo = new Ativo();
		$descricao = new Ativo();
		$eam = new Ativo();
		$placa = new Ativo();
		$chassi = new Ativo();
		$empresa_id = new Ativo();
		$ativo->__set('ativo', $_POST['ativo']);
		$descricao->__set('descricao', $_POST['descricao']);
		$eam->__set('eam', $_POST['eam']);
		$placa->__set('placa', $_POST['placa']);
		$chassi->__set('chassi', $_POST['chassi']);
		$bloqueio->__set('bloqueio', 1);
		$empresa_id->__set('empresa_id', $_POST['empresa_id']);
		$categoria_id->__set('categoria_id', $_POST['categoria_id']);
		$conexao = new Conexao();
		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		$ativoService->inserir();

		header('location: ../obj/ativo.php?inclusao=1');

	} else if ($acao5 == 'recuperar') {
		$ativo = new Ativo();
		$descricao = new Ativo();
		$eam = new Ativo();
		$placa = new Ativo();
		$chassi = new Ativo();
		$empresa_id = new Ativo();
		$categoria_id = new Ativo();
		$conexao = new Conexao();
		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		$ativos = $ativoService->recuperar($itens_por_pagina, $deslocamento);
		

	} else if ($acao5 == 'recuperar2') {
		$ativo = new Ativo();
		$descricao = new Ativo();
		$eam = new Ativo();
		$placa = new Ativo();
		$chassi = new Ativo();
		$empresa_id = new Ativo();
		$categoria_id = new Ativo();
		$conexao = new Conexao();
		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		$ativos = $ativoService->recuperar2();
		/*echo '<pre>';
		print_r($ativos);
		echo '</pre>';*/
	} else if ($acao5 == 'recuperarPorEmpresa') {
		$txtid = $_GET['txtid']; 
		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		$ativos = $ativoService->recuperarPorEmpresa($itens_por_pagina, $deslocamento, $txtid);
	} else if ($acao5 == 'recuperarColuna') {

		if ($Selected == 1) {
			$coluna = 'a.descricao';
			$conteudo = "'%".$termo."%'";
		} else if($Selected == 2) {
			$coluna = 'a.eam';
			$conteudo = "'%".$termo."%'";
		} else if($Selected == 3) {
			$coluna = 'a.chassi';
			$conteudo = "'%".$termo."%'";
		} else if($Selected == 4) {
			$coluna = 'a.ativo';
			$conteudo = "'%".$termo."%'";
		} else if($Selected == 5) {
			$coluna = 'a.placa';
			$conteudo = "'%".$termo."%'";
		}
		else if($Selected == 6) {
			$coluna = 'e.nome_fantasia';
			$conteudo = "'%".$termo."%'";
		}
		else if($Selected == 7) {
			$coluna = 'cat.categoria';
			$conteudo = "'%".$termo."%'";
		}
		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		$ativos = $ativoService->recuperarPorColuna($coluna, $conteudo);

		
	} else if($acao5 == 'atualizar') {

		$id = new Ativo();
		$ativo = new Ativo();
		$descricao = new Ativo();
		$eam = new Ativo();
		$placa = new Ativo();
		$chassi = new Ativo();
		$empresa_id = new Ativo();
		$categoria_id = new Ativo();

		$id->__set('id', $_POST['id']);
		$ativo->__set('ativo', $_POST['ativo']);
		$descricao->__set('descricao', $_POST['descricao']);
		$eam->__set('eam', $_POST['eam']);
		$placa->__set('placa', $_POST['placa']);
		$chassi->__set('chassi', $_POST['chassi']);
		$empresa_id->__set('empresa_id', $_POST['empresa_id']);
		$categoria_id->__set('categoria_id', $_POST['categoria_id']);
		$bloqueio->__set('bloqueio', $_POST['bloqueio']);
		$conexao = new Conexao();

		$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
		
		if($ativoService->atualizar()) {
			header('location: ../obj/todos.ativos.php?pagina=1');
		}
	} else if ($acao5 == 'uploadExcel') {
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
					$ativo = new Ativo();
					$descricao = new Ativo();
					$eam = new Ativo();
					$placa = new Ativo();
					$chassi = new Ativo();
					$empresa_id = new Ativo();
					$categoria_id = new Ativo();

					$ativo->__set('ativo', $linha->getElementsByTagName("Data")->Item(0)->nodeValue);
					$descricao->__set('descricao', $linha->getElementsByTagName("Data")->Item(1)->nodeValue);
					$eam->__set('eam', $linha->getElementsByTagName("Data")->Item(2)->nodeValue);
					$placa->__set('placa', $linha->getElementsByTagName("Data")->Item(3)->nodeValue);
					$chassi->__set('chassi', $linha->getElementsByTagName("Data")->Item(4)->nodeValue);
					$empresa_id->__set('empresa_id', $linha->getElementsByTagName("Data")->Item(5)->nodeValue);
					$categoria_id->__set('categoria_id', $linha->getElementsByTagName("Data")->Item(6)->nodeValue);

					$conexao = new Conexao();
					$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
					$ativoService->inserir();
				}
				$primeira_linha = false;
			}
			header('location: ../obj/todos.ativos.php?pagina=1');
		}
	}else if($acao5 == 'remover') {

		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/
		// ADD ROTINA QUE VERIFICA SE EXISTE REMESSA COM O ID DO ATIVO
		// SE TIVER REMESSA, PENDETE OU CONCLUÍDA,  O DELETE DEVE SER BLOQUEADO
		// SE NÃO EXISTIR NENHUMA REMESSA PODE DELETAR
		$opfiscal_id = new Remessa();
		$notafiscal = new Remessa();
		$valor = new Remessa();
		$emissao = new Remessa();
		$entrada = new Remessa();
		$ativo_id = new Remessa();
		$retorno = new Remessa();
		$origem_id = new Remessa();
		$destino_id = new Remessa();
		$status_id = new Remessa();
		$conexao = new Conexao();
		$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
		$cont = $remessaService->recuperartotalbyAtivo_id($_GET['id']);
		if ($cont > 0 ) {
			header('location: ../obj/todos.ativos.php?pagina=1&error=faleidtodelete&id='.$_GET['id']);
		} else if ($cont == 0) {
			$id = new Ativo();
			$ativo = new Ativo();
			$descricao = new Ativo();
			$eam = new Ativo();
			$placa = new Ativo();
			$chassi = new Ativo();
			$empresa_id = new Ativo();
			$categoria_id = new Ativo();
			$id->__set('id',$_GET['id']);
			$conexao = new Conexao();
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id, $categoria_id, $bloqueio);
			$ativoService->remover();
			header('location: ../obj/todos.ativos.php?pagina=1&delete=success&id='.$_GET['id']);
		}
		
	}
?>