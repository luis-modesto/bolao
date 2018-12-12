<?php

require_once "./Apostador.php";
require_once "./Bolao.php";


class TelaCriaBolao{
	function confirmarCriacaoBolao($nome, $campeonato, $esporte, $pontosPlacar, $pontosVencedor){
		session_start();
		$user = $_SESSION['globalUser'];
		$id = $_SESSION['globalIdBolao'];
		if($id >=1){
			$id++;
		} 
		else{
			$id = 1;
		}
		$_SESSION['idBolaoEscolhido'] = $id;
		$b = new Bolao($id, $nome, $campeonato, $esporte, array(), $user->cpf, array(), array(), $pontosPlacar, $pontosVencedor, 0, 1);
		$user->criarBolao($b);
	}
}
?>