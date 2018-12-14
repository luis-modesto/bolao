<?php

require_once "./Aposta.php";
require_once "./Apostador.php";
require_once "./TelaUsuario.php";

class ControllerHistoricoApostas extends TelaUsuario{

	function exibirApostas(){
		//recuperar lista de apostas do usuario
		session_start();
		$user = $_SESSION['globalUser']; 
		$minhasApostas = $user->verificarHistoricoApostas(); //user global
		for ($i = 0; $i<count($minhasApostas); $i++){
			//acrescentar minhasApostas[i] na pagina
		}
	}
}

?>