import {Usuario} from "../models/Usuario.js"
import {Apostador} from "../models/Apostador.js"
import {Administrador} from "../models/Administrador.js"
import {Solicitacao} from "../models/Solicitacao.js"
import {Convite} from "../models/Convite.js"
import {DataGetter} from "../models/DataGetter.js"
import {Bolao} from "../models/Bolao.js"


export class Homepage{

	visualizarNotificacao(){
		// recuperar lista de notificações do usuario 
	}

	aceitarNotificacao(notificacao){
		let user = new Apostador("cpf", "nome", "senha", "boloesCriados", "boloesParticipa", "boloesEncerrados", "saldo", "apostas", "convites", "solicitacoes"); //global
		if(notificacao instanceof Solicitacao){
			//let solicitacao = new Solicitacao();
			user.responderSolicitacao(true, notificacao);
		}
		else{
			//let convite = new Convite();
			user.responderConvite(true, notificacao);
		}
	}

	recusarNotificacao(notificacao){
		let user = new Apostador("cpfuser", "nome", "senha", "boloesCriados", "boloesParticipa", "boloesEncerrados", "saldo", "apostas", "convites", "solicitacoes"); //global
		if(notificacao instanceof Solicitacao){
			//let solicitacao = new Solicitacao();
			user.responderSolicitacao(false, notificacao);
		}
		else{
			//let convite = new Convite();
			user.responderConvite(false, notificacao);
		}
	}                 

	exibirBoloes(){
		//recuperar lista de bolões 
		let boloes = DataGetter.prototype.getInstance().getData('bolao');
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][10])==1){
				//acrescentar boloes[i] no html
			}
		}
		for (let i = 0; i<boloes.length; i++){
			if (parseInt(boloes[i][10])==0){
				//acrescentar boloes[i] no html
			}
		}
	}

	solicitarParticiparBolao(){
		let user = new Apostador(); //global
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

/*let h = new Homepage();
let user = new Apostador("cpfuser", "nome", "senha", "boloesCriados", "boloesParticipa", "boloesEncerrados", "saldo", "apostas", "convites", "solicitacoes");
let b = new Bolao(1, "nome", "campeonato", "esporte", "jogos", "cpfuser", "apostadores", "pontApostador", "ptsAcertarPlacar", "ptsAcertarVencedor", "premio", 1);
user.criarBolao(b);
let s = new Solicitacao("usuarioRemetente", 1);
h.recusarNotificacao(s);*/