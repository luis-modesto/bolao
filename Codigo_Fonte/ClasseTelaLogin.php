<?php 

require_once "./Usuario.php";

class TelaLogin{
	function login($user){
		if($user->efetuarLogin($user->cpf, $user->senha) == true){
			session_start();
			$_SESSION['globalUser'] = $user;
			header('Location: ./telaHomepage.php');
		}
		else{
			echo "CPF ou senha inválido";
			header('Location: ./index.php');
		}
	}
}

?>