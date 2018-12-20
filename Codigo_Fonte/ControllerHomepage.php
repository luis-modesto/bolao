<?php

require_once "./Usuario.php";
require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "./Solicitacao.php";
require_once "./Convite.php";
require_once "./DataGetter.php";
require_once "./Bolao.php";
require_once "./TelaUsuario.php";

class ControllerHomepage extends TelaUsuario{

	function aceitarNotificacao($notificacao){
		$user = $_SESSION['globalUser'];
		if($notificacao instanceof Solicitacao){
			$user->responderSolicitacao($notificacao, true);
		}
		else{
			$user->responderConvite($notificacao, true);
		}
	}

	function recusarNotificacao($notificacao){
		$user = $_SESSION['globalUser'];
		if($notificacao instanceof Solicitacao){
			$user->responderSolicitacao($notificacao, false);
		}
		else{
			$user->responderConvite($notificacao, false);
		}
	}                 

	function exibirUsuarios(){
		$dg = DataGetter::getInstance();
		$retorno = "";
		$usuarios = $dg->getData('usuarios');
		for($i=0; $i<count($usuarios); $i++){
			if($usuarios[$i][0] != '06721598567'){
				$retorno = $retorno . '<li class = "list-group-item"> <div class = "row"> <div class = "col-9">' . $usuarios[$i][6] . '</div> <div class = "col-3"> <button onclick="exibirModalExcluir(\''.$usuarios[$i][6].'\', \''.$usuarios[$i][0].'\')" data-toggle="modal" data-target="#modalExcluir" title = "Excluir Conta do Usuário" type = "button" class = "btn bg-light" style = "padding: 1px;"> <i class="fas fa-user-slash text-danger" style = "font-size: 1em;"></i> </button> </div> </div> </li>' . PHP_EOL;
				$retorno = $retorno . '</ul>
										<div id="modalExcluir" class="modal fade" role="dialog">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-body">
														Tem certeza que deseja excluir a conta de <strong id="nomeExcluido" style="color: red;"></strong>?
													</div>
													<div class="modal-footer">
														<form method="post" action="./telaHomepageAdmin.php">
								        				<input type = "hidden" value = ""  name = "userExcluido" id = "userExcluido"> 
								        				<button type="submit" class="btn btn-danger">Excluir</button>
														</form>
													</div>
												</div>
											</div>
										</div>';
			}
		}
		return $retorno;
	}

