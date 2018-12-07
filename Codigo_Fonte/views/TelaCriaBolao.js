import {Apostador} from "../models/Apostador.js";

export class TelaCriaBolao(){
	confirmarCriacaoBolao(){
		let user = new Apostador(); 
		user.criarBolao(document.getElementByid('nome').value, document.getElementById('campeonato').value, document.getElementById('esporte'));
	}
}