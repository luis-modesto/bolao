import {Aposta} from "../models/Aposta.js"
import {Apostador} from "../models/Apostador.js"

export class TelaHistoricoApostas(){

	exibirApostas(cpf){
		//recuperar lista de apostas do usuario 
		let minhasApostas = user.verificarHistoricoApostas(); //user global
		for (let i = 0; i<minhasApostas.length; i++){
			//acrescentar minhasApostas[i] na pagina
		}
	}
}