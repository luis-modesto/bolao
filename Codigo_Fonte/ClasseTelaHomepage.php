<?php

require_once "./Usuario.php";
require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "./Solicitacao.php";
require_once "./Convite.php";
require_once "./DataGetter.php";
require_once "./Bolao.php";

session_start();

class Homepage{

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

	function recusarNotificacao(notificacao){
		$user = $_SESSION['globalUser'];
		if($notificacao instanceof Solicitacao){
			$user->responderSolicitacao(false, $notificacao);
		}
		else{
			$user->responderConvite(false, $notificacao);
		}
	}                 

	function exibirBoloes(){
		//recuperar lista de bolões
		$dg = DataGetter::getInstance(); 
		$boloes = $dg->getData('bolao');
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][10])==1){
				//acrescentar boloes[i] no html
			}
		}
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][10])==0){
				//acrescentar boloes[i] no html
			}
		}
	}

	function solicitarParticiparBolao(){
		$user = $_SESSION['globalUser'];
		$user->solicitarParticiparBolao($bolao);
	}
}
?>