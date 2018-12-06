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
		let usuarios = DataGetter.getInstance.getData('usuarios');
		for (i = 0; i<users.length; i++){
			if (this.cpf==users[i][0] && this.senha==users[i][1]){
				respostaSeguranca = users[i][5];
				break;
			}
		}
	}


	/**
	*Registra informacoes necessarias para login - cpf, nome, senha e resposta de seguranca.
	*/
	cria_conta(cpf, nome, senha, respostaSeguranca) {
		let user = cpf + ';' + senha + ';' + nome + ';0;500;' + respostaSeguranca + ';'; 
		DataGetter.getInstance().appendData('usuarios', user);
	}


	/**
	*Retorna informacoes de jogos finalizados para exibicao
	*/
	verificarResultados() {
		let boloes = DataGetter.getInstance.getData('bolao');
		let boloesativos = [];
		for (i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][11])==1){
				boloesativos.push(boloes[i]);
			}
		}
		return boloesativos;
	}


	/**
	*Registra informacoes dadas pelo usuario sobre possivel bug no SisBolao
	*/
	reportarBugs(texto) {
		let b = this.cpf + ';' + texto + ';'; 
		DataGetter.getInstance().appendData('bugs', b);
	}


	/**
	*Efetua login no sistema, criando uma instancia de Apostador ou Administrador, caso as informacoes de login estejam corretas
	*/
	efetuarLogin(cpf, senha) {
		let users = DataGetter.getInstance.getData('usuarios');
		for (i = 0; i<users.length; i++){
			if (cpf==users[i][0] && senha==users[i][1]){
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

export {Usuario};