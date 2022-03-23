<?php

	require "../../../app_controle_ativos/opfiscal/opfiscal.model.php";
	require "../../../app_controle_ativos/opfiscal/opfiscal.service.php";
	require_once "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
 
	$opdescricao = new Opfiscal();
	$sigla_op_fiscal = new Opfiscal();
	$cfop_id = new Opfiscal();
	$prazo = new Opfiscal();
	$conexao = new Conexao();
	$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
	$total_registros = $opfiscalService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	$total_registros_at = $deslocamento + $itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros. ' | ' . $itens_por_pagina.' de '. $total_registros_at;
	echo '</pre>';*/
	/*echo '<pre>';
	print_r($pagina);
	echo '</pre>';
	echo '<pre>';
	print_r($numero_paginas);
	echo '</pre>';*/

	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {require "../menu_rodape/cond_paginacao.php";}
	$acao4 = isset($_GET['acao4']) ? $_GET['acao4'] : $acao4;

	if ( $acao4 =='inserir') {
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();
		$opdescricao->__set('opdescricao', $_POST['opdescricao']);
		$sigla_op_fiscal->__set('sigla_op_fiscal', $_POST['sigla_op_fiscal']);
		$cfop_id->__set('cfop_id', $_POST['cfop_id']);
		$prazo->__set('prazo', $_POST['prazo']);
		$conexao = new Conexao();
		

		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscalService->inserir();

		header('location: ../obj/opfiscal.php?inclusao=1');

	} else if ($acao4 == 'recuperar') {
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscais = $opfiscalService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao4 == 'recuperar2') {
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscais = $opfiscalService->recuperar2();

	} else if($acao4 == 'atualizar') { 
		$id = new Opfiscal();
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();	
		$id->__set('id', $_POST['id']);
		$opdescricao->__set('opdescricao', $_POST['opdescricao']);
		$sigla_op_fiscal->__set('sigla_op_fiscal', $_POST['sigla_op_fiscal']);
		$cfop_id->__set('cfop', $_POST['cfop_id']);
		$prazo->__set('prazo', $_POST['prazo']);

		$conexao = new Conexao();

		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		if($opfiscalService->atualizar()) {
			header('location: ../obj/todas.opfiscais.php?pagina=1');
		}
	} else if($acao4 == 'remover') {
		$id = new Opfiscal();
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();	
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscalService->remover();
		header('location: ../obj/todas.opfiscais.php?pagina=1&delete=success&id='.$_GET['id']);
	}else if($acao4 == 'prazo') {
		$id = new Opfiscal();
		$opdescricao = new Opfiscal();
		$sigla_op_fiscal = new Opfiscal();
		$cfop_id = new Opfiscal();
		$prazo = new Opfiscal();	
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$opfiscalService = new OpfiscalService($conexao, $opdescricao, $sigla_op_fiscal, $cfop_id, $prazo);
		$opfiscalService->prazo();
		header('location: ../obj/todas.opfiscais.php?pagina=1');
	}
?>