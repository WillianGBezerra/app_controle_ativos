<?php
	require "../../../app_controle_ativos/remessa/remessa.model.php";
	require "../../../app_controle_ativos/remessa/remessa.service.php";
	require "../../../app_controle_ativos/ativo/ativo.model.php";
	require "../../../app_controle_ativos/ativo/ativo.service.php";
	require "../../../app_controle_ativos/ativo/ativo.service.bloqueio.php";
	require "../../../app_controle_ativos/opfiscal/opfiscal.model.php";
	require "../../../app_controle_ativos/opfiscal/opfiscal.service.php";
	
	require_once "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';print_r($acao8);echo '</pre>';*/
	$acao8 = isset($_GET['acao8']) ? $_GET['acao8'] : $acao8;
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	 

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
 
	 
	
	
	if ($acao8 == 'recuperar') {
		$total_registros = $remessaService->recuperartotal();
	} else if ($acao8 == 'inserir') {
		$total_registros = $remessaService->recuperartotal();
	}else if ($acao8 == 'atualizar') {
		$total_registros = $remessaService->recuperartotal();
	} else if ($acao8 == 'recuperarbydate') {
		if ($pesqData == 0 || $pesqData == 1) { $coluna = 'tb_remessa.emissao';
		}  else if ($pesqData == 2) { $coluna = 'tb_remessa.retorno';}
		$total_registros = $remessaService->recuperartotalbydate($coluna, $data_inicial, $data_final);
	} else if ($acao8 == 'recuperarbynfe') {
		$total_registros = $remessaService->recuperartotalbynfe($nfe);
	} else if ($acao8 == 'recuperarPorAtivo') {
		$total_registros = $remessaService->recuperartotal(); 
	}


	
	/*echo '<pre>';
	print_r($numero_paginas);
	echo '</pre>';*/
	

	//$pesqPorcamposTabel = isset($_POST['pesqPorcamposTabel']) ? $_POST['pesqPorcamposTabel'] : $pesqPorcamposTabel;
 	//$ativo_chassi  = isset($_POST['pesqchassi']) ? $_POST['pesqchassi'] : $ativo_chassi;
	/*echo '<pre>';
	print_r($ativo_chassi);
	echo '</pre>';
	/*echo '<pre>';
	print_r($st);
	echo '</pre>';*/
	/*echo '<pre>';
	print_r($acao8);
	echo '</pre>';*/

	//Variaveis para pesquisa com filtro de data
	/*$data_inicial = date('Y/m/d', strtotime('+ 0 days', strtotime(isset($_POST['data_inicial']) ? $_POST['data_inicial'] : 1)));
	$data_final = date('Y/m/d', strtotime('+ 0 days', strtotime(isset($_POST['data_final']) ? $_POST['data_final'] : 1)));*/

	//$data_inicial =isset($_POST['data_inicial']) ? $_POST['data_inicial'] : 1;
	//$data_final = isset($_POST['data_final']) ? $_POST['data_final'] : 1;
	

	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);

	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros." | Total de páginas: ".$numero_paginas;
	echo '</pre>';*/
	
	$tipom = isset($_GET['tipoM']) ? $_GET['tipoM'] : 1;
	$st = isset($_GET['st']) ? $_GET['st'] : 1;
 
	//$total_em_tela = $pagina * $itens_por_pagina;
	
	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {require "../menu_rodape/cond_paginacao.php";}
	/*if ($pagina < $numero_paginas) {
		$total_em_tela = $itens_por_pagina * $pagina;
	} else if ($pagina = $numero_paginas) {
		// $total_em_tela = $total_registros - (($pagina - 1) * $total_registros);
		$total_em_tela = ($total_registros - ($itens_por_pagina *($pagina-1))) + (($pagina - 1) * $itens_por_pagina); 
	}*/
	
	//$_SESSION['acao8'] = isset($_GET['acao8']) ? $_GET['acao8'] : $acao8;
	/*echo '<pre>';
	print_r($_SESSION['acao8']); 
	echo '</pre>';*/
	if ( $acao8 =='inserir') {
		function prazo() {
		$query = 'select prazo from tb_opfiscal where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_POST['opfiscal_id']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		$id = new Opfiscal();
		$descricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal(); 	
		$id->__set('id',$_POST['opfiscal_id']);
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $descricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscais = $opfiscalService->prazo();
		$retorno = date('Y/m/d', strtotime('+'.$opfiscais[0]->prazo.' days', strtotime($_POST['emissao'])));
		/*echo '<pre>';
		print_r($opfiscais[0]->prazo);
		echo '</pre>';*/
		/*var_dump($opfiscais);
		
		echo '<pre>';
		print_r($retorno);
		echo '</pre>';*/

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

		$opfiscal_id->__set('opfiscal_id', $_POST['opfiscal_id']);
		$notafiscal->__set('notafiscal', $_POST['notafiscal']);
		$valor->__set('valor', $_POST['valor']);
		$emissao->__set('emissao', $_POST['emissao']);
		$entrada->__set('entrada', $_POST['entrada']);
		$ativo_id->__set('ativo_id', $_POST['ativo_id']);
		$retorno->__set('retorno', date('Y/m/d', strtotime('+'.$opfiscais[0]->prazo.' days', strtotime($_POST['emissao']))));
		$origem_id->__set('origem_id', $_POST['origem_id']);
		$destino_id->__set('destino_id', $_POST['destino_id']);
		$status_id->__set('status_id', 1);
		/*echo '<pre>';
		print_r('teste1');
		print_r($retorno);
		echo '</pre>';*/

		if ($origem_id == $destino_id) {
			header('location: ../obj/remessa.php?error=1');
		} else if ($origem_id != $destino_id) {
			$conexao = new Conexao();
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessaService->inserir();
 
			$a_id = new Ativo();
			$bloqueio = new Ativo();
			$a_id->__set('a_id', $_POST['ativo_id']);
			$bloqueio->__set('bloqueio', 2); 
			$conexao = new Conexao();

			$ativoServiceBloqueio = new AtivoServiceBloqueio($conexao, $bloqueio);
			$ativoServiceBloqueio->bloqueio();

			header('location: ../obj/remessa.php?inclusao=1');
		}
	} else if ($acao8 =='uploadExcel') {
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

					$opfiscal_id->__set('opfiscal_id', $linha->getElementsByTagName("Data")->Item(0)->nodeValue);
					$notafiscal->__set('notafiscal', $linha->getElementsByTagName("Data")->Item(1)->nodeValue);
					$valor->__set('valor', $linha->getElementsByTagName("Data")->Item(2)->nodeValue);
					$emissao->__set('emissao', $linha->getElementsByTagName("Data")->Item(3)->nodeValue);
					$entrada->__set('entrada', $linha->getElementsByTagName("Data")->Item(4)->nodeValue);
					$ativo_id->__set('ativo_id', $linha->getElementsByTagName("Data")->Item(5)->nodeValue);
					$retorno->__set('retorno', $linha->getElementsByTagName("Data")->Item(6)->nodeValue);
					$origem_id->__set('origem_id', $linha->getElementsByTagName("Data")->Item(7)->nodeValue);
					$destino_id->__set('destino_id', $linha->getElementsByTagName("Data")->Item(8)->nodeValue);
					$status_id->__set('status_id', $linha->getElementsByTagName("Data")->Item(9)->nodeValue);
					

					$conexao = new Conexao();
					$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
					$remessaService->inserir();
				}
				$primeira_linha = false;
			}
			header('location: ../obj/todas.remessas.php?pagina=1');
		}
	} else if ($acao8 == 'recuperar') {  
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
		$remessas = $remessaService->recuperar($itens_por_pagina, $deslocamento);
		/*echo '<pre>';
		print_r($remessas);
		echo '</pre>';*/
	} else if ($acao8 == 'recuperarbydate') {
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

		if ($pesqData == 0 || $pesqData == 1) {
			$coluna = 'r.emissao';
		}  else if ($pesqData == 2) {
			$coluna = 'r.retorno';
		}

		$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
		$remessas = $remessaService->recuperarbydate($itens_por_pagina, $deslocamento, $coluna, $data_inicial, $data_final);
		
		
	} else if ($acao8 == 'recuperarbynfe') {
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
		$remessas = $remessaService->recuperarbynfe($nfe);
	} else if ($acao8 == 'recuperarPorAtivo') {

		/*
		if ($txt_ativoopcao == 1) {
			$coluna = 'a.descricao';
			$conteudo = "'%".$txt_descricao."%'";
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
		} else if($txt_ativoopcao == 2) {
			$coluna = 'a.eam';
			$conteudo = "'%".$txt_eam."%'";
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
		} else if($txt_ativoopcao == 3) {
			$coluna = 'a.chassi';
			$conteudo = "'%".$txt_chassi."%'";
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
		} else if($txt_ativoopcao == 4) {
			$coluna = 'a.ativo';
			$conteudo = "'%".$txt_ativo."%'";
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
		} else if($txt_ativoopcao == 5) {
			$coluna = 'a.placa';
			$conteudo = "'%".$txt_placa."%'";
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
		}
		*/
		if ($txt_ativoopcao == 1) {
			$coluna = 'a.descricao';
			$conteudo = "'%".$txt_descricao."%'";
		} else if($txt_ativoopcao == 2) {
			$coluna = 'a.eam';
			$conteudo = "'%".$txt_eam."%'";
		} else if($txt_ativoopcao == 3) {
			$coluna = 'a.chassi';
			$conteudo = "'%".$txt_chassi."%'";
		} else if($txt_ativoopcao == 4) {
			$coluna = 'a.ativo';
			$conteudo = "'%".$txt_ativo."%'";
		} else if($txt_ativoopcao == 5) {
			$coluna = 'a.placa';
			$conteudo = "'%".$txt_placa."%'";
		}else if($txt_ativoopcao == 6) {
			$coluna = 'e.nome_fantasia';
			$conteudo = "'%".$txt_empresa."%'";
		}else if($txt_ativoopcao == 7) {
			$coluna = 'em.nome_fantasia';
			$conteudo = "'%".$txt_empresa."%'";
		}

		$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
		$remessas = $remessaService->recuperarPorColuna($itens_por_pagina, $deslocamento, $coluna, $conteudo);
			
	} else if ($acao8 == 'recuperarbyMovStatus') {
		if ($tipoMov == 1 || $tipoMov == 2) {
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarPorMovStatus($tipoMov, $stRegistro);
		} else if ($tipoMov == 0) {
			$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
			$remessas = $remessaService->recuperarTodos($itens_por_pagina, $deslocamento);
		}
	}
	else if ($acao8 == 'recuperarPorMovEeStatus') {
			if ($tipom ==1 ) {
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
				$remessas = $remessaService->recuperarPorMovEeStatus($itens_por_pagina, $deslocamento, $tipom, $st);
				header('location: ../obj/todas.remessas.php?acao8=recuperarPorMovEStatus&pagina=1&?tipom=$tipom&?st=$st');
	  		}
	} else if ($acao8 == 'recuperarPorMovSeStatus') {
			If($tipom ==2){
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
				$remessas = $remessaService->recuperarPorMovSeStatus($itens_por_pagina, $deslocamento, $tipom, $st);
				header('location: ../obj/todas.remessas.php?acao8=recuperarPorMovSeStatus&pagina=1');
			}
	} else if ($acao8 == 'recuperarTotalCsv') {
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
				$remessas = $remessaService->recuperarPorMovSeStatus($itens_por_pagina, $deslocamento);
				header('location: ../obj/todas.remessas.php?acao8=reportcsv&pagina=1');
	} else if ($acao8 == 'recuperar2') {
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
		$remessas = $remessaService->recuperar2(); 
	} else if ($acao8 == 'reportpdfEntrada') {
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
		$remessas = $remessaService->reportpdfEntrada($itens_por_pagina, $deslocamento, $tipom, $st);  
	} else if ($acao8 == 'reportpdfSaida') {
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
		$remessas = $remessaService->reportpdfSaida($itens_por_pagina, $deslocamento, $tipom, $st); 
		header('location: ../obj/todas.remessas.php?pagina=1&tipom=$tipom&st=$st');
	} else if($acao8 == 'atualizar') {
		function prazo() {
		$query = 'select prazo from tb_opfiscal where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$_POST['opfiscal_id']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		$id = new Opfiscal();
		$descricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();	
		$id->__set('id',$_POST['opfiscal_id']);
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $descricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscais = $opfiscalService->prazo();
		$retorno = date('Y/m/d', strtotime('+'.$opfiscais[0]->prazo.' days', strtotime($_POST['emissao'])));
		
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
		$opfiscal_id->__set('opfiscal_id', $_POST['opfiscal_id']);
		$notafiscal->__set('notafiscal', $_POST['notafiscal']);
		$valor->__set('valor', $_POST['valor']);
		$emissao->__set('emissao', $_POST['emissao']);
		$entrada->__set('entrada', $_POST['entrada']);
		$ativo_id->__set('ativo_id', $_POST['ativo_id']);
		$retorno->__set('retorno', date('Y/m/d', strtotime('+'.$opfiscais[0]->prazo.' days', strtotime($_POST['emissao']))));
		$origem_id->__set('origem_id', $_POST['origem_id']);
		$destino_id->__set('destino_id', $_POST['destino_id']);
		$status_id->__set('status_id', $_POST['status_id']);

		$conexao = new Conexao();

		$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
		if($remessaService->atualizar()) {
			$a_id = new Ativo();
			$bloqueio = new Ativo();
			$a_id->__set('a_id', $_POST['ativo_id']);
			$bloqueio->__set('bloqueio', 2); 
			$conexao = new Conexao();

			$ativoServiceBloqueio = new AtivoServiceBloqueio($conexao, $bloqueio);
			$ativoServiceBloqueio->bloqueio();
			header('location: ../obj/todas.remessas.php?pagina=1');
		}
	} else if($acao8 == 'remover') {

		
		
		$a_id = new Ativo();
		$bloqueio = new Ativo();
		$a_id->__set('a_id', $_GET['ativo_id']);
		$bloqueio->__set('bloqueio', 1); 
		$conexao = new Conexao();

		$ativoServiceBloqueio = new AtivoServiceBloqueio($conexao, $bloqueio);
		$ativoServiceBloqueio->desbloqueio();

		$id = new Remessa(); 
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
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$remessaService = new RemessaService($conexao, $opfiscal_id, $notafiscal, $valor, $emissao, $entrada, $ativo_id, $retorno, $origem_id, $destino_id, $status_id);
		$remessaService->remover();

		
		header('location: ../obj/todas.remessas.php?pagina=1&delete=success&id='.$_GET['id']);
	}
?>
