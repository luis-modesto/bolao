<?php
require_once "Usuario.php";
require_once "Bolao.php";
require_once "DataGetter.php";

/**
*Classe que representa um usario especial que tem funcoes no sistema diferentes da classe Apostador
*/
class Administrador extends Usuario {

	/**
	*Construtor que inicializa uma instancia de Administrador, preenchendo os atributos cpf, nome e senha do usuario
	*/
    function __constructor($cpf, $nome, $senha){
        $this->cpf = $cpf;
		$this->nome = $nome;
		$this->senha = $senha;
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($this->cpf==$users[$i][0] && $this->senha==$users[$i][1]){
				$this->respostaSeguranca = $users[$i][5];
				break;
			}
		}
    }


	/**
	*Metodo concreto que implementa o metodo abstrato em Usuario. Carrega informacoes do administrador e o registra como usuario atual do sistema, caso cpf e senha sejam compativeis
	*/
	function efetuarLogin($cpf, $senha) {
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($cpf==$users[$i][0] && $senha==$users[$i][1]){
				$this->nome = $users[$i][2];
				return true;
			}
		}
		return false;
	}


	/**
	*Exclui um bolao dos registros do SisBolao. Apaga dados de um bolao de arquivos gerais e arquivos voltados para usuarios especificos
	*/
	function excluirBolao($bolao) {
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		$novosboloes = array();
		$apostadores = array();
		for ($j = 0; $j<count($boloes); $j++){
			if ($bolao->id==intval($boloes[$j][0])){
				$cpfs_apostadores = $boloes[$j][5]; // string com tds os cpfs do bolao
				$cpf = '';
				for($i=0; $i<count($cpfs_apostadores); $i++){
					if($cpfs_apostadores[$i] != ','){
						$cpf += $cpfs_apostadores[$i];
					} else if($cpfs_apostadores[$i] == ','){ // achou virgula significa que um novo cpf esta por vir
						array_push($apostadores, $cpf);
						$cpf = ''; // zera o cpf atual
					}
				}
			} else {
				array_push($novosboloes, $boloes[$j]);
			}
		}
		$dg->setData('bolao', $novosboloes);

		//resgata boloes que o usuario excluido participa
		for ($i = 0; $i<count($apostadores); $i++){
			$boloesuser = $dg->getData('boloes_' + $apostadores[$i]);
			$novosboloesuser = [];
			for ($j = 0; $j<count($boloesuser); $j++){
				if (intval($boloesuser[$j][1])!=$bolao->id){
					array_push($novosboloesuser, $boloesuser[$j]);
				}
			}
			$dg->setData('boloes_' + $apostadores[$i], $novosboloesuser);
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
			if ($usuario->cpf!=$users[$i][0]){
				array_push($novosusuarios, $users[$i]);
			}
		}
		$dg->setData('usuarios', $novosusuarios);
	}
}
?>