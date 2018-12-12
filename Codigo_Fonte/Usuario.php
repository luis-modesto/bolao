<?php
require_once "DataGetter.php";

/**
*Classe que representa um usuario do SisBolao
*/
abstract class Usuario {

	public $cpf;
	public $nome;
	public $senha;
	public $respostaSeguranca;

	/**
	*Registra informacoes necessarias para login - cpf, nome, senha e resposta de seguranca.
	*/
	function criarConta($cpf, $nome, $senha, $respostaSeguranca) {
		$dg = DataGetter::getInstance();
		$user = $cpf . ';' . $senha . ';' . $nome . ';0;500;' . $respostaSeguranca . ';'; 
		$dg->appendData('usuarios', $user);
	}


	/**
	*Retorna informacoes de boloes finalizados para exibicao
	*/
	function verificarResultados() {
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$boloesinativos = array();
		for ($i = 0; $i<count($boloes); $i++){
			if (intval($boloes[$i][10])==0){
				array_push($boloesinativos, $boloes[$i]);
			}
		}
		return $boloesinativos;
	}


	/**
	*Registra informacoes dadas pelo usuario sobre possivel bug no SisBolao
	*/
	function reportarBugs($texto) {
		$dg = DataGetter::getInstance();
		$b = $this->cpf . ';' . $texto . ';'; 
		$dg->appendData('bugs', $b);
	}


	/**
	*Metodo abstrato a ser implementado pelas classes filhas. O login deve recuperar e exibir informacoes diferentes para Apostador e Administrador
	*/
	abstract function efetuarLogin($cpf, $senha);


	/**
	*Efetua logout, ecluindo instancia do usuario Apostador ou Administrador atual
	*/
	function efetuarLogout() {
		//encerrar sessao
	}


	/**
	*Retorna a senha do usuario atual, caso a resposta passada como parametro for igual a respostaSeguranca passada pelo usuario no momento em que ele criou a conta
	*/
	function recuperarSenha($resposta){
		if ($resposta==$this->respostaSeguranca){
			return $this->senha;
		}
		return "";
	}
}

?>