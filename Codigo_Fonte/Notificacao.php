<?php
/**
*Classe que representa uma notificacao a um usuario
*/
abstract class Notificacao{

	public $usuarioRemetente;
	public $bolao;
	/**
	*Construtor que inicializa uma instancia de Notificacao, preenchendo os atributos usuarioRemetente indicando qual usuario enviou o convite e o bolao ao qual o Apostador esta sendo convidado
	*/
	function __construct($usuarioRemetente, $bolao){
	    $this->usuarioRemetente = $usuarioRemetente;
	    $this->bolao = $bolao;
    }

    /**
    *Metodo abstrato a ser implementado pelas classes filhas (tipos de notificacao) especificando a forma como cada classe deve exibir suas informacoes
    */
    abstract function exibirNotificacao();
}
?>