<?php
	require "../../../app_controle_ativos/empresa/empresa.model.php";
	require "../../../app_controle_ativos/empresa/empresa.service.php";
	require_once "../../../app_controle_ativos/conexao.php";

	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';*/

	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	/*echo '<pre>';
	print_r($pagina);
	echo '</pre>';*/

	$razao_social = new Empresa();
	$nome_fantasia = new Empresa();
	$cnpj = new Empresa();
	$ie = new Empresa();
	$endereco = new Empresa();
	$cidade_id = new Empresa();
	$cep = new Empresa();
	$conexao = new Conexao();
	$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
	$total_registros = $empresaService->recuperartotal();
	$itens_por_pagina = 10;
	$numero_paginas = ceil($total_registros/$itens_por_pagina);
	$deslocamento = (($pagina - 1)*$itens_por_pagina);
	$reg_pagina_atual = (($total_registros/$itens_por_pagina)-($pagina-1))*$itens_por_pagina;
	/*echo '<pre>';
	echo 'Página: '.$pagina.' | Total de registros por página '.$itens_por_pagina.' | Deslocamento: '.$deslocamento.' | Total de registros: '.$total_registros;
	echo '</pre>';*/
	$total = $numero_paginas;
	$total_reg = $total_registros;
	If (isset($view)){require "../menu_rodape/cond_paginacao.php";}
	$acao6 = isset($_GET['acao6']) ? $_GET['acao6'] : $acao6;



	if ( $acao6 =='inserir') {

		$razao_social = new Empresa();
		$nome_fantasia = new Empresa();
		$cnpj = new Empresa();
		$ie = new Empresa();
		$endereco = new Empresa();
		$cidade_id = new Empresa();
		$cep = new Empresa();

		$razao_social->__set('razao_social', $_POST['razao_social']);
		$nome_fantasia->__set('nome_fantasia', $_POST['nome_fantasia']);
		$cnpj->__set('cnpj', $_POST['cnpj']);
		$ie->__set('ie', $_POST['ie']);
		$endereco->__set('endereco', $_POST['endereco']);
		$cidade_id->__set('cidade_id', $_POST['cidade_id']);
		$cep->__set('cep', $_POST['cep']);
		$conexao = new Conexao();
		$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
		$empresaService->inserir();

		header('location: ../obj/empresa.php?inclusao=1');

	} else if ($acao6 == 'recuperar') {
		$razao_social = new Empresa();
		$nome_fantasia = new Empresa();
		$cnpj = new Empresa();
		$ie = new Empresa();
		$endereco = new Empresa();
		$cidade_id = new Empresa();
		$cep = new Empresa();
		$conexao = new Conexao();
		$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
		$empresas = $empresaService->recuperar($itens_por_pagina, $deslocamento);

	} else if ($acao6 == 'recuperar2') {
		$razao_social = new Empresa();
		$nome_fantasia = new Empresa();
		$cnpj = new Empresa();
		$ie = new Empresa();
		$endereco = new Empresa();
		$cidade_id = new Empresa();
		$cep = new Empresa();
		$conexao = new Conexao();
		$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
		$empresas = $empresaService->recuperar2();
		/*echo '<pre>';
		print_r($empresas);
		echo '</pre>';*/
	} else if($acao6 == 'atualizar') {
		$id = new Empresa();
		$razao_social = new Empresa();
		$nome_fantasia = new Empresa();
		$cnpj = new Empresa();
		$ie = new Empresa();
		$endereco = new Empresa();
		$cidade_id = new Empresa();
		$cep = new Empresa();

		$id->__set('id', $_POST['id']);
		$razao_social->__set('razao_social', $_POST['razao_social']);
		$nome_fantasia->__set('nome_fantasia', $_POST['nome_fantasia']);
		$cnpj->__set('cnpj', $_POST['cnpj']);
		$ie->__set('ie', $_POST['ie']);
		$endereco->__set('endereco', $_POST['endereco']);
		$cidade_id->__set('cidade_id', $_POST['cidade_id']);
		$cep->__set('cep', $_POST['cep']);
		$conexao = new Conexao();

		$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
		if($empresaService->atualizar()) {
			header('location: ../obj/todas.empresas.php?pagina=1');
		}
	}else if($acao6 == 'remover') {
		$id = new Empresa();
		$razao_social = new Empresa();
		$nome_fantasia = new Empresa();
		$cnpj = new Empresa();
		$ie = new Empresa();
		$endereco = new Empresa();
		$cidade_id = new Empresa();
		$cep = new Empresa();
		$id->__set('id',$_GET['id']);
		$conexao = new Conexao();
		$empresaService = new EmpresaService($conexao, $razao_social, $nome_fantasia, $cnpj, $ie, $endereco, $cidade_id, $cep);
		$empresaService->remover();
		header('location: ../obj/todas.empresas.php?pagina=1&delete=success&id='.$_GET['id']);
	}
?>
