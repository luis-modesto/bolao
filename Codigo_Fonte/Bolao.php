<?php
require_once "Jogo.php";
require_once "Apostador.php";
require_once "DataGetter.php";

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
	}


	/**
	*Calcula, de acordo com as apostas feitas num jogo dado, quantos pontos cada jogador deve receber nessa rodada
	*/
	function distribuirPontos($jogo) {
		for ($i = 0; $i<count($this->apostadores); $i++){
			$dg = DataGetter::getInstance();
			$apostas = $dg->getData('apostas_' + $apostadores[$i]);
			for ($j = 0; $j<count($apostas); $j++){
				if (intval($apostas[$j][0])==$jogo->id){
					$p = $jogo->resultado;
					if (intval($apostas[$j][1])==$p->pontosTime1 && intval($apostas[$j][2])==$p->pontosTime2){
						$this->pontApostador[$i] += $this->ptsAcertarPlacar;
					} elseif ((intval($apostas[$j][1]) == intval($apostas[$j][2]) && $p->pontosTime1 == $p->pontosTime2) || (intval($apostas[$j][1]) > intval($apostas[$j][2]) && $p->pontosTime1 > $p->pontosTime2) || (intval($apostas[$j][1]) < intval($apostas[$j][2]) && $p->pontosTime1 < $p->pontosTime2)){
						$this->pontApostador[$i] += $this->ptsAcertarVencedor;
					}
				}
			}
		}
		//atualiza esse bolao no arquivo
		$pt = "";
		for ($i = 0; $i<count($pontApostador); $i++){
			$pt = $pt . $pontApostador[$i] . ',';
		}
		$boloes = $dg->getData('boloes');
		for ($i = 0; $i<count($boloes); $i++){
			if ($this->id==parseInt($boloes[$i][0])){
				$boloes[$i][6] = $pt;
				break;
			}
		}
		$dg->setData('boloes', $boloes);
	}


	/**
	*Determina vencedor do bolao de acordo com os pontos de cada jogador
	*/
	function determinarVencedor(){
		$dg = DataGetter::getInstance();
		$maior = 0;
		$ganhador = "";
		for ($i = 0; $i<count($this->pontApostador); $i++){
			if ($maior<$pontApostador[$i]){
				$maior = $pontApostador[$i];
				$ganhador = $apostadores[$i];
			}
		}

		$users = $dg->getInstance().getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($users[$i][0]==$ganhador){
				$saldo = intval($users[$i][4]);
				$saldo += $premio;
				$users[$i][4] = $saldo;
				break;
			}
		}
		$dg->setData('usuarios', $users);

		return $ganhador;
	}

}
?>