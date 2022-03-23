<?php

	require "../../../app_controle_ativos/cidade/cidade.model.php";
	require "../../../app_controle_ativos/cidade/cidade.service.php";
	require "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$cidade = new Cidade();
	$estado_id = new Cidade();
	$conexao = new Conexao();
	$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
	$total_registros = $cidadeService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	$total_registros_at = $deslocamento + $itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros. ' | ' . $itens_por_pagina.' de '. $total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	require "../menu_rodape/cond_paginacao.php";
	$acao3 = isset($_GET['acao3']) ? $_GET['acao3'] : $acao3;

	if ( $acao3 == 'inserir') {
		$cidade = new Cidade();
		$estado_id = new Cidade();
		$cidade->__set('cidade', $_POST['cidade']);
		$estado_id->__set('estado_id', $_POST['estado_id']);
		$conexao = new Conexao();
		$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
		$cidadeService->inserir();

		header('location: ../obj/cidade.php?inclusao=1');

	} else if ($acao3 == 'recuperar') {
		$cidade = new Cidade();
		$estado_id = new Cidade();
		$conexao = new Conexao();
		$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
		$cidades = $cidadeService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao3 == 'recuperar2') {
		$cidade = new Cidade();
		$estado_id = new Cidade();
		$conexao = new Conexao();
		$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
		$cidades = $cidadeService->recuperar2();


	} else if($acao3 == 'atualizar') {

		$id = new Cidade();
		$cidade = new Cidade();
		$estado_id = new Cidade();
		$id->__set('id', $_POST['id']);
		$cidade->__set('cidade', $_POST['cidade']);
		$estado_id->__set('estado_id', $_POST['estado_id']);

		$conexao = new Conexao();

		$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
		if($cidadeService->atualizar()) {
			header('location: ../obj/todas.cidades.php?pagina=1');
		}
	}else if($acao3 == 'remover') {
		$id = new Cidade();
		$cidade = new Cidade();
		$estado_id = new Cidade();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$cidadeService = new CidadeService($conexao, $cidade, $estado_id);
		$cidadeService->remover();
		header('location: ../obj/todas.cidades.php?pagina=1&delete=success&id='.$_GET['id']);
	}
?>
