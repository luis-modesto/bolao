import {Apostador} from "../models/Apostador.js";
import {Aposta} from "../models/Aposta.js"

export class TelaExibeBolao{
	confirmarAposta(){
		let user = new Apostador();
		user.criarAposta(placar, idjogo);
	}
	confirmarEdicaoAposta(){
		let user = new Apostador();
		let aposta = new Aposta();
		user.editarAposta(aposta);
	}
	confirmarExclusao(){
		let user = new Apostador();
		let userExcluido = new Apostador();
		user.excluirApostadorBolao(idBolao, userExcluido.cpf);
	}
	enviarConvite(){
		let user = new Apostador();
		user.convidarApostadores(apostadores[], bolao);
	}
	cofirmarResultado(){
		let user = new Apostador();
		user.cadastrarResultados(placar, jogo, bolao);
	}
	exibirInfosBolao(idBolao){
		// recupera informaçoes do bolao
	}
}