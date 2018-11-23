import Usuario from "./Usuario.js"
import Bolao from "./Bolao.js"
import Aposta from "./Aposta.js"
import Jogo from "./Jogo.js"
import Placar from "./Placar.js"

class Apostador extends Usuario {

	constructor(boloesCriados, boloesParticipa, boloesEncerrados, saldo, apostas){
		this.boloesCriados = boloesCriados;
		this.boloesParticipa = boloesParticipa;
		this.boloesEncerrados = boloesEncerrados;
		this.saldo = saldo;
		this.apostas = apostas;
	}

	criarBolao(String nome, String campeonato, String esporte) {
		let bolao = this.cpf + ';' + nome + ';' + campeonato + ';' + esporte +';' + './jogos_bolao;';
	}

	criarAposta(Placar placar, Jogo jogo, Bolao bolao) {
		let bolaoarq[5]; // arq_jogos; 
		let aposta = this.cpf + ';' + bolaoarq[5] + ';' + placar.pontosTime1 + ';' + placar.pontosTime2;
	}

	editarAposta(Aposta aposta) {
		if(aposta.isEditavel == true){
			let novopontosTime1;
			let novopontosTime2;
			let aposta = this.cpf + ';' + bolaoarq[5] + ';' + novopontosTime1 + ';' + novopontosTime2;
		}
	}

	convidarApostadores(Apostador[] apostadores, Bolao bolao) {
		// precisamos de uma classe convite ou notificação 
	}

	responderConviteBolao(Bolao bolao) {
		// precisamos de uma classe convite ou notificação
		// caso o convite seja aceito
		let bolaoarq[6] = bolaoarq[6] + ',' + this.cpf;  //cpf apostadores será igual a o que estava antes + cpf de quem aceitou o convite
	}

	solicitarParticiparBolao(Bolao bolao) {
		// precisamos de uma classe solicitação ou notificação
	}

	responderSolicitacao(Bolao bolao, Usuario userSolicitante) {
		// precisamos de uma classe solicitação ou notificação
		// caso a solicitação seja aceita
		let bolaoarq[6] = bolaoarq[6] + ',' + userSolicitante.cpf;
	}

	excluirApostadorBolao(Bolao bolao, Apostador apostador) {
		let cpf = '';
		let j = 0;
		for(i=0; i<bolaoarq[6].length; i++){
			if(bolaoarq[6][i] != ','){
				cpf += bolaoarq[6][i];
			}
			if(cpf == apostador.cpf){
				break; // quando achar o cpf do apostador, para o for
			}
			if(bolaoarq[6][i] == ','){ // achou virgula significa que um novo cpf esta por vir e n achamos o que procuramos ainda
				cpf = ''; // zera o cpf atual
				j = i; // j sera sempre de onde começa um novo cpf
			}
		}
		// remover 9 dígitos (cpf) a partir da posição j
	}

	cadastrarJogo(Bolao bolao, Jogo jogo) {
		let jogo = jogo.data + ';' + jogo.limiteEdicaoAposta + ';' + jogo.time1 + ';' + jogo.time2 + ';-;-;' + jogo.valorAposta;
	}

	cadastrarResultados(Placar placar, Jogo jogo, Bolao bolao) {

	}

	verificarHistoricoApostas() {
		
	}
}
