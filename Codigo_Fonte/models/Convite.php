<?php
require_once "Notificacao.php";

/**
*Classe que representa uma notificacao do tipo convite. Um convite a participar de um bolao
*/
class Convite extends Notificacao{
    
	/**
	*Construtor que inicializa uma instancia de Convite, preenchendo os atributos usuarioRemetente indicando qual usuario enviou o convite e o bolao ao qual o Apostador esta sendo convidado
	*/
    function __construct($usuarioRemetente, $bolao){
        parent::Notificacao($usuarioRemetente, $bolao);
    }


    /**
    *Retorna as informacoes desse convite para exibicao
    */
    function exibirNotificacao(){
        echo "Convite";   
    }
}
?>