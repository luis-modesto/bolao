<?php

require_once "./Apostador.php";
require_once "./Administrador.php";

class ControllerRecupera{
	function recuperaSenha($user, $resposta){
		if(!isset($user->respostaSeguranca)){
			$_SESSION['message'] = "Este cpf nao foi cadastrado no sistema";
		}
		else{
			$senha = $user->recuperarSenha($resposta);
			if ($senha!=""){
				$_SESSION['message'] = "Sua senha de acesso ao bolao eh: " . $senha;
			}
			else{
				$_SESSION['message'] = "Essa nao foi a resposta que voce colocou no cadastro";
			}
		}
		header('Location: ./telaForgotPassword.php');
	}
}

?>