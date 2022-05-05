<?php

	require "../../../app_controle_ativos/categoriaativos/categoriaativos.model.php";
	require "../../../app_controle_ativos/categoriaativos/categoriaativos.service.php";
	require_once "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$codigo = new Categoria();
	$categoria = new Categoria();
	$conexao = new Conexao();
	$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
	$total_registros = $categoriaService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	if (isset($view)) {require "../menu_rodape/cond_paginacao.php";}
	$acao10 = isset($_GET['acao10']) ? $_GET['acao10'] : $acao10;

	if ( $acao10 =='inserir') {
		$codigo->__set('codigo', $_POST['codigo']);
		$categoria->__set('categoria', $_POST['categoria']);
		$conexao = new Conexao();
		$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
		$categoriaService->inserir();

		header('location: ../obj/categoria.ativo.php?inclusao=1');

	} else if ($acao10 == 'recuperar') {
		$codigo = new Categoria();
		$categoria = new Categoria();
		$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
		$categorias = $categoriaService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao10 == 'recuperar2') {
		$codigo = new Categoria();
		$categoria = new Categoria();
		$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
		$categorias = $categoriaService->recuperar2();

	}else if($acao10 == 'atualizar') {
		$id = new Categoria();
		$codigo = new Categoria();
		$categoria = new Categoria();	
		$id->__set('id', $_POST['id']);
		$codigo->__set('codigo', $_POST['codigo']);
		$categoria->__set('categoria', $_POST['categoria']);

		$conexao = new Conexao();

		$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
		if($categoriaService->atualizar()) {
			header('location: ../obj/todas.categorias.php?pagina=1');
		}
	} else if($acao10 == 'remover') {
		$id = new Categoria();
		$codigo = new Categoria();
		$categoria = new Categoria();	;
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$categoriaService = new CategoriaService($conexao, $codigo, $categoria);
		$categoriaService->remover();
		header('location: ../obj/todas.categorias.php?pagina=1&delete=success&id='.$_GET['id']);
	}
	
?>