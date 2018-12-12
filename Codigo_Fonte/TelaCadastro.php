<?php

require_once "./models/Usuario.php";
require_once "./models/Apostador.php";

class TelaCadastro{

	function criaConta($user, $resposta){
		$user->criarConta($user->cpf, $user->nome, $user->senha, $resposta);
		session_start();
		$_SESSION['globalUser'] = $user;
		header('Location: ./homepage.html');
	}
}

?>