<?php
require_once "./ControllerLogin.php";
require_once "./Administrador.php";
require_once "./Apostador.php";

class TelaUsuario{

	function sair(){
		session_start();
		$user = $_SESSION["globalUser"];

		if ($user->cpf!="06721598567"){
			$user->boloesCriados = array();
			$user->boloesParticipa = array();
			$user->boloesEncerrados = array();
			$user->saldo = 0;
			$user->apostas = array();
			$user->convites = array();
			$user->solicitacoes = array();
		}

		$user->cpf = "";
		$user->nome = "";
		$user->senha = "";

		$_SESSION["globalUser"] = $user;
	}
}

?>