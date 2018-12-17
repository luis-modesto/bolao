<?php 

require_once "./Usuario.php";

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
}

?>