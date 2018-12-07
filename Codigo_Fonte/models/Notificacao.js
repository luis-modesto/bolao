import {Apostador} from "./Apostador.js"
import {Bolao} from "./Bolao.js"

/**
*Classe que representa uma notificacao a um usuario
*/
class Notificacao{

    /**
    *Metodo abstrato a ser implementado pelas classes filhas (tipos de notificacao) especificando a forma como cada classe deve exibir suas informacoes
    */
    exibirNotificacao();
}