import {Usuario} from "Usuario.js"
import {Bolao} from "Bolao.js"
import {Aposta} from "Aposta.js"
import {Jogo} from "Jogo.js"
import {Placar} from "Placar.js"
import {Convite} from "Convite.js"
import {Solicitacao} from "Solicitacao.js"
import {DataGetter} from "DataGetter.js"

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
	criarBolao(bolao) {
		let bolao = bolao.id + ';' + this.cpf + ';' + bolao.nome + ';' + bolao.campeonato + ';' + bolao.esporte +';' + './jogos_' + id + ';'; 
		for (i = 0; i<bolao.apostadores.length; i++){
			bolao += bolao.apostadores[i] + ',';
		}
		bolao += ';';
		let bolaouser = 'ativo;' + String(bolao.id) + ';';
		// escreve bolao no arquivo bolao
		DataGetter.getInstance().appendData('bolao', bolao);
		// escerve bolaouser no arquivo boloes_cpfuser
		DataGetter.getInstance().appendData('boloes' + this.cpf, bolaouser);
	}


	/**
	*Registra uma aposta, dado o placar de palpite e o jogo ao qual a aposta se refere
	*/
	criarAposta(placar, jogo) {
		let aposta = jogo.id + ';' + placar.pontosTime1 + ';' + placar.pontosTime2 + ';';
		// escreve no arquivo apostas_cpfuser
		DataGetter.getInstance().appendData('apostas_' + this.cpf, aposta);
		//desconta saldo
		this.saldo -= jogo.valorAposta;
	}


	/**
	*Edita uma aposta ja existente - caso ainda essa aposta ainda esteja editavel - dada qual aposta se deseja editar e com qual placar a aposta deve ser atualizada
	*/
	editarAposta(aposta, novoPlacar) {
		if(aposta.isEditavel == true){
			// procurar aposta no arquivo apostas_cpfuser
			let matrizApostas = DataGetter.getInstance().getData('apostas_' + this.cpf);
			for (i = 0; i<matrizApostas.length; i++){
				if (parseInt(matrizApostas[i][0])==aposta.idJogo){
					matrizApostas[i][1] = String(novoPlacar.pontosTime1);
					matrizApostas[i][2] = String(novoPlacar.pontosTime2);
					break;
				}
			}
			// escreve no arquivo apostas_cpfuser
			DataGetter.getInstance.setData('apostas_' + this.cpf, matrizApostas);
			return true;
		}
		return false;
	}


	/**
	*Registra convites a outros Apostadores para um bolao do qual eh administrador, dados os apostadores que se deseja convidar e o bolao que eles devem aceitar ou nao participar
	*/
	convidarApostadores(apostadores, bolao) {
		for(i=0; i<apostadores.length; j++){
			let convite = '1;' + this.cpf + ';' + bolao.id + ';';
			// escreve no arquivo convites_cpfuser
			for (i = 0; i<apostadores.length; i++){
				DataGetter.getInstance.appendData('notificacoes_' + apostadores[i], convite);
			}
		}
	}


	/**
	*Registra o Apostador que chama essa funcao como participante de um novo bolao, caso a resposta ao convite para esse bolao seja true. Exclui registros desse convite
	*/
	responderConviteBolao(convite, resposta) {
		let notificacoes = DataGetter.getInstance.getData('notificacoes_' + this.cpf);
		let novasNot = [];
		for (i = 0; i<notificacoes.length; i++){
			if (notificacoes[i][2]!=convite.bolao){
				novasNot.push(notificacoes[i]);
			}
		}
		if(resposta == true){
			// procurar bolao do convite que recebeu como parametro no arquivo de boloes
			let boloes = DataGetter.getInstance.getData('bolao');
			for (i = 0; i<boloes.length; i++){
				if (parseInt(boloes[i][0])==convite.bolao){
					let apostadoresBolao = "";
					for (j = 0; j<boloes[i][5].length; j++){
						if (boloes[i][5][j]!=';'){
							apostadoresBolao += boloes[i][5][j];
						} else {
							apostadoresBolao += ',' + this.cpf + ';';
							boloes[i][5] = apostadoresBolao;
							break;
						}
					}
					break;
				}
			}
			DataGetter.getInstance.setData('bolao', boloes);

			DataGetter.getInstance.appendData('boloes_' + this.cpf, 'ativo;' + String(convite.bolao)); //adiciona a boloes que participa
		}
		DataGetter.getInstance.setData('notificacoes_' + this.cpf, novasNot);
	}


	/**
	*Registra uma solicitacao ao Apostador administrador para participar de um dado bolao.
	*/
	solicitarParticiparBolao(bolao) {
		let solicitacao = '2' + this.cpf + ';' + bolao.id + ';\n';
		// escrever no arquivo solicitacoes_cpfuser do administrador do bolao
		DataGetter.getInstance.appendData('notificacoes_' + bolao.cpfAdmin, solicitacao);
	}


	/**
	*Registra o Apostador criador de uma dada solicitacao como participante de um bolao cujo Apostador que chama essa funcao eh administrador, caso a resposta para essa solicitacao seja true. Exclui registros dessa solicitacao
	*/
	responderSolicitacao(solicitacao, resposta) {
		let notificacoes = DataGetter.getInstance.getData('notificacoes_' + this.cpf);
		let novasNot = [];
		for (i = 0; i<notificacoes.length; i++){
			if (notificacoes[i][2]!=solicitacao.bolao){
				novasNot.push(notificacoes[i]);
			}
		}
		if(resposta == true){
			// procurar bolao da solicitacao que recebeu como parametro no arquivo de boloes
			let boloes = DataGetter.getInstance.getData('bolao');
			for (i = 0; i<boloes.length; i++){
				if (parseInt(boloes[i][0])==solicitacao.bolao){
					let apostadoresBolao = "";
					for (j = 0; j<boloes[i][5].length; j++){
						if (boloes[i][5][j]!=';'){
							apostadoresBolao += boloes[i][5][j];
						} else {
							apostadoresBolao += ',' + solicitacao.usuarioRemetente.cpf + ';';
							boloes[i][5] = apostadoresBolao;
							break;
						}
					}
					break;
				}
			}
			DataGetter.getInstance.setData('bolao', boloes);

			DataGetter.getInstance.appendData('boloes_' + solicitacao.usuarioRemetente.cpf, 'ativo;' + String(solicitacao.bolao)); //adiciona a boloes que participa
		}
		DataGetter.getInstance.setData('notificacoes_' + this.cpf, novasNot);
	}


	/**
	*Exclui um Apostador especifico da lista de Apostadores de um dado bolao cujo Apostador que chama essa funcao eh administrador. Exclui registros desse bolao da lista de boloes que o Apostador excluido participa
	*/
	excluirApostadorBolao(idBolao, cpfApostador) {
		// resgata cpfs dos apostadores arquivo do bolao
		let boloes = DataGetter.getInstance.getData('bolao');
		for (j = 0; j<boloes.length; j++){
			if (idBolao==boloes[j][0]){
				let cpfs_apostadores = boloes[j][5]; // string com tds os cpfs do bolao
				let cpf = '';
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
				boloes[j][5] = novo_cpfs_apostadores;
				// substitui cpfs_apostadores no arquivo do bolao por novo_cpfs_apostadores
				DataGetter.getInstance.setData('bolao', boloes);
				break;
			}
		}

		//resgata boloes que o usuario excluido participa
		let boloesuser = DataGetter.getInstance.getData('boloes_' + cpfApostador);
		let novosboloes = [];
		for (i = 0; i<boloesuser.length; i++){
			if (parseInt(boloesuser[i][1])!=idBolao){
				novosboloes.push(boloesuser[i]);
			}
		}
		DataGetter.getInstance.setData('boloes_' + cpfApostador, novosboloes);
	}


	/**
	*Instancia e registra um novo jogo referente a um dado bolao do qual o Apostador que chama essa funcao eh administrador
	*/
	cadastrarJogo(id, idBolao, jogo) {
		let novoJogo = id + ';' + jogo.data + ';' + jogo.limiteEdicaoAposta + ';' + jogo.time1 + ';' + jogo.time2 + ';-;-;' + jogo.valorAposta + ';';
		DataGetter.getInstance().appendData('jogos_' + idBolao, novoJogo);
	}


	/**
	*Registra o resultado de um jogo dado, pertencente a um bolao especifico do qual o Apostador que chama essa funcao eh administrador
	*/
	cadastrarResultados(placar, jogo, bolao) {
		jogo.resultado = placar;
		let jogos = DataGetter.getInstance().getData('jogos_' + bolao);
		for (i = 0; i<jogos.length; i++){
			if (parseInt(jogos[i][0])==jogo.id){
				let jogoVetor = [8];
				jogoVetor[0] = jogo.id;
				jogoVetor[1] = jogo.data;
				jogoVetor[2] = jogo.limiteEdicaoAposta;
				jogoVetor[3] = jogo.time1;
				jogoVetor[4] = jogo.time2;
				jogoVetor[5] = jogo.resultado.pontosTime1;
				jogoVetor[6] = jogo.resultado.pontosTime2;
				jogoVetor[7] = jogo.valorAposta;

				jogos[i] = jogoVetor;
				break;
			}
		}
		// escreve no arquivo jogos_idBolao
		DataGetter.getInstance.setData('jogos_' + bolao, jogos);
	}

	/**
	*Retorna todas as apostas ja feitas pelo Apostador que chama essa funcao
	*/
	verificarHistoricoApostas() {
		return DataGetter.getInstance().getData('apostas_' + this.cpf);
	}
}
