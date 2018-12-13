<?php

require_once "./models/Apostador.php";
require_once "./models/Aposta.php";

session_start();

class TelaExibeBolao{
	function confirmarAposta(){
		$user = $_SESSION['globalUser']; //global
		user->criarAposta($placar, $idjogo); //pegar placar e idjogo da tela
	}
	function confirmarEdicaoAposta(){
		$user = $_SESSION['globalUser']; //global
		$aposta = new Aposta(); //inicializar Aposta com informacoes exibidas na tela
		$user.editarAposta($aposta);
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
	function exibirInfosBolao($idBolao){
		// recupera informaçoes do bolao
		$boloes = DataGetter.prototype.getInstance().getData('bolao');
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][0])==$idBolao){
				//acrescentar informacoes de boloes[i] no html
				break;
			}
		}
	}
}
?>