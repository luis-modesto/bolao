<?php
require_once "./Notificacao.php";

/**
*Classe que representa uma notificacao do tipo convite. Um convite a participar de um bolao
*/
class Convite extends Notificacao{
    
    public $bolao;
    
	/**
	*Construtor que inicializa uma instancia de Convite, preenchendo os atributos usuarioRemetente indicando qual usuario enviou o convite e o bolao ao qual o Apostador esta sendo convidado
	*/
    function __construct($usuarioRemetente, $bolao){
        $this->usuarioRemetente = $usuarioRemetente;
        $this->bolao = $bolao;
    }


    /**
    *Retorna as informacoes desse convite para exibicao
    */
    function exibirNotificacao(){
        $user = $this->usuarioRemetente;
        $bolao = $this->bolao;
        $retorno = '<strong>'.$user->username.'</strong> te convidou para o bolão <strong>'.$bolao->nome.'</strong>'.PHP_EOL;
        return $retorno;   
    }
}
?>