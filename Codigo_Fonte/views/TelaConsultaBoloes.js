import {Apostador} from "../models/Apostador.js"
import {Administrador} from "../models/Administrador.js"

export class TelaConsultaBoloes{
	exibirBoloes(){
		//recuperar lista de bolões 
		let boloes = DataGetter.prototype.getInstance().getData('bolao');
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][10])==1){
				//acrescentar boloes[i] no html
			}
		}
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][10])==0){
				//acrescentar boloes[i] no html
			}
		}
	}

	visualizarBolao(){
		// exporta id do bolao para tela de exibição
	}

	confirmarBolao(){
		// se cpf eh de um administrador
		let user = new Administrador ();//global
		user.excluirBolao(bolao);
	}
}