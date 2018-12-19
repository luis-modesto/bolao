<?php
require_once "./Jogo.php";
require_once "./Apostador.php";
require_once "./DataGetter.php";
require_once "./Placar.php";

/**
*Classe que representa um bolao. Contem jogos relacionados a ele, apostadores e um Apostador administrador
*/
class Bolao{

	public $id;
	public $nome;
	public $campeonato;
	public $esporte;
	public $jogos;
	public $cpfAdmin;
	public $apostadores;
	public $pontApostador;
	public $ptsAcertarPlacar;
	public $ptsAcertarVencedor;
	public $premio;
	public $ativo;
	public $dataFinalizacao;

	/**
	*Construtor que inicializa uma instancia de Bolao preenchendo os atributos: id, um identificador que eh unico para cada bolao cadastrado no SisBolao; nome dado a esse bolao; campeonato ao qual o bolao se refere; esporte dos jogos relacionados a esse bolao; jogos que acontecerao nesse bolao; e apostadores que podem registrar apostas referentes a jogos desse bolao
	*/
	function __construct($id, $nome, $campeonato, $esporte, $jogos, $cpfAdmin, $apostadores, $pontApostador, $ptsAcertarPlacar, $ptsAcertarVencedor, $premio, $ativo){
		$this->id = $id;
		$this->nome = $nome;
		$this->campeonato = $campeonato;
		$this->esporte = $esporte;
		$this->jogos = $jogos;
		$this->cpfAdmin = $cpfAdmin;
		$this->apostadores = $apostadores;
		$this->pontApostador = $pontApostador;
		$this->ptsAcertarPlacar = $ptsAcertarPlacar;
		$this->ptsAcertarVencedor = $ptsAcertarVencedor;
		$this->premio = $premio;
		$this->ativo = $ativo;
		$dg = DataGetter::getInstance();
		$boloes = $dg->getData('bolao');
		for($i=0; $i<count($boloes); $i++){
			if($boloes[$i][0] == $this->id){
				$this->dataFinalizacao = $boloes[$i][11];
				break;
			}
		}
	}


	/**
	*Calcula, de acordo com as apostas feitas num jogo dado, quantos pontos cada jogador deve receber nessa rodada
	*/
	function distribuirPontos($jogo) {
		$dg = DataGetter::getInstance();
		for ($i = 1; $i<count($this->apostadores); $i++){
			$apostas = $dg->getData('apostas_' . $this->apostadores[$i]);
			for ($j = 0; $j<count($apostas); $j++){
				if (intval($apostas[$j][0])==$jogo->id){						
					$p = $jogo->resultado;
					if (intval($apostas[$j][1])==$p->pontosTime1 && intval($apostas[$j][2])==$p->pontosTime2){
						$this->pontApostador[$i] += $this->ptsAcertarPlacar;
					} else if ((intval($apostas[$j][1]) == intval($apostas[$j][2]) && $p->pontosTime1 == $p->pontosTime2) || (intval($apostas[$j][1]) > intval($apostas[$j][2]) && $p->pontosTime1 > $p->pontosTime2) || (intval($apostas[$j][1]) < intval($apostas[$j][2]) && $p->pontosTime1 < $p->pontosTime2)){
						$this->pontApostador[$i] += $this->ptsAcertarVencedor;
					}
				}
			}
		}
		//atualiza esse bolao no arquivo
		for($i=1; $i<count($this->pontApostador); $i++){
			for($j = $i+1; $j<count($this->pontApostador); $j++){
				if($this->pontApostador[$j] > $this->pontApostador[$i]){
					$aux = $this->pontApostador[$i];
					$this->pontApostador[$i] = $this->pontApostador[$j];
					$this->pontApostador[$j] = $aux;
					$auxCPF = $this->apostadores[$i];
					$this->apostadores[$i] = $this->apostadores[$j];
					$this->apostadores[$j] = $auxCPF;					
				}
			}
		}
		$pt = implode(',', $this->pontApostador);
		$usuarios = implode(',', $this->apostadores);
		$boloes = $dg->getData('bolao');
		for ($i = 0; $i<count($boloes); $i++){
			if ($this->id==intval($boloes[$i][0])){
				$boloes[$i][6] = $pt;
				$boloes[$i][5] = $usuarios;
				break;
			}
		}
		$dg->setData('bolao', $boloes);
	}


	/**
	*Determina vencedor do bolao de acordo com os pontos de cada jogador
	*/
	function determinarVencedor(){
		$dg = DataGetter::getInstance();
		$maior = 0;
		$ganhador = $this->apostadores[1];
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($users[$i][0]==$ganhador){
				$saldo = intval($users[$i][4]);
				$saldo += $this->premio;
				$users[$i][4] = $saldo;
				break;
			}
		}
		$this->ativo = 0;
		$boloes = $dg->getData('bolao');
		for($i=0; $i<count($boloes); $i++){
			if($boloes[$i][0] == $this->id){
				$boloes[$i][10] = 0;
				break;
			}
		}
		for($i=0; $i<count($this->apostadores); $i++){
			$boloesApostador = $dg->getData('boloes_' . $this->apostadores[$i]);
			for($j=0; $j<count($boloesApostador); $j++){
				if($boloesApostador[$j][1] == $this->id){
					$boloesApostador[$j][0] = "inativo";
					$dg->setData('boloes_' . $this->apostadores[$i], $boloesApostador);
					break;
				}
			}
		}
		$dg->setData('bolao', $boloes);
		$dg->setData('usuarios', $users);
		return $ganhador;
	}

}
?>