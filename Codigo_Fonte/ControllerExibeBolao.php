<?php

require_once "./Apostador.php";
require_once "./Aposta.php";
require_once "./TelaUsuario.php";
require_once "./Placar.php";

class ControllerExibeBolao extends TelaUsuario{
	function confirmarAposta(){
		$user = $_SESSION['globalUser']; //global
		$user->criarAposta($placar, $idjogo); //pegar placar e idjogo da tela
	}
	function confirmarEdicaoAposta(){
		$user = $_SESSION['globalUser']; //global
		$aposta = new Aposta(); //inicializar Aposta com informacoes exibidas na tela
		$user->editarAposta($aposta);
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
	function cofirmarResultado(){
		$user = $_SESSION['globalUser'];
		$user->cadastrarResultados($placar, $jogo, $bolao); //placar vai vir de um form, o id do jogo deve dar pra pegar da tela prq no momento que essa funcao eh chamada, o jogo ja foi selecionado
	}
	function exibirInfosBolao(){
		$idBolao = $_SESSION['idBolaoEscolhido'];
		// recupera informaçoes do bolao
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$retorno = "";
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][0])==intval($idBolao)){
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
					</div>'. PHP_EOL;
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
				$apostadores = explode(',', $boloes[$i][5]);
				for($j=0; $j<count($apostadores); $j++){
					for($k=0; $k<count($usuarios); $k++){
						if($usuarios[$k][0] == $apostadores[$j]){				
							$retorno = $retorno . '<li class = "bg-light list-group-item">' . $usuarios[$k][6] . PHP_EOL; 
							if($_SESSION['globalUser']->cpf == $boloes[$i][1]){
								$retorno = $retorno . '<button title = "Excluir Apostador" type = "button" class = "btn bg-light" style = "padding: 1px;"> <i class="fas fa-user-slash text-danger" style = "font-size: 1em;"></i> </button>' . PHP_EOL;
							}
							$retorno = $retorno . '</li>' . PHP_EOL;
							break;
						}
					}
				}
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
		$ehAdm = false;
		$jaApostou = false;
		for($i=0; $i<count($boloes); $i++){
			if($idBolao == $boloes[$i][0]){
				if($_SESSION['globalUser']->cpf == $boloes[$i][1]){
					$ehAdm = true;
				}
				break;
			}
		}
		for ($i = 0; $i<count($jogos); $i++){
			$retorno = 	$retorno . '<div class = "col-2" style = "padding-top: 2.5px;">'. 
							$jogos[$i][1] .'
						</div>
						<div class = "text-center col-7">'.
							$jogos[$i][3] . '
							<input readonly type = "text" name = "ptTime1' . $jogos[$i][0] . '" '; 
							if($ehAdm == false && $this->dataPassou($jogos[$i][1]) == false){
								for($j=0; $j<count($apostas); $j++){
									if($apostas[$j][0] == $jogos[$i][0]){
										$jaApostou == true;
										$ptTime1 = $apostas[$j][1];
										$ptTime2 = $apostas[$j][2];
										$placarApostado = new Placar($ptTime1, $ptTime2);
										$apostaFeita = new Aposta($placarApostado, $jogos[$i][0]);
										$retorno = $retorno . 'value = "' . $ptTime1 . '"';
										break;
									}				
								}								
							}
							else{
								$ptTime1 = $jogos[$i][5];
								$ptTime2 = $jogos[$i][6];
								$retorno = $retorno . 'value = "' . $ptTime1 . '"';								
							}
							$retorno = $retorno . ' style = "text-align: center; width: 1.8em;">
							X
							<input readonly type = "text" name = "ptTime2' . $jogos[$i][0] . '" ';
							if(($ehAdm == false && $jaApostou == true && $this->dataPassou($jogos[$i][1]) == false) || $ehAdm == true){
								$retorno = $retorno . 'value = "' . $ptTime2 . '"';
							}
							$retorno = $retorno . ' style = "text-align: center; width: 1.8em;">. '
							. $jogos[$i][4] .'
							</div>
							<div class = "text-right col-2" style = "padding-top: 2.5px;">
								<i class="text-warning fas fa-coins" style = "font-size: 1em;"></i>'. $jogos[$i][7] . '
							</div>' . PHP_EOL;
			$retorno = $retorno . '<div class = "col-1">' . PHP_EOL;
			if($ehAdm == true && $this->dataPassou($jogos[$i][1])){
				$retorno = $retorno . '<button type = "button" title = "Cadastrar Resultados" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-clipboard-check text-success" style = "font-size: 1.3em;"></i> </button>' . PHP_EOL;
			}
			else if($ehAdm == false && $jaApostou == false && $this->dataPassou($jogos[$i][2]) == false){
				$retorno = $retorno . '<button title = "Apostar" type = "button" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-file-invoice-dollar text-success" style = "font-size: 1.3em;"></i> </button>' . PHP_EOL;
			}
			else if($ehAdm == false && $jaApostou == true && $apostaFeita->isEditavel() == true){
				$retorno = $retorno . '<button title = "Editar Aposta" type = "button" class = "btn bg-light" style = "padding: 2px;"> <i class="fas fa-edit  text-info" style = "font-size: 1.1em;"></i> </button>' . PHP_EOL;
			}
			$retorno = $retorno . '</div>' . PHP_EOL;
		}
		return $retorno;
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