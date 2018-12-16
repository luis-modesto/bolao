<?php

require_once "./Apostador.php";
require_once "./Administrador.php";

class ControllerRecupera{
	function recuperaSenha($user, $resposta){
		if(!isset($user->respostaSeguranca)){
			$_SESSION['message'] = "Esse cpf não está cadastrado no sistema.";
		}
		else{
			$senha = $user->recuperarSenha($resposta);
			if ($senha!=""){
				$_SESSION['message'] = "Sua senha de acesso ao bolão é: " . $senha;
			}
			else{
				$_SESSION['message'] = "Essa não foi a resposta que voce colocou no cadastro.";
			}
		}
		header('Location: ./telaForgotPassword.php');
	}
}

?>