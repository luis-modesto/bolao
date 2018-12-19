<?php

require_once "./Apostador.php";
require_once "./Aposta.php";
require_once "./TelaUsuario.php";
require_once "./Placar.php";
require_once "./Bolao.php";

class ControllerExibeBolao extends TelaUsuario{
	function confirmarAposta($ptTime1,$ptTime2, $jogo){
		$user = $_SESSION['globalUser']; //global
		$placar = new Placar($ptTime1, $ptTime2);
		$user->criarAposta($placar, $jogo); //pegar placar e idjogo da tela
	}
	function confirmarEdicaoAposta($ptTime1, $ptTime2, $jogo){
		$user = $_SESSION['globalUser']; //global
		$novoPlacar = new Placar($ptTime1, $ptTime2);
		$user->editarAposta($jogo, $novoPlacar);
	}
	function confirmarExclusao(){
		$user = $_SESSION['globalUser']; //global
		$userExcluido = new Apostador(); //talvez so precise pegar o cpf pela informacao da tela mesmo, e nao uma instancia de Apostador
		$user->excluirApostadorBolao($idBolao, $userExcluido->cpf);
	}
	function enviarConvite(){
		$user = $_SESSION['globalUser']; //global
		$apostadores = array(); // preencher o array com a lista de apostadores q foram selecionados para o convite
		$user->convidarApostadores($apostadores, $bolao); //preencher lista de apostadores com lista que Administrador do bolao foi selecionando
	}
	function confirmarResultado($ptTime1, $ptTime2, $jogo, $idBolao){
		$user = $_SESSION['globalUser'];
		$placar = new Placar($ptTime1, $ptTime2);
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		//$jogo->resultado = $placar;
		for($j=0; $j<count($boloes); $j++){
			if($boloes[$j][0] == $idBolao){
				$bolao = new Bolao($boloes[$j][0], $boloes[$j][2], $boloes[$j][3], $boloes[$j][4], array(),$boloes[$j][1], explode(',', $boloes[$j][5]), explode(',', $boloes[$j][6]), intval($boloes[$j][7]), intval($boloes[$j][8]), intval($boloes[$j][9]), intval($boloes[$j][10]));
				break;
			}
		}
		$user->cadastrarResultados($placar, $jogo, $idBolao); //placar vai vir de um form, o jogo é o que foi selecionado 
		$bolao->distribuirPontos($jogo);
	}
	function exibirInfosBolao(){
		$idBolao = $_SESSION['idBolaoEscolhido'];
		// recupera informaçoes do bolao
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$retorno = "";
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][0])==intval($idBolao)){
				$_SESSION['nomeBolao'] = $boloes[$i][2];
				$_SESSION['estadoBolao'] = $boloes[$i][10];
				$user = $_SESSION['globalUser'];
				$retorno = '<div class = "col-4">
								<h4 class="text-left ml-2">'. $boloes[$i][2] . '</h4>
							</div>
							<div class = "col-3" style = "padding-top: 8px;">
								<h6>' . $boloes[$i][3] . '</h6>
							</div>
							<div class = "col-2" style = "padding-top: 8px;">
								<h6>' . $boloes[$i][4] . '</h6>
							</div>' . PHP_EOL;
				if($user->cpf != $boloes[$i][1]){
					$apostadores = explode(',', $boloes[$i][5]);
					$pontuacoes = explode(',', $boloes[$i][6]);					
					for($j=0; $j<count($apostadores); $j++){
						if($user->cpf == $apostadores[$j]){
							$pontuacaoUser = $pontuacoes[$j];
							break;
						}
					}					
					$retorno = $retorno . '<div class = "col-3" style = "padding-top: 8px;">
						<h6> Pontuação: '. $pontuacaoUser . '</h6>
					</div>';
				}
				else{
					$retorno = $retorno . '<div class = "text-center col-3"> 
							<button title = "Convidar Apostadores" type = "button" class = "btn" style="padding-top: 7px; background-color: rgba(200, 200, 200);"> <i class="fas fa-envelope" style = "color: #e63900; font-size: 1.4em"></i> </button>
						</div>';
				}
				$retorno = $retorno . '</div> <div class = "row"> <div class = "text-';
				if($boloes[$i][10] == 1){
					$retorno = $retorno . 'primary col-10"> <strong> Ativo até: ' . $boloes[$i][11] . '</strong> </div> 
					</div>' . PHP_EOL;
				}
				else{
					$retorno = $retorno . 'danger ml-2 col-12"> <strong> Ativo até: ' . $boloes[$i][11] . '</strong> </div> </div>' . PHP_EOL;
				}				
				break;
			}
		}
		return $retorno;
	}
	function exibirApostadoresBolao(){
		$idBolao = $_SESSION['idBolaoEscolhido'];
		// recupera informaçoes do bolao
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$usuarios = $dg->getData('usuarios');
		$retorno = "";
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][0])==intval($idBolao)){
				for($x=0; $x<count($usuarios); $x++){
					if($usuarios[$x][0] == $boloes[$i][1]){
						$usernameAdm = $usuarios[$x][6];
						break;
					}
				}				
				$retorno = $retorno . '<div class = "col-3 mt-5">
								<div class = "resultados shadow">
								<ul class = "list-group">
								<h6 class = "text-center"> Administrador do Bolão</h6>
								<li class = "bg-light list-group-item">' . $usernameAdm . '</li>
								</ul>
								<hr style = "border: 0.3px solid;">';
				$retorno = $retorno . '<ul class = "list-group">
								<h6 class = "text-center"> Apostadores </h6>';								 
				$apostadores = explode(',', $boloes[$i][5]);
				$pontuacoes = explode(',', $boloes[$i][6]);
				for($j=1; $j<count($apostadores); $j++){
					for($k=0; $k<count($usuarios); $k++){
						if($usuarios[$k][0] == $apostadores[$j]){				
							$retorno = $retorno . '<li class = "bg-light list-group-item"';
							if($j == 1){
								$retorno = $retorno . ' style = "border: 2.5px solid #D4AF37;"';
							}
							$retorno = $retorno . '><div class = "row"> <div class = "col-7"> ' . $usuarios[$k][6] . '</div> <div class = "text-left col-3">'. $pontuacoes[$j] . '</div>' . PHP_EOL; 
							if($_SESSION['globalUser']->cpf == $boloes[$i][1] && $_SESSION['estadoBolao'] == 1){
								$retorno = $retorno . '<button title = "Excluir Apostador" type = "button" class = "btn bg-light" style = "padding: 1px;"> <i class="fas fa-user-slash text-danger" style = "font-size: 1em;"></i> </button>' . PHP_EOL;
							}
							$retorno = $retorno . '</div> </li>' . PHP_EOL;
							break;
						}
					}
				}
				$retorno = $retorno . '</ul>
									</div>
								</div>';
				break;
			}
		}
		return $retorno;
	}

	function exibirJogosBolao(){
		$idBolao = $_SESSION['idBolaoEscolhido'];
		// recupera informaçoes do bolao
		$dg = DataGetter::getInstance();
		$jogos = $dg->getData('jogos_'.$idBolao);
		$boloes = $dg->getData('bolao');
		$apostas = $dg->getData('apostas_'. $_SESSION['globalUser']->cpf);
		$retorno = "";
		$_SESSION['ehAdm'] = false;
		$jaApostou = false;
		$jaTemResultado = false;
		$_SESSION['jogosBolao'] = array();
		for($i=0; $i<count($boloes); $i++){
			if($idBolao == $boloes[$i][0]){
				if($_SESSION['globalUser']->cpf == $boloes[$i][1]){
					$_SESSION['ehAdm'] = true;
				}
				break;
			}
		}
		for ($i = 0; $i<count($jogos); $i++){
			$jaTemResultado = false;
			$jogoBolao = new Jogo($jogos[$i][0], $jogos[$i][1], $jogos[$i][2], $jogos[$i][3], $jogos[$i][4], '', $jogos[$i][7]);
			array_push($_SESSION['jogosBolao'], $jogoBolao);
			$retorno = 	$retorno . '<div class = "mb-1 col-2" style = "padding-top: 2.5px;">'. 
							$jogoBolao->data .'
						</div>
						<div class = "mb-1 text-center col-7">'.
							$jogoBolao->time1 . '
							<input disabled type = "text" id = "ptTime1'. $jogoBolao->id . '" name = "ptTime1' . $jogoBolao->id . '" '; 
							if($_SESSION['ehAdm'] == false && $this->dataPassou($jogoBolao->data) == false){
								for($j=0; $j<count($apostas); $j++){
									if($apostas[$j][0] == $jogoBolao->id){
										$jaApostou = true;
										$ptTime1 = $apostas[$j][1];
										$ptTime2 = $apostas[$j][2];
										$placarApostado = new Placar($ptTime1, $ptTime2);
										$apostaFeita = new Aposta($placarApostado, $jogoBolao);
										$retorno = $retorno . 'value = "' . $ptTime1 . '"';
										break;
									}				
								}								
							}
							else if($_SESSION['ehAdm'] == true || $this->dataPassou($jogoBolao->data) == true){
								$ptTime1 = $jogos[$i][5];
								$ptTime2 = $jogos[$i][6];
								if($ptTime1 != '-' && $ptTime2 != '-'){
									$jaTemResultado = true;
								}
								$retorno = $retorno . 'value = "' . $ptTime1 . '"';								
							}
							$retorno = $retorno . ' style = "text-align: center; width: 1.8em;">
							X
							<input disabled type = "text" id = "ptTime2'. $jogoBolao->id . '" name = "ptTime2' . $jogoBolao->id . '" ';
							if(($_SESSION['ehAdm'] == false && $jaApostou == true && $this->dataPassou($jogoBolao->data) == false) || ($_SESSION['ehAdm'] == true) || $this->dataPassou($jogoBolao->data) == true){
								$retorno = $retorno . 'value = "' . $ptTime2 . '"';
							}
							$retorno = $retorno . ' style = "text-align: center; width: 1.8em;"> '
							. $jogoBolao->time2 .'
							</div>
							<div class = "mb-1 text-right col-2" style = "padding-top: 2.5px;">
								<i class="text-warning fas fa-coins" style = "font-size: 1em;"></i>'. $jogoBolao->valorAposta . '
							</div>' . PHP_EOL;
			$retorno = $retorno . '<div class = "col-1">' . PHP_EOL;
			if($_SESSION['ehAdm'] == true && $this->dataPassou($jogoBolao->data) && $jaTemResultado == false){
				$_SESSION['operacao'] = "resultado";
				$retorno = $retorno . '<button type = "button"  onclick = "permiteEditarResultado('. $jogoBolao->id . ')" title = "Cadastrar Resultados" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-clipboard-check text-success" style = "font-size: 1.3em;"></i> </button>' . PHP_EOL;
			}
			else if($_SESSION['ehAdm'] == false && $jaApostou == false && $this->dataPassou($jogoBolao->limiteEdicaoAposta) == false){
				$_SESSION['operacao'] = "cadastrando aposta"; 
				$retorno = $retorno . '<button type = "button"  onclick = "permiteEditarResultado('. $jogoBolao->id . ')" title = "Cadastrar Aposta" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-file-invoice-dollar text-success" style = "font-size: 1.3em;"></i> </button>' . PHP_EOL;
			}
			else if($_SESSION['ehAdm'] == false && $jaApostou == true && $apostaFeita->isEditavel() == true && $this->dataPassou($jogoBolao->data) == false){
				$_SESSION['operacao'] = "editando aposta"; 
				$retorno = $retorno . '<button type = "button"  onclick = "permiteEditarResultado('. $jogoBolao->id . ')" title = "Editar Aposta" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-edit  text-info" style = "font-size: 1.1em;"></i> </button>' . PHP_EOL;
			}
			$retorno = $retorno . '</div>' . PHP_EOL;
		}
		return $retorno;
	}	
}
?>