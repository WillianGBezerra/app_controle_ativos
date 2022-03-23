<?php

	require "../../../app_controle_ativos/status/status.model.php";
	require "../../../app_controle_ativos/status/status.service.php";
	require_once "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/
 
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$status = new Status();
	$conexao = new Conexao();
	$statusService = new StatusService($conexao, $status);
	$total_registros = $statusService->recuperartotal();
	$itens_por_pagina = 11;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {require "../menu_rodape/cond_paginacao.php";}
	$acao8 = isset($_GET['acao8']) ? $_GET['acao8'] : $acao8;

	if ( $acao8 =='inserir') {
		$status = new Status();
		$status->__set('status', $_POST['status']);
		$conexao = new Conexao();
		$statusService = new StatusService($conexao, $status);
		$statusService->inserir();

		header('location: ../obj/status.php?inclusao=1');
	}else if ($acao8 == 'recuperar') {
		$status = new Status();
		$conexao = new Conexao();
		$statusService = new StatusService($conexao, $status);
		$t = $statusService->recuperar($itens_por_pagina, $deslocamento);
	}else if ($acao8 == 'recuperar2') {
		$status = new Status();
		$conexao = new Conexao();
		$statusService = new StatusService($conexao, $status);
		$t = $statusService->recuperar2();
	}else if($acao8 == 'atualizar') {
		$id = new Status();
		$status = new Status();	
		$id->__set('id', $_POST['id']);
		$status->__set('status', $_POST['status']);
		$conexao = new Conexao();
		$statusService = new StatusService($conexao, $status);
		if($statusService->atualizar()) {
			header('location: ../obj/todos.status.php?pagina=1');
		}
	}else if($acao8 == 'remover') {
		$id = new Status();
		$status = new Status();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$statusService = new StatusService($conexao, $status);
		$statusService->remover();
		header('location: ../obj/todos.status.php?pagina=1&delete=success&id='.$_GET['id']);
	}	
?>