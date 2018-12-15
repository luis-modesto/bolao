<?php
require_once "./ControllerLogin.php";
require_once "./Administrador.php";
require_once "./Apostador.php";

class TelaUsuario{

	function exibirNavBar(){
	    session_start();
	    $user = $_SESSION["globalUser"];
		$retorno = '<header>
	    	<nav style="color: #C0C0C0;" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">'. PHP_EOL .$user->nome . PHP_EOL;
        		if($user instanceof Apostador){
                    $retorno = $retorno . '<div class="ml-4 mr-1 text-center">
				        <i class="text-warning fas fa-coins"> </i>
                    	'.$user->saldo.'
                    </div>';
                }
			    $retorno = $retorno . '<a class="ml-auto" style="color: #C0C0C0; font-size: 2.5em;" id = "cabecalho" href = "./telaHomepage.php">SisBolão</a>

			    <button style="font-size: 1.5em;" class="text-primary btn ml-auto mr-4 bg-dark" type="buttom" id="btn-notificacoes" data-target="#notificacoes"><i class="fas fa-bell"></i></button>

		    	<form style="text-align: right;" class="form-inline my-2 my-lg-0"  method = "post" action="./#.php">
	        		<input type = "hidden" value = "1"  name = "sair" id = "sair"> 
	            	<button  style="color: #C0C0C0;" type="submit"  class = "mr-sm-2 my-2 my-sm-0 btn bg-dark"> Sair </button>
	            </form>
			</nav>
	    </header>';
	    return $retorno;
	}

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