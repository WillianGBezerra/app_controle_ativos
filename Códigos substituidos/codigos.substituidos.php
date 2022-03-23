<?php 
	//Remessa.Controller
	else if ($acao8 == 'recuperarPorAtivo') {
		if ($ativoopcao == 4) {
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
			$remessas = $remessaService->recuperarPorChassi($itens_por_pagina, $deslocamento, $ativo_chassi);
		}
		if ($ativoopcao == 5) {
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
			$remessas = $remessaService->recuperarPorN_Ativo($itens_por_pagina, $deslocamento, $n_ativo);
		}
		if ($ativoopcao == 6) {
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
			$remessas = $remessaService->recuperarPorPlaca($itens_por_pagina, $deslocamento, $placa);
		}
	}
	//Remessa.Ativo
	if ($txt_ativoopcao == 1) {
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id);
			$ativos = $ativoService->recuperarPorDescricao($txt_descricao);
		} else if ($txt_ativoopcao == 2) {
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id);
			$ativos = $ativoService->recuperarPoream($txt_eam);
		} else if ($txt_ativoopcao == 3) {
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id);
			$ativos = $ativoService->recuperarPorChassi($itens_por_pagina, $deslocamento, $txt_chassi);
		}else if ($txt_ativoopcao == 4) {
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id);
			$ativos = $ativoService->recuperarPorDescricao($txt_ativo);
		}else if ($txt_ativoopcao == 5) {
			$ativoService = new AtivoService($conexao, $ativo, $descricao, $eam, $placa, $chassi, $empresa_id);
			$ativos = $ativoService->recuperarPorDescricao($txt_placa);
		}	
 ?>