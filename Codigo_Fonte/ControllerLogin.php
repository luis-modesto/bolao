<?php 

require_once "./Usuario.php";

class ControllerLogin{
	function login($user){
		session_start();
		if($user->cpf == '' || $user->senha == ''){
			$_SESSION['message'] = "Preencha os campos de CPF e senha";
		}
		else if($user->efetuarLogin($user->cpf, $user->senha) == true){
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			$_SESSION['message'] = "Combinacao de CPF e senha invalida";
			header('Location: ./index.php');
		}
	}
}

?>