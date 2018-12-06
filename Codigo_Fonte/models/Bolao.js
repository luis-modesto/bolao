import {Jogo} from "./Jogo.js"
import {Apostador} from "./Apostador.js"

/**
*Classe que representa um bolao. Contem jogos relacionados a ele, apostadores e um Apostador administrador
*/
export class Bolao {

	/**
	*Construtor que inicializa uma instancia de Bolao preenchendo os atributos: id, um identificador que eh unico para cada bolao cadastrado no SisBolao; nome dado a esse bolao; campeonato ao qual o bolao se refere; esporte dos jogos relacionados a esse bolao; jogos que acontecerao nesse bolao; e apostadores que podem registrar apostas referentes a jogos desse bolao
	*/
	constructor(id, nome, campeonato, esporte, jogos, cpfAdmin, apostadores, pontApostador, ptsAcertarPlacar, ptsAcertarVencedor, premio, ativo){
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
		this.ativo = ativo;
	}


	/**
	*Calcula, de acordo com as apostas feitas num jogo dado, quantos pontos cada jogador deve receber nessa rodada
	*/
	distribuirPontos(jogo) {
		for (i = 0; i<this.apostadores.length; i++){
			let apostas = DataGetter.getInstance.getData('apostas_' + apostadores[i]);
			for (j = 0; j<apostas.length; j++){
				if (parseInt(apostas[j][0])==jogo.id){
					if (parseInt(apostas[j][1])==jogo.resultado.pontosTime1 && parseInt(apostas[j][2])==jogo.resultado.pontosTime2){
						this.pontApostador[i] += 150;
					} else if ((parseInt(apostas[j][1]) == parseInt(apostas[j][2]) && jogo.resultado.pontosTime1 == jogo.resultado.pontosTime2) || (parseInt(apostas[j][1]) > parseInt(apostas[j][2]) && jogo.resultado.pontosTime1 > jogo.resultado.pontosTime2) || (parseInt(apostas[j][1]) < parseInt(apostas[j][2]) && jogo.resultado.pontosTime1 < jogo.resultado.pontosTime2)){
						this.pontApostador[i] += 50;
					}
				}
			}
		}
		//atualiza esse bolao no arquivo
		let novobolao = this.id + ';';
	}


	/**
	*Determina vencedor do bolao de acordo com os pontos de cada jogador
	*/
	determinarVencedor(){
		let maior = 0;
		let ganhador = "";
		for (i = 0; i<this.pontApostador.length; i++){
			if (maior<pontApostador[i]){
				maior = pontApostador[i];
				ganhador = apostadores[i];
			}
		}
		return ganhador;
	}

}
