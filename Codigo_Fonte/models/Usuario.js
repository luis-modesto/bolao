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
	}


	/**
	*Registra informacoes necessarias para login - cpf, nome e senha.
	*/
	cria_conta(cpf, nome, senha, respostaSeguranca) {
		
	}


	/**
	*Retorna informacoes de jogos finalizados para exibicao
	*/
	verificarResultados() {

	}


	/**
	*Registra informacoes dadas pelo usuario sobre possivel bug no SisBolao
	*/
	reportarBugs(texto) {

	}


	/**
	*Efetua login no sistema, criando uma instancia de Apostador ou Administrador, caso as informacoes de login estejam corretas
	*/
	efetuarLogin(cpf, senha) {

	}


	/**
	*Efetua logout, ecluindo instancia do usuario Apostador ou Administrador atual
	*/
	efetuarLogout() {

	}


	/**
	*Retorna a senha do usuario atual, caso a resposta passada como parametro for igual a respostaSeguranca passada pelo usuario no momento em que ele criou a conta
	*/
	recuperarSenha(resposta){

	}
}

export {Usuario};