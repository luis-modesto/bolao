<?php

require_once "./models/Usuario.php";
require_once "./models/Apostador.php";
require_once "./models/Administrador.php";
require_once "./models/Solicitacao.php";
require_once "./models/Convite.php";
require_once "./models/DataGetter.php";
require_once "./models/Bolao.php";

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
		$boloes = DataGetter.prototype.getInstance().getData('bolao');
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