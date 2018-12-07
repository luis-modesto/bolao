import {Usuario} from "../models/Usuario.js"
import {Apostador} from "../models/Apostador.js"
import {Administrador} from "../models/Administrador.js"
import {Solicitacao} from "../models/Solicitacao.js"
import {Convite} from "../models/Convite.js"
import {DataGetter} from "../models/DataGetter.js"


class Homepage{

	visualizarNotificacao(){
		// recuperar lista de notificações do usuario 
	}

	aceitarNotificacao(){
		let user = new Apostador();
		if(notificacao é solicitacao){
			let solicitacao = new Solicitacao();
			user.responderSolicitacao(true, solicitacao);
		}
		else{
			let convite = new Convite();
			user.responderConvite(true, solicitacao);
		}
	}

	recusarNotificacao(){
		let user = new Apostador();
		if(notificacao é solicitacao){
			let solicitacao = new Solicitacao();
			user.responderSolicitacao(false, solicitacao);
		}
		else{
			let convite = new Convite();
			user.responderConvite(false, solicitacao);
		}
	}                 

	exibirBoloes(){
		// recuperar lista de bolões 
	}

	solicitarParticiparBolao(){
		let user = new Apostador();
		user.solicitarParticiparBolao(bolao);
	}
	visualizarBolao(){
		let id = document.getElementById('idBolao');
		// export id para o html de exibição de bolão	
	}
	visualizarApostas(){
		//exporta cpf do usuario para tela de historico de apostas
	}
}
