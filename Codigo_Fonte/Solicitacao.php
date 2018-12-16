<?php
require_once "./Notificacao.php";

/**
*Classe que representa uma notificacao do tipo solicitacao. Uma solicitacao a participar de um bolao
*/
class Solicitacao extends Notificacao {
   
	/**
	*Construtor que inicializa uma instancia de Solicitacao, preenchendo os atributos usuarioRemetente indicando qual usuario enviou a solicitacao e o bolao a que a solicitacao se refere
	*/
    function __construct($usuarioRemetente, $bolao){
        $this->usuarioRemetente = $usuarioRemetente;
        $this->bolao = $bolao;
    }


    /**
    *Retorna as informacoes dessa solicitacao para exibicao
    */
    function exibirNotificacao(){
        $user = $this->usuarioRemetente;
        $bolao = $this->bolao;
        $retorno = '<strong>'.$user->cpf.'</strong> deseja participar do bolão <strong>'.$bolao->nome.'</strong>'.PHP_EOL;
        return $retorno;    
    }
}
?>