<?php

require_once "./models/Apostador.php";


class TelaCriaBolao(){
	function confirmarCriacaoBolao($nome, $campeonato, $esporte, $pontosPlacar, $pontosVencedor){
		session_start();
		$user = $_SESSION['globalUser'];
		if($_SESSION['globalIdBolao'] >=1){
			$_SESSION['globalIdBolao']++;
		} 
		else{
			$_SESSION['globalIdBolao'] = 1;
		}
		$id = $_SESSION['globalIdBolao'];
		$_SESSION['idBolaoEscolhido'] = $id;
		$user->criarBolao($id, $nome, $campeonato, $esporte, array(), $user->cpf, array(), array(), $pontosPlacar, $pontosVencedor, 0, true);
	}
}
?>