import Usuario from "./Usuario.js"
import Bolao from "./Bolao.js"
import Aposta from "./Aposta.js"
import Jogo from "./Jogo.js"
import Placar from "./Placar.js"
import Convite from "./Convite.js"
import Solicitacao from "./Solicitacao.js"

class Apostador extends Usuario {

	constructor(boloesCriados, boloesParticipa, boloesEncerrados, saldo, apostas, convites, solicitacoes){
		this.boloesCriados = boloesCriados;
		this.boloesParticipa = boloesParticipa;
		this.boloesEncerrados = boloesEncerrados;
		this.saldo = saldo;
		this.apostas = apostas;
		this.convites = convites;
		this.solicitacoes = solicitacoes;
	} 

	criarBolao(id, nome, campeonato, esporte) {
		let bolao = id + ';' + this.cpf + ';' + nome + ';' + campeonato + ';' + esporte +';' + './jogos_' + id + 'bolao;';
		let bolaouser = 'ativo;' + String(id);
		// escreve bolao no arquivo bolao
		// escerve bolaouser no arquivo boloes_cpfuser
	}

	criarAposta(placar, idJogo) {
		// procurar jogo no arquivo de jogos ./jogoidbolao
		let aposta = this.cpf + ';' + idJogo + ';' + placar.pontosTime1 + ';' + placar.pontosTime2;
		// escreve no arquivo apostas_cpfuser
	}

	editarAposta(aposta, novoPlacar) {
		if(aposta.isEditavel == true){
			// procurar aposta no arquivo apostas_cpfuser
			let nova_aposta = this.cpf + ';' + aposta.idJogo + ';' + novoPlacar.pontosTime1 + ';' + novoPlacar.pontosTime2po;
			// escreve no arquivo apostas_cpfuser  
		}
	}

	convidarApostadores(apostadores, bolao) {
		for(i=0; i<apostadores.length; j++){
			// procurar bolao que recebeu como parametro no arquivo de boloes
			let convite = this.cpf + ';' + id_bolao;
			// escreve no arquivo convites_cpfuser
		}
	}

	responderConviteBolao(convite, resposta) {
		if(resposta == true){
			// procurar bolao do convite que recebeu como parametro no arquivo de boloes
			let apostadoresBolao = cpfs_apostadores;  //variavel recebe cpf dos apostadores que ja estavam no bolao
			apostadoresBolao += ',' + this.cpf; // e adiciona o cpf deste q aceitou o convite
		}
		// exclui convite do arquivo convites_cpfuser
	}

	solicitarParticiparBolao(bolao) {
		// procurar bolao no arquivo de boloes
		let solicitacao = this.cpf + ';' + id_bolao;
		// escrever no arquivo solicitacoes_cpfuser do administrador do bolao
	}

	responderSolicitacao(solicitacao, resposta) {
		if(resposta == true){
			// procurar bolao da solicitacao que recebeu como parametro no arquivo de boloes
			let apostadoresBolao = cpfs_apostadores;  //variavel recebe cpf dos apostadores que ja estavam no bolao
			apostadoresBolao += ',' + solicitacao.usuarioRemetente.cpf; // e adiciona o cpf deste q solicitou a entrada
		}
		// exclui solicitacao do arquivo solicitacoes_cpfuser
	}

	excluirApostadorBolao(idBolao, cpfApostador) {
		let cpf = '';
		let j = 0;
		// resgata cpfs dos apostadores arquivo do bolao
		let cpfs_apostadores; // string com tds os cpfs do bolao
		let novo_cpfs_apostadores = '';
		for(i=0; i<cpfs_apostadores.length; i++){
			if(cpfs_apostadores[i] != ','){
				cpf += cpfs_apostadores[i];
			}
			else if(cpfs_apostadores[i] == ','){ // achou virgula significa que um novo cpf esta por vir e n achamos o que procuramos ainda
				if(cpf != cpfApostador){
					novo_cpfs_apostadores += cpf + ',';
				}
				cpf = ''; // zera o cpf atual
			}
		}
		// substitui cpfs_apostadores no arquivo do bolao por novo_cpfs_apostadores
	}

	cadastrarJogo(id, bolao, jogo) {
		let jogo = id + ';' + jogo.data + ';' + jogo.limiteEdicaoAposta + ';' + jogo.time1 + ';' + jogo.time2 + ';-;-;' + jogo.valorAposta;
	}

	cadastrarResultados(placar, jogo, bolao) {

	}

	verificarHistoricoApostas() {
		
	}
}
