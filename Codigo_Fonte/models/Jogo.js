import Placar from "./Placar.js"

/**
*Classe que representa um jogo relacionado a um bolao especifico
*/
class Jogo {

	/**
	*Construtor que inicializa uma instancia de Jogo preenchendo os atributos: id, um identificador unico para cada jogo resgistrado no SisBolao; data em que o jogo acontece; limiteEdicaoAposta que determina a data limite para que informacoes sobre esse jogo sejam alteradas;
	*time1, o nome de um dos times que participara do jogo; time2, o nome do outro time que participara do jogo; resultado do jogo, que a priori eh nulo; e valorAposta que determina qual o valor necessario para fazer uma aposta nesse jogo.
	*/
	constructor(id, data, limiteEdicaoAposta, time1, time2, resultado, valorAposta){
		this.id = id;
		this.data = data;
		this.limiteEdicaoAposta = limiteEdicaoAposta;
		this.time1 = time1;
		this.time2 = time2;
		this.resultado = resultado;
		this.valorAposta = valorAposta;
	}


	/**
	*Retorna resultado do jogo para exibicao
	*/
	exibirResultado() {

	}


	/**
	*Retorna true se esse jogo ainda pode ser editado, retorna false caso contrario
	*/
	isEditavel() {
	
	}

}
