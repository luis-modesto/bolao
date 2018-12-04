import {Usuario} from "Usuario.js"
import {Bolao} from "Bolao.js"
import {Aposta} from "Aposta.js"
import {Jogo} from "Jogo.js"
import {Placar} from "Placar.js"
import {Convite} from "Convite.js"
import {Solicitacao} from "Solicitacao.js"

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
		let bolao = bolao.id + ';' + this.cpf + ';' + bolao.nome + ';' + bolao.campeonato + ';' + bolao.esporte +';' + './jogos_' + id + 'bolao;\n';
		let bolaouser = 'ativo;' + String(id) + '\n';
		// escreve bolao no arquivo bolao
		let fs = require('fs');
		fs.appendFile('../arquivos/bolao', bolao, function (err) {
		  if (err) throw err;
		});
		// escerve bolaouser no arquivo boloes_cpfuser
		fs.appendFile('../arquivos/boloes_' + this.cpf, bolao, function (err) {
		  if (err) throw err;
		});
	}


	/**
	*Registra uma aposta, dado o placar de palpite e o jogo ao qual a aposta se refere
	*/
	criarAposta(placar, jogo) {
		let aposta = this.cpf + ';' + jogo.id + ';' + placar.pontosTime1 + ';' + placar.pontosTime2 + '\n';
		// escreve no arquivo apostas_cpfuser
		let fs = require('fs');
		fs.appendFile('../arquivos/apostas_' + String(this.cpf), aposta, function(err){
			if (err) throw err;
		});
		//desconta saldo
		this.saldo -= jogo.valorAposta;
	}


	/**
	*Edita uma aposta ja existente - caso ainda essa aposta ainda esteja editavel - dada qual aposta se deseja editar e com qual placar a aposta deve ser atualizada
	*/
	editarAposta(aposta, novoPlacar) {
		if(aposta.isEditavel == true){
			// procurar aposta no arquivo apostas_cpfuser
			let nova_aposta = this.cpf + ';' + aposta.idJogo + ';' + novoPlacar.pontosTime1 + ';' + novoPlacar.pontosTime2po + '\n';
			// escreve no arquivo apostas_cpfuser
			let fs = require('fs');
			let contents = fs.readFileSync('apostas_'+String(this.cpf), 'utf8');
			let idAtual = "-1";
			let i = 0;
			let novoArquivo = "";
			//acha aposta velha
			while(i<contents.length){
				idAtual = "";
				while(contents[i]!=';'){
					idAtual += contents[i];
					i++;
				}
				if (parseInt(idAtual)!=aposta.idJogo){
					novoArquivo += idAtual;
					while(contents[i]!='\n'){
						novoArquivo += contents[i];
						i++;
					}
					novoArquivo += contents[i]; //pega \n
					i++;
				} else {
					break;
				}
			} 
			//ignora aposta velha
			while(i<contents.length && contents[i]!='\n'){
				i++;
			}  
			//salva resto do arquivo
			while(i<contents.length){
				i++;
				novoArquivo += contents[i];
			}
			//sobrescreve arquivo
			fs.writeFile('../arquivos/apostas_' + String(this.cpf), novoArquivo+nova_aposta, function(err){
				if (err) throw err;
			});
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
