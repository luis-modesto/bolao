import {Apostador} from "../models/Apostador.js"
import {Administrador} from "../models/Administrador.js"

export class TelaConsultaBoloes{
	exibirBoloes(){
		// recupera lista de boloes
	}
	visualizarBolao(){
		// exporta id do bolao para tela de exibição
	}
	confirmarBolao(){
		// se cpf eh de um administrador
		let user = new Administrador ();
		user.excluirBolao(bolao);
	}
}