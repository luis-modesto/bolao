import Placar from "./Placar.js"
import Jogo from "./Jogo.js";

class Aposta {

	constructor(placarApostado, jogo){
		this.placarApostado = placarApostado;
		this.jogo = jogo;
	}
	
	isEditavel() { // verifica se uma aposta pode ser editável de acordo com a data limite de edição do jogo
		// a data limite de edição do jogo vem no formato DD/MM/YYYY, por exemplo, 01/03/2019
		let dialimite = jogo.limiteEdicaoAposta[0] + jogo.limiteEdicaoAposta[1]; // dialimite = 01
		let meslimite = jogo.limiteEdicaoAposta[3] + jogo.limiteEdicaoAposta[4]; // meslimite = 03
		let anolimite = jogo.limiteEdicaoAposta[6] + jogo.limiteEdicaoAposta[7] + jogo.limiteEdicaoAposta[8] + jogo.limiteEdicaoAposta[9]; //anolimite = 2019
		let d = new Date(); // função que retorna a data de hoje
		dialimite = parseInt(dialimite); // transformando as variáveis em inteiros, pois o dia, mes e ano do getDate() vêm em inteiro
		meslimite = parseInt(meslimite);
		anolimite = parseInt(anolimite);
		let mes = d.getMonth() + 1; //getMonth retorna o mês atual, entre 0 (representando janeiro) e 11 (representando dezembro)
		if((d.getFullYear() > anolimite)){ // se ano atual tiver ultrapassado ano da data limite
			return false; // não é possível editar 
		}
		else if((mes > meslimite && d.getFullYear() == anolimite)){ // se mês atual tiver ultrapassado o limite, estando no mesmo ano
			return false; // não é possível editar
		}
		else if((d.getDate() > dialimite  && mes >= meslimite  && d.getFullYear() == anolimite)){ // se o dia tiver ultrapassado, estando no mesmo mês ou em algum seguinte no ano
			return false; // não é possivel editar
		}
		else{ // caso não esteja em nenhuma das condições acima, significa que a data limite ainda não foi ultrapassada
			return true; // então a aposta eh editável
		}
	}

}