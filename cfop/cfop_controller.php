<?php

	require "../../../app_controle_ativos/cfop/cfop.model.php";
	require "../../../app_controle_ativos/cfop/cfop.service.php";
	require "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$cfop = new Cfop();
	$descricao = new Cfop();
	$conexao = new Conexao();
	$cfopService = new CfopService($conexao, $cfop, $descricao);
	$total_registros = $cfopService->recuperartotal();
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
	$acao7 = isset($_GET['acao7']) ? $_GET['acao7'] : $acao7;

	if ( $acao7 =='inserir') {
		$cfop = new Cfop();
		$descricao = new Cfop();
		/*$status_id = new Cfop();*/
		$cfop->__set('cfop', $_POST['cfop']);
		$descricao->__set('descricao', $_POST['descricao']);
		$conexao = new Conexao();
		$cfopService = new CfopService($conexao, $cfop, $descricao);
		$cfopService->inserir();

		header('location: ../obj/cfop.php?inclusao=1');

	} else if ($acao7 == 'recuperar') {
		$cfop = new Cfop();
		$descricao = new Cfop();
		$conexao = new Conexao();
		$cfopService = new CfopService($conexao, $cfop, $descricao);
		$cfops = $cfopService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao7 == 'recuperar2') {
		$cfop = new Cfop();
		$descricao = new Cfop();
		$conexao = new Conexao();
		$cfopService = new CfopService($conexao, $cfop, $descricao);
		$cfops = $cfopService->recuperar2();

	}else if($acao7 == 'atualizar') {
		$id = new Cfop();
		$cfop = new Cfop();
		$descricao = new Cfop();	
		$id->__set('id', $_POST['id']);
		$cfop->__set('cfop', $_POST['cfop']);
		$descricao->__set('descricao', $_POST['descricao']);

		$conexao = new Conexao();

		$cfopService = new CfopService($conexao, $cfop, $descricao);
		if($cfopService->atualizar()) {
			header('location: ../obj/todos.cfops.php?pagina=1');
		}
	} else if($acao7 == 'remover') {
		$id = new Cfop();
		$cfop = new Cfop();
		$descricao = new Cfop();	;
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$cfopService = new CfopService($conexao, $cfop, $descricao);
		$cfopService->remover();
		header('location: ../obj/todos.cfops.php?pagina=1&delete=success&id='.$_GET['id']);
	}
	
?>