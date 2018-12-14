<?php

require_once "./Usuario.php";
require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "./Solicitacao.php";
require_once "./Convite.php";
require_once "./DataGetter.php";
require_once "./Bolao.php";
require_once "./TelaUsuario.php";

class ControllerHomepage extends TelaUsuario{

	function visualizarNotificacao(){
		// recuperar lista de notificações do usuario 
	}

	function aceitarNotificacao($notificacao){
		$user = $_SESSION['globalUser'];
		if($notificacao instanceof Solicitacao){
			$user->responderSolicitacao(true, $notificacao);
		}
		else{
			$user->responderConvite(true, $notificacao);
		}
	}

	function recusarNotificacao($notificacao){
		$user = $_SESSION['globalUser'];
		if($notificacao instanceof Solicitacao){
			$user->responderSolicitacao(false, $notificacao);
		}
		else{
			$user->responderConvite(false, $notificacao);
		}
	}                 

	function exibirBoloes(){
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$retorno = "";
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][10])==1){
				$user = $_SESSION["globalUser"];
				$meusboloes = $dg->getData('boloes_'.$user->cpf);
				$participo = false;
				for ($j = 0; $j<count($meusboloes); $j++){
					if ($meusboloes[$j][1]==$boloes[$i][0]){
						$participo = true;
						break;
					}
				}
				$soli = $dg->getData('solicitacoesfeitas_'.$user->cpf);
				$solicitei = false;
				for ($j = 0; $j<count($soli); $j++){
					if ($soli[$j][0]==$boloes[$i][0]){
						$solicitei = true;
						break;
					}
				}
				if($participo == false && $solicitei == false){
					$adm = "";
					$users = $dg->getData('usuarios');
					for ($j = 0; $j<count($users); $j++){
						if ($users[$j][0]==$boloes[$i][1]){
							$adm = $users[$j][2];
						}
					}
					$retorno = $retorno.'<li class="list-group-item" onclick = "pegarIdBolao('.$boloes[$i][0].')">
						<h6>'.$boloes[$i][2].'</h6>
						<div class="row">
							<div class="col-12">
								Adm: '.$adm.'
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								Campeonato: '.$boloes[$i][3].'
							</div>
							<div class="col-5">
								Esporte: '.$boloes[$i][4].'
							</div>
						</div>
						
					</li>' . PHP_EOL;
				}
			}
		}
		return $retorno;
	}

	function solicitarParticiparBolao($idbolao){
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$bolao = null;
		for ($i = 0; $i<count($boloes); $i++){
			if ($boloes[$i][0]==$idbolao){
				$jogos = array();
				$jogosBolao = $dg->getData('jogos_' . $boloes[$i][0]);
				for ($k = 0; $k<count($jogosBolao); $k++){
					$placar = new Placar($jogosBolao[$k][5], $jogosBolao[$k][6]);
					$jg = new Jogo($jogosBolao[$k][0], $jogosBolao[$k][1], $jogosBolao[$k][2], $jogosBolao[$k][3], $jogosBolao[$k][4], $placar, intval($jogosBolao[$k][7]));
					array_push($jogos, $jg); 
				}
				$bolao = new Bolao($boloes[$i][0], $boloes[$i][2], $boloes[$i][3], $boloes[$i][4], $jogos, $boloes[$i][1], explode(',', $boloes[$i][5]), explode(',', $boloes[$i][6]), intval($boloes[$i][7]), intval($boloes[$i][8]), intval($boloes[$i][9]), intval($boloes[$i][10]));
				break;
			}
		}
		$user = $_SESSION['globalUser'];
		$user->solicitarParticiparBolao($bolao);
	}
}
?>