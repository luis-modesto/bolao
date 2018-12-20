<?php
require_once "./Usuario.php";
require_once "./Bolao.php";
require_once "./DataGetter.php";
require_once "./Bug.php";

/**
*Classe que representa um usario especial que tem funcoes no sistema diferentes da classe Apostador
*/
class Administrador extends Usuario {

	public $bugs;

	/**
	*Construtor que inicializa uma instancia de Administrador, preenchendo os atributos cpf, nome e senha do usuario
	*/
    function __construct($username, $cpf, $nome, $senha){
    	$this->username = $username;
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->senha = $senha;
		$this->respostaSeguranca = '';
		$this->bugs = array();
    }


	/**
	*Metodo concreto que implementa o metodo abstrato em Usuario. Carrega informacoes do administrador e o registra como usuario atual do sistema, caso username e senha sejam compativeis
	*/
	function efetuarLogin($username, $senha) {
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($username == $users[$i][6] && $senha == $users[$i][1]){
				$this->nome = $users[$i][2];
				$this->cpf = $users[$i][0];
				$bugsSistema = $dg->getData('bugs');
				for($j=0; $j<count($bugsSistema); $j++){
					$userReportou = new Apostador($bugsSistema[$j][1], '', '', '', array(), array(), array(), '', array(), array(), array());
					$bug = new Bug($bugsSistema[$j][0], $userReportou, $bugsSistema[$j][2], $bugsSistema[$j][3]);
					array_push($this->bugs, $bug);
				}
				return true;
			}
		}
		return false;
	}


	/**
	*Exclui um bolao dos registros do SisBolao. Apaga dados de um bolao de arquivos gerais e arquivos voltados para usuarios especificos
	*/
	function excluirBolao($idBolao) {
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$novosboloes = array();
		$apostadores = array();
		for ($j = 0; $j<count($boloes); $j++){
			if ($idBolao==intval($boloes[$j][0])){
				$apostadores = explode(',', $boloes[$j][5]); // apostadores que participam do bolao excluido
			}
			else {
				array_push($novosboloes, $boloes[$j]);
			}
		}
		$dg->setData('bolao', $novosboloes);

		//resgata boloes que o usuario excluido participa
		for ($i = 1; $i<count($apostadores); $i++){
			$boloesuser = $dg->getData('boloes_' . $apostadores[$i]);
			$novosboloesuser = array();
			for ($j = 0; $j<count($boloesuser); $j++){
				if (intval($boloesuser[$j][1])!=$idBolao){
					array_push($novosboloesuser, $boloesuser[$j]);
				}
			}
			$dg->setData('boloes_' . $apostadores[$i], $novosboloesuser);
		}
	}


	/**
	*Exclui registros de um usuario do SisBolao. Apaga dados que possibilitam login e arquivos voltados somente para esse usuario
	*/
	function excluirContaUsuario($usuario) {
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		$novosusuarios = array();
		for ($i = 0; $i<count($users); $i++){
			if ($usuario!=$users[$i][0]){
				array_push($novosusuarios, $users[$i]);
			}
		}
		$dg->setData('usuarios', $novosusuarios);
	}
}
?>