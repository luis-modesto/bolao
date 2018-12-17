<?php

require_once "./Usuario.php";
require_once "./Apostador.php";

class ControllerCadastro{

	function criaConta($user, $resposta){
		session_start();
		if($user->criarConta($user->username, $user->cpf, $user->nome, $user->senha, $resposta) == true){
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			if($_SESSION['jatem'] == 'cpf'){
				$_SESSION['message'] = "CPF já cadastrado no sistema.";
				header('Location: ./index.php');
			}
			else{
				$_SESSION['message'] = "Já existe um usuário com este username no sistema.";
				header('Location: ./telaNewUser.php');
			}
		}
	}
}

?>