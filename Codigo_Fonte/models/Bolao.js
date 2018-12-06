import {Jogo} from "./Jogo.js"
import {Apostador} from "./Apostador.js"

/**
*Classe que representa um bolao. Contem jogos relacionados a ele, apostadores e um Apostador administrador
*/
export class Bolao {

	/**
	*Construtor que inicializa uma instancia de Bolao preenchendo os atributos: id, um identificador que eh unico para cada bolao cadastrado no SisBolao; nome dado a esse bolao; campeonato ao qual o bolao se refere; esporte dos jogos relacionados a esse bolao; jogos que acontecerao nesse bolao; e apostadores que podem registrar apostas referentes a jogos desse bolao
	*/
	constructor(id, nome, campeonato, esporte, jogos, cpfAdmin, apostadores, pontApostador, ptsAcertarPlacar, ptsAcertarVencedor, premio){
		this.id = id;
		this.nome = nome;
		this.campeonato = campeonato;
		this.esporte = esporte;
		this.jogos = jogos;
		this.cpfAdmin = cpfAdmin;
		this.apostadores = apostadores;
		this.pontApostador = pontApostador;
		this.ptsAcertarPlacar = ptsAcertarPlacar;
		this.ptsAcertarVencedor = ptsAcertarVencedor;
		this.premio = premio;
		this.ativo = true;
	}


	/**
	*Calcula, de acordo com as apostas feitas num jogo dado, quantos pontos cada jogador deve receber nessa rodada
	*/
	distribuirPontos(jogo) {
		
	}


	/**
	*Determina vencedor do bolao de acordo com os pontos de cada jogador
	*/
	determinarVencedor(){

	}

}
