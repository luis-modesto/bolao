<?php
require_once "./Placar.php";
require_once "./Jogo.php";

/**
*Classe que representa uma aposta feita por um Apostador em um Jogo especifico de um Bolao especifico
*/
class Aposta {

	public $placarApostado;
	public $jogo;

	/**
	*Construtor que inicializa uma instancia de Aposta preenchendo os atributos placarApostado que deve ser um Placar e idJogo, um identificador que eh unico para cada jogo cadastrado no SisBolao
	*/
	function __construct($placarApostado, $jogo){
		$this->placarApostado = $placarApostado;
		$this->jogo = $jogo;
	}
	
	
	/**
	*Retorna true caso a aposta ainda pode ser editada, com base na data limite de edicao para apostas em um dado jogo. Retorna false caso contrario
	*/
	function isEditavel() {
		// a data limite de edição do jogo vem no formato DD/MM/YYYY, por exemplo, 01/03/2019
		$dg = DataGetter::getInstance();
		$dialimite = $this->jogo->limiteEdicaoAposta[0] . $this->jogo->limiteEdicaoAposta[1]; // dialimite = 01
		$meslimite = $this->jogo->limiteEdicaoAposta[3] . $this->jogo->limiteEdicaoAposta[4]; // meslimite = 03
		$anolimite = $this->jogo->limiteEdicaoAposta[6] . $this->jogo->limiteEdicaoAposta[7] . $this->jogo->limiteEdicaoAposta[8] . $this->jogo->limiteEdicaoAposta[9]; //anolimite = 2019
		$dialimite = intval($dialimite); // transformando as variáveis em inteiros
		$meslimite = intval($meslimite);
		$anolimite = intval($anolimite);
		$mes = date("m"); //date("m") retorna o mês atual, entre 1 e 12
		$mes = intval($mes);
		if((intval(date("Y"))) > $anolimite){ // se ano atual tiver ultrapassado ano da data limite
			return false; // não é possível editar 
		}
		elseif(($mes > $meslimite && (intval(date("Y"))) == $anolimite)){ // se mês atual tiver ultrapassado o limite, estando no mesmo ano
			return false; // não é possível editar
		}
		elseif((intval(date("d"))) > $dialimite  && $mes >= $meslimite  && (intval(date("Y"))) == $anolimite){ // se o dia tiver ultrapassado, estando no mesmo mês ou em algum seguinte no ano
			return false; // não é possivel editar
		}
		else{ // caso não esteja em nenhuma das condições acima, significa que a data limite ainda não foi ultrapassada
			return true; // então a aposta eh editável
		}
	}
}

?>