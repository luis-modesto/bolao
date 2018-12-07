import Notificacao from "./Notificacao.js"

/**
*Classe que representa uma notificacao do tipo convite. Um convite a participar de um bolao
*/
export class Convite{
    
	/**
	*Construtor que inicializa uma instancia de Convite, preenchendo os atributos usuarioRemetente indicando qual usuario enviou o convite e o bolao ao qual o Apostador esta sendo convidado
	*/
    constructor(usuarioRemetente, bolao){
        //super(usuarioRemetente, bolao);
        this.usuarioRemetente = usuarioRemetente;
        this.bolao = bolao;
    }


    /**
    *Retorna as informacoes desse convite para exibicao
    */
    exibirNotificacao(){
        console.log("Convite");   
    }
}