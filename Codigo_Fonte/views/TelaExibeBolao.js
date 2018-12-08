import {Apostador} from "../models/Apostador.js";
import {Aposta} from "../models/Aposta.js"

export class TelaExibeBolao{
	confirmarAposta(){
		let user = new Apostador(); //global
		user.criarAposta(placar, idjogo); //pegar placar e idjogo da tela
	}
	confirmarEdicaoAposta(){
		let user = new Apostador(); //global
		let aposta = new Aposta(); //inicializar Aposta com informacoes exibidas na tela
		user.editarAposta(aposta);
	}
	confirmarExclusao(){
		let user = new Apostador(); //global
		let userExcluido = new Apostador(); //talvez so precise pegar o cpf pela informacao da tela mesmo, e nao uma instancia de Apostador
		user.excluirApostadorBolao(idBolao, userExcluido.cpf);
	}
	enviarConvite(){
		let user = new Apostador(); //global
		user.convidarApostadores(apostadores[], bolao); //preencher lista de apostadores com lista que Administrador do bolao foi selecionando
	}
	cofirmarResultado(){
		let user = new Apostador(); //global
		user.cadastrarResultados(placar, jogo, bolao); //placar vai vir de um form, o id do jogo deve dar pra pegar da tela prq no momento que essa funcao eh chamada, o jogo ja foi selecionado
	}
	exibirInfosBolao(idBolao){
		// recupera informaçoes do bolao
		let boloes = DataGetter.prototype.getInstance().getData('bolao');
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][0])==idBolao){
				//acrescentar informacoes de boloes[i] no html
				break;
			}
		}
	}
}