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

	}

	criarAposta(Placar placar, Jogo jogo, Bolao bolao) {

	}

	consultaBolao(Bolao bolao) {

	}

	editarAposta(Aposta aposta) {

	}

	convidarApostadores(Apostador[] apostadores, Bolao bolao) {

	}

	responderConviteBolao(Bolao bolao) {

	}

	solicitarParticiparBolao(Bolao bolao) {

	}

	responderSolicitacao(Bolao bolao, Usuario userSolicitante) {

	}

	excluirApostadorBolao(Bolao bolao, Apostador apostador) {

	}

	cadastrarJogo(Bolao bolao, Jogo jogo) {

	}

	cadastrarResultados(Placar placar, Jogo jogo, Bolao bolao) {

	}

	verificarHistoricoApostas() {

	}
}
