import {Apostador} from "../models/Apostador.js";

class TelaCriaJogo{
	confirmarCriacaoJogo(){
		let user = new Apostador(); //global
		user.cadastrarJogo(idbolao, idjogo, data, datalimite, time1, time2, resultado, aposta);
	}
}