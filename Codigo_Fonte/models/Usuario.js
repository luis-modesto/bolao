import {DataGetter} from "./DataGetter.js";

/**
*Classe que representa um usuario do SisBolao
*/
export class Usuario {

	/**
	*Construtor que inicializa uma instancia do tipo usuario, preenchendo os atributos cpf do usuario, nome do usuario e senha de acesso do usuario ao SisBolao
	*/
	constructor(cpf, nome, senha){
		this.cpf = cpf;
		this.nome = nome;
		this.senha = senha;
		let users = DataGetter.prototype.getInstance().getData('usuarios');
		for (let i = 0; i<users.length; i++){
			if (this.cpf==users[i][0] && this.senha==users[i][1]){
				this.respostaSeguranca = users[i][5];
				break;
			}
		}
	}


	/**
	*Registra informacoes necessarias para login - cpf, nome, senha e resposta de seguranca.
	*/
	criarConta(cpf, nome, senha, respostaSeguranca) {
		let user = cpf + ';' + senha + ';' + nome + ';0;500;' + respostaSeguranca + ';'; 
		DataGetter.prototype.getInstance().appendData('usuarios', user);
	}


	/**
	*Retorna informacoes de boloes finalizados para exibicao
	*/
	verificarResultados() {
		let boloes = DataGetter.prototype.getInstance().getData('bolao');
		let boloesinativos = [];
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][10])==0){
				boloesinativos.push(boloes[i]);
			}
		}
		return boloesinativos;
	}


	/**
	*Registra informacoes dadas pelo usuario sobre possivel bug no SisBolao
	*/
	reportarBugs(texto) {
		let b = this.cpf + ';' + texto + ';'; 
		DataGetter.prototype.getInstance().appendData('bugs', b);
	}


	/**
	*Efetua login no sistema, criando uma instancia de Apostador ou Administrador, caso as informacoes de login estejam corretas
	*/
	efetuarLogin(cpf, senha) {
		let users = DataGetter.prototype.getInstance().getData('usuarios');
		for (let i = 0; i<users.length; i++){
			if (cpf==users[i][0] && senha==users[i][1]){
				this.nome = users[i][2];
				return true;
			}
		}
		return false;
	}


	/**
	*Efetua logout, ecluindo instancia do usuario Apostador ou Administrador atual
	*/
	efetuarLogout() {
		//anular alguma variavel que indica o usuario corrente
	}


	/**
	*Retorna a senha do usuario atual, caso a resposta passada como parametro for igual a respostaSeguranca passada pelo usuario no momento em que ele criou a conta
	*/
	recuperarSenha(resposta){
		if (resposta==this.respostaSeguranca){
			return this.senha;
		}
		return "";
	}
}

//module.exports = Usuario;