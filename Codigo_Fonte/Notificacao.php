<?php
/**
*Classe que representa uma notificacao a um usuario
*/
abstract class Notificacao{

	public $usuarioRemetente;
	public $bolao;

    /**
    *Metodo abstrato a ser implementado pelas classes filhas (tipos de notificacao) especificando a forma como cada classe deve exibir suas informacoes
    */
    abstract function exibirNotificacao();
}
?>