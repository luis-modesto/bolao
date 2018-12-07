/**
*Classe que representa uma notificacao a um usuario
*/
class Notificacao{

    /**
    *Metodo abstrato a ser implementado pelas classes filhas (tipos de notificacao) especificando a forma como cada classe deve exibir suas informacoes
    */
    /*exibirNotificacao(){
    	if (this === Notificacao) {
	      throw new TypeError("Metodo Abstrato");
	    } else if (this.exibirNotificacao === Notificacao.exibirNotificacao) {
	      throw new TypeError("Metodo abstrato deve ser implementado.");
	    } else {
	      throw new TypeError("Chamando metodo abstrato de classe abstrata.");
	    }
    }*/


	/**
	*Construtor que inicializa uma instancia de Notificacao, preenchendo os atributos usuarioRemetente indicando qual usuario enviou o convite e o bolao ao qual o Apostador esta sendo convidado
	*/
	constructor(usuarioRemetente, bolao){
        /*if (this.constructor === Notificacao) {
	      throw new TypeError("Instaciando classe abstrata.");
	    }
	    if (this.exibirNotificacao === Notificacao.prototype.exibirNotificacao) {
	      throw new TypeError("Metodo abstrato deve ser implementado.");
	    }*/
	    this.usuarioRemetente = usuarioRemetente;
	    this.bolao = bolao;
    }

}