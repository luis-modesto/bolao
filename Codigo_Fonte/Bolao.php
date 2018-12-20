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
	public $criterio;

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
				$this->criterio = $boloes[$i][12];
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
						$meusboloes = $dg->getData('boloes_'.$this->apostadores[$i]);
						for ($k = 0; $k<count($meusboloes); $k++){
							if ($meusboloes[$k][1]==$this->id){
								$novoPt = intval($meusboloes[$k][2]);
								$novoPt++;
								$meusboloes[$k][2] = $novoPt;
								$dg->setData('boloes_'.$this->apostadores[$i], $meusboloes);
								break;
							}
						}
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
		$podemGanhar = array();
		$i = 1;
		while($i<count($this->pontApostador)-1 && $this->pontApostador[$i]==$this->pontApostador[$i+1]){
			$i++;
			array_push($podemGanhar, $this->apostadores[$i]);
		}

		if ($criterio=="Menor saldo"){
			$podemGanhar = ordMenorSaldo($podemGanhar);
			$ganhador = $podemGanhar[0];
		} else if ($criterio=="Maior saldo"){
			$podemGanhar = ordMaiorSaldo($podemGanhar);
			$ganhador = $podemGanhar[0];
		} else if ($criterio=="Mais placares acertados"){
			$$podemGanhar = ordMaisAcertos($podemGanhar);
			$ganhador = $podemGanhar[0];
		} else {
			$ganhador = $this->apostadores[1];	
		}

		

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
				$apostadores = explode(',', $boloes[$i][5]);
				for ($j = 0; $j<count($podemGanhar); $j++){
					$apostadores[$j+1] = $podemGanhar[$j];
				}
				$boloes[$i][5] = implode(',', $apostadores);
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

		$boloesAdmin = $dg->getData('boloes_' . $this->cpfAdmin);
		for($j=0; $j<count($boloesAdmin); $j++){
			if($boloesAdmin[$j][1] == $this->id){
				$boloesAdmin[$j][0] = "inativo";
				$dg->setData('boloes_' . $this->cpfAdmin, $boloesAdmin);
				break;
			}
		}

		$dg->setData('bolao', $boloes);
		$dg->setData('usuarios', $users);
		return $ganhador;
	}

	private function ordMenorSaldo($podemGanhar){
		$saldos = array();
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($podemGanhar); $i++){
			for ($j = 0; $j<count($users); $j++){
				if ($users[$j][0]==$podemGanhar[$i]){
					array_push($saldos, $users[$j][4]);
					break;
				}
			}
		}
		for($i=0; $i<count($podemGanhar); $i++){
			for($j = $i+1; $j<count($podemGanhar); $j++){
				if($saldos[$j] < $saldos[$i]){
					$aux = $saldos[$i];
					$saldos[$i] = $saldos[$j];
					$saldos[$j] = $aux;
					$auxCPF = $podemGanhar[$i];
					$podemGanhar[$i] = $podemGanhar[$j];
					$podemGanhar[$j] = $auxCPF;					
				}
			}
		}
		return $podemGanhar;
	}
	private function ordMaiorSaldo($podemGanhar){
		$saldos = array();
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($podemGanhar); $i++){
			for ($j = 0; $j<count($users); $j++){
				if ($users[$j][0]==$podemGanhar[$i]){
					array_push($saldos, $users[$j][4]);
					break;
				}
			}
		}
		for($i=0; $i<count($podemGanhar); $i++){
			for($j = $i+1; $j<count($podemGanhar); $j++){
				if($saldos[$j] > $saldos[$i]){
					$aux = $saldos[$i];
					$saldos[$i] = $saldos[$j];
					$saldos[$j] = $aux;
					$auxCPF = $podemGanhar[$i];
					$podemGanhar[$i] = $podemGanhar[$j];
					$podemGanhar[$j] = $auxCPF;					
				}
			}
		}
		return $podemGanhar;
	}
	private function ordMaisAcertos($podemGanhar){
		$dg = DataGetter::getInstance();
		$acertos = array();
		for ($i = 0; $i<count($podemGanhar); $i++){
			$meusboloes = $dg->getData('boloes_'.$podemGanhar[$i]);
			for ($j = 0; $j<count($meusboloes); $j++){
				if ($meusboloes[$j][1]==$this->id){
					array_push($acertos, $meusboloes[$j][2]);
					break;
				}
			}
		}
		for($i=0; $i<count($podemGanhar); $i++){
			for($j = $i+1; $j<count($podemGanhar); $j++){
				if($acertos[$j] > $acertos[$i]){
					$aux = $acertos[$i];
					$acertos[$i] = $acertos[$j];
					$acertos[$j] = $aux;
					$auxCPF = $podemGanhar[$i];
					$podemGanhar[$i] = $podemGanhar[$j];
					$podemGanhar[$j] = $auxCPF;					
				}
			}
		}
		return $podemGanhar;
	}

}
?>