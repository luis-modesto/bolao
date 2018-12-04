import Usuario from "./Usuario.js"
import Bolao from "./Bolao.js"
import Aposta from "./Aposta.js"
import Jogo from "./Jogo.js"
import Placar from "./Placar.js"
import Convite from "./Convite.js"
import Solicitacao from "./Solicitacao.js"

/**
*Classe que representa um usuario Apostador
*/
class Apostador extends Usuario {

	/**
	*Construtor que inicializa uma instancia de Apostador, preenchendo os atributos: boloesCriados, que contem informacoes dos boloes que esse apostador criou; boloesParticipa que contem informacoes dos boloes que esse apostador participa;
	*boloesEncerrados, que contem informacoes dos boloes que esse Apostador participou mas que ja se finalizaram todos os jogos e o vencedor geral ja foi declarado; saldo, que representa o quanto de cash o Apostador tem disponivel para fazer apostas;
	*apostas, que contem informacoes de todas as apostas que o Apostador ja fez; convites, que contem os convites que o Apostador recebeu e ainda nao respondeu; e solicitacoes, que contem as solicitacoes que o Apostador recebeu e ainda nao respondeu.
	*/
	constructor(boloesCriados, boloesParticipa, boloesEncerrados, saldo, apostas, convites, solicitacoes){
		this.boloesCriados = boloesCriados;
		this.boloesParticipa = boloesParticipa;
		this.boloesEncerrados = boloesEncerrados;
		this.saldo = saldo;
		this.apostas = apostas;
		this.convites = convites;
		this.solicitacoes = solicitacoes;
	} 


	/**
	*Instancia e registra um novo bolao, do qual o Apostador que chama a funcao sera administrador
	*/
	criarBolao(id, nome, campeonato, esporte) {
		let bolao = id + ';' + this.cpf + ';' + nome + ';' + campeonato + ';' + esporte +';' + './jogos_' + id + 'bolao;';
		let bolaouser = 'ativo;' + String(id);
		// escreve bolao no arquivo bolao
		// escerve bolaouser no arquivo boloes_cpfuser
	}


	/**
	*Instancia e registra uma aposta, dado o placar de palpite e o jogo ao qual a aposta se refere
	*/
	criarAposta(placar, idJogo) {
		// procurar jogo no arquivo de jogos ./jogoidbolao
		let aposta = this.cpf + ';' + idJogo + ';' + placar.pontosTime1 + ';' + placar.pontosTime2;
		// escreve no arquivo apostas_cpfuser
		//desconta saldo
	}


	/**
	*Edita uma aposta ja existente - caso ainda essa aposta ainda esteja editavel - dada qual aposta se deseja editar e com qual placar a aposta deve ser atualizada
	*/
	editarAposta(aposta, novoPlacar) {
		if(aposta.isEditavel == true){
			// procurar aposta no arquivo apostas_cpfuser
			let nova_aposta = this.cpf + ';' + aposta.idJogo + ';' + novoPlacar.pontosTime1 + ';' + novoPlacar.pontosTime2po;
			// escreve no arquivo apostas_cpfuser  
		}
	}


	/**
	*Registra convites a outros Apostadores para um bolao do qual eh administrador, dados os apostadores que se deseja convidar e o bolao que eles devem aceitar ou nao participar
	*/
	convidarApostadores(apostadores, bolao) {
		for(i=0; i<apostadores.length; j++){
			// procurar bolao que recebeu como parametro no arquivo de boloes
			let convite = this.cpf + ';' + id_bolao;
			// escreve no arquivo convites_cpfuser
		}
	}


	/**
	*Registra o Apostador que chama essa funcao como participante de um novo bolao, caso a resposta ao convite para esse bolao seja true. Exclui registros desse convite
	*/
	responderConviteBolao(convite, resposta) {
		if(resposta == true){
			// procurar bolao do convite que recebeu como parametro no arquivo de boloes
			let apostadoresBolao = cpfs_apostadores;  //variavel recebe cpf dos apostadores que ja estavam no bolao
			apostadoresBolao += ',' + this.cpf; // e adiciona o cpf deste q aceitou o convite
		}
		// exclui convite do arquivo convites_cpfuser
	}


	/**
	*Registra uma solicitacao ao Apostador administrador para participar de um dado bolao.
	*/
	solicitarParticiparBolao(bolao) {
		// procurar bolao no arquivo de boloes
		let solicitacao = this.cpf + ';' + id_bolao;
		// escrever no arquivo solicitacoes_cpfuser do administrador do bolao
	}


	/**
	*Registra o Apostador criador de uma dada solicitacao como participante de um bolao cujo Apostador que chama essa funcao eh administrador, caso a resposta para essa solicitacao seja true. Exclui registros dessa solicitacao
	*/
	responderSolicitacao(solicitacao, resposta) {
		if(resposta == true){
			// procurar bolao da solicitacao que recebeu como parametro no arquivo de boloes
			let apostadoresBolao = cpfs_apostadores;  //variavel recebe cpf dos apostadores que ja estavam no bolao
			apostadoresBolao += ',' + solicitacao.usuarioRemetente.cpf; // e adiciona o cpf deste q solicitou a entrada
		}
		// exclui solicitacao do arquivo solicitacoes_cpfuser
	}


	/**
	*Exclui um Apostador especifico da lista de Apostadores de um dado bolao cujo Apostador que chama essa funcao eh administrador. Exclui registros desse bolao da lista de boloes que o Apostador excluido participa
	*/
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


	/**
	*Instancia e registra um novo jogo referente a um dado bolao do qual o Apostador que chama essa funcao eh administrador
	*/
	cadastrarJogo(id, idBolao, jogo) {
		let jogo = id + ';' + jogo.data + ';' + jogo.limiteEdicaoAposta + ';' + jogo.time1 + ';' + jogo.time2 + ';-;-;' + jogo.valorAposta;
	}


	/**
	*Edita informacoes de um jogo dado, caso ele ainda seja editavel
	*/
	editarJogo(jogoAtualizado){

	}


	/**
	*Registra o resultado de um jogo dado, pertencente a um bolao especifico do qual o Apostador que chama essa funcao eh administrador
	*/
	cadastrarResultados(placar, jogo, bolao) {

	}

	/**
	*Retorna todas as apostas ja feitas pelo Apostador que chama essa funcao
	*/
	verificarHistoricoApostas() {
		
	}
}
