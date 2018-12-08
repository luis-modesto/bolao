function addBolaoToDB(nome, campeonato, esporte) {
	let novoBolao = nome + ';' + campeonato + ';' + esporte +';' + './jogos_' + ';'; 
	novoBolao += ';';
	let bolaouser = 'ativo;'
	// escreve bolao no arquivo bolao
	DataGetter.getInstance().appendData('bolao', novoBolao);
	// escerve bolaouser no arquivo boloes_cpfuser
	DataGetter.getInstance().appendData('boloes', bolaouser);
}

function createNewBolao(){
	//Recebe os dados e cria o bolão
	var nome = document.getElementById('nome').value;
	var campeonato = document.getElementById('campeonato').value;
	var esporte = document.getElementById('esporte').value;
	
	// Escrever Bolao no Banco
	//addBolaoToDB(nome, campeonato, esporte);

	//Exibe o bolão criado na tela incial
	
}

/*
import {Apostador} from "../models/Apostador.js";


export class TelaCriaBolao(){
	confirmarCriacaoBolao(){
		let user = new Apostador(); 
		user.criarBolao(document.getElementByid('nome').value, document.getElementById('campeonato').value, document.getElementById('esporte'));
	}
}
*/