import Apostador from "./Apostador.js"
import Bolao from "./Bolao.js"

class Notificacao{
    constructor(usuarioRemetente, bolao){
        this.usuarioRemetente = usuarioRemetente;
        this.bolao = bolao;
    }
    
    exibirNotificacao();
}