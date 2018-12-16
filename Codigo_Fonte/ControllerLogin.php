<?php 

require_once "./Usuario.php";

class ControllerLogin{
	function login($user){
		else if($user->efetuarLogin($user->cpf, $user->senha) == true){
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			$_SESSION['message'] = "Combinação de CPF e senha inválida.";
			header('Location: ./index.php');
		}
	}
}

?>