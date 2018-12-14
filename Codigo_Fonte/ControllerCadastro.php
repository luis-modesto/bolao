<?php

require_once "./Usuario.php";
require_once "./Apostador.php";

class ControllerCadastro{

	function criaConta($user, $resposta){
		session_start();
		if($user->criarConta($user->cpf, $user->nome, $user->senha, $resposta) == true){
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			$_SESSION['message'] = "CPF ja cadastrado no sistema";
			header('Location: ./index.php');
		}
	}
}

?>