<?php

require_once "./Apostador.php";
require_once "./Administrador.php";

class ControllerRecupera{
	function recuperaSenha($user, $resposta){
		if(!isset($user->respostaSeguranca)){
			$_SESSION['message'] = "Esse cpf não está cadastrado no sistema.";
		}
		else{
			$dados = $user->recuperarAcesso($resposta);
			if ($dados[0]!="" && $dados[1] != ""){
				$_SESSION['message'] = "Sua senha de acesso ao bolão é: " . $dados[0] . " e seu username é: " . $dados[1] . ".";
			}
			else{
				$_SESSION['message'] = "Essa não foi a resposta que voce colocou no cadastro.";
			}
		}
		header('Location: ./telaForgotPassword.php');
	}
}

?>