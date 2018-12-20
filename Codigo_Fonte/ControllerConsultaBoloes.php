<?php

require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "./TelaUsuario.php";

class ControllerConsultaBoloes extends TelaUsuario{
	
	function exibirBoloes(){
		//recuperar lista de bolões
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		for ($i = 0; $i<count($boloes); $i++){
			if (intvalue($boloes[$i][10])==1){
				//acrescentar boloes[i] no html
			}
		}
		for ($i = 0; $i<count($boloes); $i++){
			if (intvalue($boloes[$i][10])==0){
				//acrescentar boloes[i] no html
			}
		}
	}

	function visualizarBolao(){
		// exporta id do bolao para tela de exibição
	}

	function confirmarExclusao(){
		// se cpf eh de um administrador
		session_start();
		$user = $_SESSION['globalUser'];//global
		if($user instanceof Administrador){
			$user->excluirBolao($bolao);
		}
	}
}

?>