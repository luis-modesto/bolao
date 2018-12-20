<?php
require_once "./Notificacao.php";
require_once "./Usuario.php";
require_once "./Apostador.php";
require_once "./Administrador.php";

/**
*Classe que representa uma notificacao do tipo solicitacao. Uma solicitacao a participar de um bolao
*/
class Bug extends Notificacao {
   
    public $texto;
    public $tela;
    
	/**
	*Construtor que inicializa uma instancia de Solicitacao, preenchendo os atributos usuarioRemetente indicando qual usuario enviou a solicitacao e o bolao a que a solicitacao se refere
	*/
    function __construct($id, $usuarioRemetente, $texto, $tela){
        $this->id = $id;
        $this->usuarioRemetente = $usuarioRemetente;
        $this->texto = $texto;
        $this->tela = $tela;
    }


    /**
    *Retorna as informacoes dessa solicitacao para exibicao
    */
    function exibirNotificacao(){
        $user = $this->usuarioRemetente;
        $retorno = '<strong>'. $user->username .'</strong> reportou um bug na tela <strong>'.$this->tela.'</strong>:
        <div style="border: solid 2px;">'. 
            $this->texto
        .'</div>'.PHP_EOL;
        return $retorno;    
    }
}
?>