	function exibirBoloes(){
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$retorno = "";
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][10])==1){
				$user = $_SESSION["globalUser"];
				$meusboloes = $dg->getData('boloes_'.$user->cpf);
				$participo = false;
				$apostadores = explode(',', $boloes[$i][5]);
				for ($j = 0; $j<count($meusboloes); $j++){
					if ($meusboloes[$j][1]==$boloes[$i][0]){
						$participo = true;
						break;
					}
					for ($k = 0; $k<count($apostadores); $k++){
						if ($user->cpf==$apostadores[$k]){
							$participo = true;
							break;
						}
					}
					if ($participo){
						break;
					}
				}
				$soli = $dg->getData('solicitacoesfeitas_'.$user->cpf);
				$solicitei = false;
				for ($j = 0; $j<count($soli); $j++){
					if ($soli[$j][0]==$boloes[$i][0]){
						$solicitei = true;
						break;
					}
				}
				if($participo == false && $solicitei == false){
					$adm = "";
					$users = $dg->getData('usuarios');
					for ($j = 0; $j<count($users); $j++){
						if ($users[$j][0]==$boloes[$i][1]){
							$adm = $users[$j][2];
						}
					}
					$retorno = $retorno.'<li class="list-group-item" id = "'. $boloes[$i][0]. '"onclick = "pegarIdBolao('.$boloes[$i][0].')"> 
					<div class = "row">
						<div class = "col-7">
						<h6>'.$boloes[$i][2].'</h6>
						</div>
						<div class = "text-primary col-5">
						Ativo até: ' . $boloes[$i][11] . '
						</div>
					</div>
						<div class="row">
							<div class="col-12">
								Adm: '.$adm.'
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								Campeonato: '.$boloes[$i][3].'
							</div>
							<div class="col-5">
								Esporte: '.$boloes[$i][4].'
							</div>
						</div>
						
					</li>' . PHP_EOL;
				}
			}
		}
		return $retorno;
	}

	function exibirMeusBoloes(){
		$user = $_SESSION["globalUser"];
		$dg = DataGetter::getInstance();
		$meusboloes = $dg->getData('boloes_'.$user->cpf);
		$boloes = $dg->getData('bolao');
		$retorno = "";
		for ($i = 0; $i<count($meusboloes); $i++){
			if ($meusboloes[$i][0]=="ativo"){
				for ($j=0; $j<count($boloes); $j++){
					if($meusboloes[$i][1]==$boloes[$j][0]){
						$retorno = $retorno.'<li class="list-group-item" id = "'.$boloes[$j][0]. '"onclick = "pegarIdBolao('.$boloes[$j][0].', 1)">
							<div class="row">
								<div class="col-6">
									<h6>'.$boloes[$j][2].'</h6>
								</div> 
								<div class = "text-primary col-5">
									Ativo até: ' . $boloes[$j][11] . '
								</div>'.PHP_EOL;
						if ($user->cpf==$boloes[$j][1]){
							$retorno = $retorno . '<div class="col-1">
									<i class="text-warning fas fa-star"></i>
								</div>'.PHP_EOL;
						}
							$retorno = $retorno . '</div>
							<div class="row">
								<div class="col-7">
									Campeonato: '.$boloes[$j][3].'
								</div>
								<div class="col-5">
									Esporte: '.$boloes[$j][4].'
								</div>
							</div>
							
						</li>' . PHP_EOL;
					}
				}
			}
		}
		for ($i = 0; $i<count($meusboloes); $i++){
			if ($meusboloes[$i][0]!="ativo"){
				for ($j=0; $j<count($boloes); $j++){
					if($meusboloes[$i][1]==$boloes[$j][0]){
						$retorno = $retorno.'<li class="list-group-item list-group-item-secondary" id = "'.$boloes[$j][0]. '" onclick = "pegarIdBolao('.$boloes[$j][0].', 0)">
							<div class="row">
								<div class="col-6">
									<h6>'.$boloes[$j][2].'</h6>
								</div> 
								<div class = "text-danger col-5">
									Ativo até: ' . $boloes[$j][11] . '
								</div>'.PHP_EOL;
							if ($user->cpf==$boloes[$j][1]){
								$retorno = $retorno . '<div class="col-1">
										<i class="text-warning fas fa-star"></i>
									</div>'.PHP_EOL;
							}
							$retorno = $retorno . '</div> 
								<div class="row">
								<div class="col-7">
									Campeonato: '.$boloes[$j][3].'
								</div>
								<div class="col-5">
									Esporte: '.$boloes[$j][4].'
								</div>
							</div>
							
						</li>' . PHP_EOL;
					}
				}
			}
		}
		return $retorno;
	}

	function solicitarParticiparBolao($idbolao){
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$bolao = null;
		for ($i = 0; $i<count($boloes); $i++){
			if ($boloes[$i][0]==$idbolao){
				$jogos = array();
				$jogosBolao = $dg->getData('jogos_' . $boloes[$i][0]);
				for ($k = 0; $k<count($jogosBolao); $k++){
					$placar = new Placar($jogosBolao[$k][5], $jogosBolao[$k][6]);
					$jg = new Jogo($jogosBolao[$k][0], $jogosBolao[$k][1], $jogosBolao[$k][2], $jogosBolao[$k][3], $jogosBolao[$k][4], $placar, intval($jogosBolao[$k][7]));
					array_push($jogos, $jg); 
				}
				$bolao = new Bolao($boloes[$i][0], $boloes[$i][2], $boloes[$i][3], $boloes[$i][4], $jogos, $boloes[$i][1], explode(',', $boloes[$i][5]), explode(',', $boloes[$i][6]), intval($boloes[$i][7]), intval($boloes[$i][8]), intval($boloes[$i][9]), intval($boloes[$i][10]));
				break;
			}
		}
		$user = $_SESSION['globalUser'];
		$user->solicitarParticiparBolao($bolao);
	}

	function confirmarExclusaoUsuario($excluido){
		session_start();
		$user = $_SESSION['globalUser'];
		$user->excluirContaUsuario($excluido);
	}

	function confirmarExclusaoBolao($excluido){
		session_start();
		$user = $_SESSION['globalUser'];
		$user->excluirBolao($excluido);
	}
	function reportarBug($texto, $tela){
		session_start();
		$user = $_SESSION['globalUser'];
		$id = rand();
		$dg = DataGetter::getInstance();
		$bugs = $dg->getData('bug'); //instancia o vetor de boloes do usuario
		for($i=0; $i<count($bugs); $i++){ // começa a percorrer o vetor de jogos do bolao
			if($bugs[$i][0] == $id){ // se encontrar o id que tinha randomizado antes
				$idjogo = rand(); //randomiza de novo
				$i = 0; //começa a procurar do começo
			} 
		} 
		$user->reportarBug($texto, $tela, $id);
	}
}
?>