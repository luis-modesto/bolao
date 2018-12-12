<?php

require_once "./models/Aposta.php";
require_once "./models/Apostador.php";

class TelaHistoricoApostas(){

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