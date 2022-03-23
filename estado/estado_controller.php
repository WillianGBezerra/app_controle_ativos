<?php
	require "../../../app_controle_ativos/estado/estado.model.php";
	require "../../../app_controle_ativos/estado/estado.service.php";
	require "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';print_r($acao2);echo '</pre>';*/

	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$estado = new Estado();
	$sigla = new Estado();
	$pais_id = new Estado();
	$conexao = new Conexao();
	$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
	$total_registros = $estadoService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros." | Total de páginas: ".$numero_paginas;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	require "../menu_rodape/cond_paginacao.php";
	$acao2 = isset($_GET['acao2']) ? $_GET['acao2'] : $acao2;

	if ( $acao2 =='inserir') {
		$estado = new Estado();
		$sigla = new Estado();
		$pais_id = new Estado();
		$estado->__set('estado', $_POST['estado']);
		$sigla->__set('sigla', $_POST['sigla']);
		$pais_id->__set('pais_id', $_POST['pais_id']);
		$conexao = new Conexao();
		$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
		$estadoService->inserir();

		header('location: ../obj/estado.php?inclusao=1');

	} else if ($acao2 == 'recuperar') {
		$estado = new Estado();
		$sigla = new Estado();
		$pais_id = new Estado();
		$conexao = new Conexao();
		$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
		$estados = $estadoService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao2 == 'recuperar2') {
		$estado = new Estado();
		$sigla = new Estado();
		$pais_id = new Estado();
		$conexao = new Conexao();
		$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
		$estados = $estadoService->recuperar2();

	}else if($acao2 == 'atualizar') {

		$id = new Estado();
		$estado = new Estado();
		$sigla = new Estado();
		$pais_id = new Estado();
		$id->__set('id', $_POST['id']);
		$estado->__set('estado', $_POST['estado']);
		$sigla->__set('sigla', $_POST['sigla']);
		$pais_id->__set('pais_id', $_POST['pais_id']);

		$conexao = new Conexao();

		$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
		if($estadoService->atualizar()) {
			header('location: ../obj/todos.estados.php?pagina=1');
		}
	}else if($acao2 == 'remover') {
		$id = new Estado();
		$estado = new Estado();
		$sigla = new Estado();
		$pais_id = new Estado();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$estadoService = new EstadoService($conexao, $estado, $sigla, $pais_id);
		$estadoService->remover();
		header('location: ../obj/todos.estados.php?pagina=1&delete=success&id='.$_GET['id']);
	}
?>
