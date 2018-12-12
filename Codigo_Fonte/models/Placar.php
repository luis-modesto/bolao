<?php
/**
*Classe que representa um placar de um jogo
*/
class Placar {

	public $pontosTime1;
	public $pontosTime2;

	/**
	*Construtor que inicializa um Placar preenchendo os atributos pontosTime1, indicando quantos pontos o time 1 fez e pontosTime2, indicando quantos pontos o time 2 fez
	*/
	function __construct($pontosTime1, $pontosTime2){
		$this->pontosTime1 = $pontosTime1;
		$this->pontosTime2 = $pontosTime2;
	}
}
?>