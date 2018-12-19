<?php 

require_once "./Usuario.php";
require_once "./TelaUsuario.php";
require_once "./Bolao.php";

class ControllerLogin{
	function login($user){
		if($user->efetuarLogin($user->username, $user->senha) == true){
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			$_SESSION['message'] = "Combinação de usuário e senha inválida.";
			header('Location: ./index.php');
		}
	}
	function verificaBoloes(){
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$telaUsuario = new TelaUsuario();
		for($j=0; $j<count($boloes); $j++){
			if($telaUsuario->dataPassou($boloes[$j][11]) == true && $boloes[$j][10] == 1){
				$bolao = new Bolao($boloes[$j][0], $boloes[$j][2], $boloes[$j][3], $boloes[$j][4], array(),$boloes[$j][1], explode(',', $boloes[$j][5]), explode(',', $boloes[$j][6]), intval($boloes[$j][7]), intval($boloes[$j][8]), intval($boloes[$j][9]), intval($boloes[$j][10]));
				$bolao->determinarVencedor();				
			}
		}
	}
}

?>