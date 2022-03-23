<?php
	require "../../../app_controle_ativos/retorno/retorno.model.php";
	require "../../../app_controle_ativos/retorno/retorno.service.php";

	require "../../../app_controle_ativos/ativo/ativo.model.php";
	require "../../../app_controle_ativos/ativo/ativo.service.php";
	require "../../../app_controle_ativos/ativo/ativo.service.bloqueio.php";

	require "../../../app_controle_ativos/remessa/remessa.model.php";
	require "../../../app_controle_ativos/remessa/remessa.service.php";
	require "../../../app_controle_ativos/remessa/remessa.service.status.php";
	require "../../../app_controle_ativos/conexao.php";
	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/
	
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
 	
	$nfretorno = new Retorno(); 
	$emissaoret = new Retorno();
	$remessa_id = new Retorno();
	$dataRetorno = new Retorno();
	$observacao = new Retorno();
	$conexao = new Conexao();
	$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret,$dataRetorno, $observacao, $remessa_id);
	$total_registros = $retornoService->recuperartotal();
	$itens_por_pagina = 9;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {
		require "../menu_rodape/cond_paginacao.php";
	}
	
	$acao9 = isset($_GET['acao9']) ? $_GET['acao9'] : $acao9;
	
	if ( $acao9 =='inserir') {
		$nfretorno = new Retorno(); 
		$emissaoret = new Retorno();
		$remessa_id = new Retorno();
		$dataRetorno = new Retorno();
		$observacao = new Retorno();
		$nfretorno->__set('nfretorno', $_POST['nfretorno']);
		$emissaoret->__set('emissaoret', date('Y/m/d', strtotime('+0 days', strtotime($_POST['emissaoret']))));
		$dataRetorno->__set('dataRetorno', date('Y/m/d', strtotime('+0 days', strtotime($_POST['dataRetorno']))));
		$observacao->__set('observacao', $_POST['observacao']);
		$remessa_id->__set('remessa_id', $_POST['remessa_id']);
		$conexao = new Conexao();
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornoService->inserir();
		
		
		$idr = new Remessa();
		$status_id = new Remessa();
		$idr->__set('idr', $_POST['remessa_id']);
		$status_id->__set('status_id', 2); 
		$conexao = new Conexao();
		$remessaServiceStatus = new RemessaServiceStatus($conexao, $status_id);
		$remessaServiceStatus->UpdateStatus();

		$a_id = new Ativo();
		$bloqueio = new Ativo();
		$a_id->__set('a_id', $_POST['ativo_id']);
		$bloqueio->__set('bloqueio', 1); 
		$conexao = new Conexao();
		$ativoServiceBloqueio = new AtivoServiceBloqueio($conexao, $bloqueio);
		$ativoServiceBloqueio->bloqueio();

		header('location: ../obj/todos.retornos.php?pagina=1');
	} else if ($acao9 == 'recuperar') {
		$nfretorno = new Retorno();  
		$emissaoret = new Retorno();
		$remessa_id = new Retorno();
		$dataRetorno = new Retorno();
		$observacao = new Retorno();
		$conexao = new Conexao();
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornos = $retornoService->recuperar($itens_por_pagina, $deslocamento);
		
	}else if($acao9 == 'remover') {

		$idr = new Remessa();
		$status_id = new Remessa();
		$idr->__set('idr', $_GET['remessa_id']);
		$status_id->__set('status_id', 1); 
		$conexao = new Conexao();
		$remessaServiceStatus = new RemessaServiceStatus($conexao, $status_id);
		$remessaServiceStatus->UpdateStatusD();

		
		$a_id = new Ativo();
		$bloqueio = new Ativo();
		$a_id->__set('a_id', $_GET['ativo_id']);
		$bloqueio->__set('bloqueio', 2); 
		$conexao = new Conexao();

		$ativoServiceBloqueio = new AtivoServiceBloqueio($conexao, $bloqueio);
		$ativoServiceBloqueio->desbloqueio();

		$id = new Retorno();
		$nfretorno = new Retorno(); 
		$emissaoret = new Retorno();
		$remessa_id = new Retorno();
		$dataRetorno = new Retorno();
		$observacao = new Retorno();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornoService->remover();
		
		header('location: ../obj/todos.retornos.php?pagina=1&delete=success&id='.$_GET['id']);
	}else if ($acao9 == 'recuperarPorAtivo') {
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
		
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornos = $retornoService->recuperarPorColuna($coluna, $conteudo);	
	} else if ($acao9 == 'recuperarbydate') { 
		if ($pesqData == 0 || $pesqData == 1) {
			$coluna = 'r.emissao';
		}  else if ($pesqData == 2) {
			$coluna = 'rt.dataRetorno';
		}
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornos = $retornoService->recuperarbydate($coluna, $data_inicial, $data_final);
	} else if ($acao9 == 'recuperarbynfe') { 
		
		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		$retornos = $retornoService->recuperarbynfe($nfe);
	} else if($acao9 == 'atualizar') {
		
		$nfretorno->__set('nfretorno', $_POST['nfretorno']);
		$emissaoret->__set('emissaoret', date('Y/m/d', strtotime('+0 days', strtotime($_POST['emissaoret']))));
		$dataRetorno->__set('dataRetorno', date('Y/m/d', strtotime('+0 days', strtotime($_POST['dataRetorno']))));
		$observacao->__set('observacao', $_POST['observacao']);
		$remessa_id->__set('remessa_id', $_POST['remessa_id']);
		$conexao = new Conexao();

		$retornoService = new RetornoService($conexao, $nfretorno, $emissaoret, $dataRetorno,$observacao,$remessa_id);
		if($retornoService->atualizar()) {
			header('location: ../obj/todos.retornos.php?pagina=1');
		}
	}	
?>
