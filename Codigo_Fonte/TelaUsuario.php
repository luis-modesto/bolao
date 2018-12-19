<?php
require_once "./ControllerLogin.php";
require_once "./Administrador.php";
require_once "./Apostador.php";
require_once "./Convite.php";
require_once "./Solicitacao.php";

class TelaUsuario{

	private $inputsNotific = '';

	function exibirNotificacoes(){
		$user = $_SESSION['globalUser'];
		// recuperar lista de notificações do usuario 
		$retorno = '<ul class="list-group">'.PHP_EOL;
			for ($i=0; $i<count($user->convites); $i++){
				$c = $user->convites[$i];
				$b = $c->bolao;
				$idBolao = $b->id;
				$retorno = $retorno . '<li id="li-'.$idBolao.'" class="bg-light list-group-item">'.PHP_EOL.
					'<div class="row">
						<div class="col-12">'.
							$c->exibirNotificacao().PHP_EOL.
					'	</div>
					</div>
					<div class="row">
						<div class="col-4 offset-8">
							<button id="acc-'.$idBolao.'" onclick="aceitarNotificacao(\''.$idBolao.'\')" class="bg-light btn"><i style="font-size: 1.5em;" class="text-success far fa-check-circle"></i></button> 
							<button id="rec-'.$idBolao.'" onclick="rejeitarNotificacao(\''.$idBolao.'\')" class="btn bg-light"><i style="font-size: 1.5em;" class="text-danger far fa-times-circle"></i></button>
						</div>
					</div>
					</li>'.PHP_EOL;
					//adiciona input
					$this->inputsNotific = $this->inputsNotific . '<input type = "hidden" value = "0"  name = "notf'.$idBolao.'" id = "notf'.$idBolao.'">'.PHP_EOL;
			}
			for ($i=0; $i<count($user->solicitacoes); $i++){
				$s = $user->solicitacoes[$i];
				$b = $s->bolao;
				$idBolao = $b->id;
				$retorno = $retorno . '<li id="li-'.$idBolao.'" class="bg-light list-group-item">'.PHP_EOL.
					'<div class="row">
						<div class="col-12">'.
							$s->exibirNotificacao().PHP_EOL.
					'	</div>
					</div>
					<div class="row">
						<div class="col-4 offset-8">
							<button id="acc-'.$idBolao.'" type="button" onclick="aceitarNotificacao(\''.$idBolao.'\')" class="bg-light btn"><i style="font-size: 1.5em;" class="text-success far fa-check-circle"></i></button> 
							<button id="rec-'.$idBolao.'" type="button" onclick="rejeitarNotificacao(\''.$idBolao.'\')" class="btn bg-light"><i style="font-size: 1.5em;" class="text-danger far fa-times-circle"></i></button>
						</div>
					</div>
					</li>'.PHP_EOL;
					//adiciona input
					$this->inputsNotific = $this->inputsNotific . '<input type = "hidden" value = "0"  name = "notf'.$idBolao.'" id = "notf'.$idBolao.'">'.PHP_EOL;
			}
		$retorno = $retorno . '</ul>'.PHP_EOL;
		return $retorno;
	}

	function exibirNavBar($tela){
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
			    $retorno = $retorno . '<a class="ml-auto" style="color: #C0C0C0; text-decoration: none; font-size: 2.5em;" id = "cabecalho" href = "./telaHomepage.php">SisBolão</a>

			    <button style="font-size: 1.5em;" class="text-primary btn ml-auto mr-4 bg-dark" type="button" id="btn-notificacoes" data-toggle="modal" data-target="#notificacoes"><i class="fas fa-bell"></i></button>

		    	<form style="text-align: right;" class="form-inline my-2 my-lg-0"  method = "post" action="./'.$tela.'.php">
	        		<input type = "hidden" value = "1"  name = "sair" id = "sair"> 
	            	<button  style="color: #C0C0C0;" type="submit"  class = "mr-sm-2 my-2 my-sm-0 btn bg-dark"> Sair </button>
	            </form>
			</nav>
			<div id="notificacoes" class="modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Notificações</h4>
						</div>
						<div class="modal-body">'.
							$this->exibirNotificacoes()
						.'</div>
						<div class="modal-footer">
							<form method="post" action="./'.$tela.'.php">'. PHP_EOL.
								$this->inputsNotific . PHP_EOL .
								'
	        				<input type = "hidden" value = "1"  name = "responderNotificacoes" id = "responderNotificacoes"> 
	        				<button disabled type="submit" id="btn-submeter" class="btn btn-success">Submeter</button>
							</form>
						</div>
					</div>
				</div>
			</div>
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
		$user->username = "";
		$user->nome = "";
		$user->senha = "";

		$_SESSION["globalUser"] = $user;
		session_unset();
	}

	function dataPassou($dataJogo){
		// a data do jogo vem no formato DD/MM/YYYY, por exemplo, 01/03/2019
		$diaJogo = $dataJogo[0] . $dataJogo[1];
		$mesJogo = $dataJogo[3] . $dataJogo[4];
		$anoJogo = $dataJogo[6] . $dataJogo[7] . $dataJogo[8] . $dataJogo[9];
		$diaJogo = intval($diaJogo); // transformando as variáveis em inteiros
		$mesJogo = intval($mesJogo);
		$anoJogo = intval($anoJogo);
		if(intval(date("Y")) > $anoJogo){ // 
			return true;  
		}
		if(intval(date("m")) > $mesJogo && intval(date("Y")) == $anoJogo){
			return true; 
		}
		if(intval(date("d")) > $diaJogo  && intval(date("m")) >= $mesJogo  && intval(date("Y")) == $anoJogo){
			return true; 
		}
		return false;
	}	
}

?>