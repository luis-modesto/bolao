<?php

require_once "./Apostador.php";

class TelaCriaJogo{

	function confirmarCriacaoJogo($dataJogo, $dataLimite, $time1, $time2, $aposta){
		session_start();
		$user = $_SESSION['globalUser']; //global 
		// id do bolao vai estar armazenado em idBolaoEscolhido, pq se for num bolao que a pessoa acabou de criar, o id dele eh armazenado la na classe de criar bolao e se for um q ela escolheu pra colocar o id eh armazenado no controller de exibiçao do bolao
		$user->cadastrarJogo($_SESSION['idBolaoEscolhido'], $idjogo, $_POST['dataJogo'], $_POST['dataLimite'], $_POST['time1'], $_POST['time2'], '', $_POST['aposta']); //idjogo depende de quantos jogos tem no bolao, tem q recuperar disso
	}
}

?>