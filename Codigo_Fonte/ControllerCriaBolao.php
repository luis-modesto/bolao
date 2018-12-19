<?php

require_once "./Apostador.php";
require_once "./Bolao.php";
require_once "./DataGetter.php";
require_once "./TelaUsuario.php";


class ControllerCriaBolao extends TelaUsuario{
	function confirmarCriacaoBolao($nome, $campeonato, $esporte, $pontosPlacar, $pontosVencedor, $dataFinalizacao){
		$user = $_SESSION['globalUser'];
		$id = rand(); // randomiza um id pro bolao 
		$dg = DataGetter::getInstance(); 
		$boloesuser = $dg->getData('boloes_'.$user->cpf); //instancia o vetor de boloes do usuario
		for($i=0; $i<count($boloesuser); $i++){ // começa a percorrer o vetor de boloes
			if($boloesuser[$i][1] == $id){ // se encontrar o id que tinha randomizado antes
				$id = rand(); //randomiza de novo
				$i = 0; //começa a procurar do começo
			} 
		} //sai do for quando percorrer o vetor todinho e n encontrar o id que tinha antes
		$_SESSION['idBolaoEscolhido'] = $id;
		$b = new Bolao($id, $nome, $campeonato, $esporte, array(), $user->cpf, array(), array(), $pontosPlacar, $pontosVencedor, 0, 1);
		$user->criarBolao($b, $dataFinalizacao);
	}
}
?>