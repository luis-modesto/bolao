<?php

require_once "./Usuario.php";
require_once "./Apostador.php";

class TelaCadastro{

	function criaConta($user, $resposta){
		$user->criarConta($user->cpf, $user->nome, $user->senha, $resposta);
		session_start();
		$_SESSION['globalUser'] = $user;
		header('Location: ./telaHomepage.php');
	}
}

?>