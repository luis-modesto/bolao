import Notificacao from "./Notificacao.js"

/**
*Classe que representa uma notificacao do tipo solicitacao. Uma solicitacao a participar de um bolao
*/
export class Solicitacao {
   
	/**
	*Construtor que inicializa uma instancia de Solicitacao, preenchendo os atributos usuarioRemetente indicando qual usuario enviou a solicitacao e o bolao a que a solicitacao se refere
	*/
    constructor(usuarioRemetente, bolao){
        //super(usuarioRemetente, bolao);
        this.usuarioRemetente = usuarioRemetente;
        this.bolao = bolao;
    }



    /**
    *Retorna as informacoes dessa solicitacao para exibicao
    */
    exibirNotificacao(){
        console.log("Solicitacao");    
    }
}