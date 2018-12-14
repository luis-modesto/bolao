<?php

require_once "./Apostador.php";
require_once "./Jogo.php";
require_once "./TelaUsuario.php";

class ControllerCriaJogo extends TelaUsuario{

	function confirmarCriacaoJogo($dataJogo, $dataLimite, $time1, $time2, $aposta){
		session_start();
		$user = $_SESSION['globalUser']; //global 
		// id do bolao vai estar armazenado em idBolaoEscolhido, pq se for num bolao que a pessoa acabou de criar, o id dele eh armazenado la na classe de criar bolao e se for um q ela escolheu pra colocar o id eh armazenado no controller de exibiçao do bolao
		$idjogo = rand();
		$jogosbolao = $dg->getData('jogos_'.$_SESSION['idBolaoEscolhido']); //instancia o vetor de boloes do usuario
		for($i=0; $i<count($jogosbolao); $i++){ // começa a percorrer o vetor de jogos do bolao
			if($jogosbolao[$i][1] == $idjogo){ // se encontrar o id que tinha randomizado antes
				$idjogo = rand(); //randomiza de novo
				$i = 0; //começa a procurar do começo
			} 
		} //sai do for quando percorrer o vetor todinho e n encontrar o id que tinha antes		
		$jogo = new Jogo($idjogo, $datajogo, $datalimite, $time1, $time2, '', $aposta);
		$user->cadastrarJogo($idjogo, $_SESSION['idBolaoEscolhido'], $jogo); 
	}
}

?>