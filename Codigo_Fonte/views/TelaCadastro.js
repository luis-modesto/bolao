import {Usuario} from "../models/Usuario.js"

class TelaCadastro{
	criaConta(){
		let user = new Usuario(document.getElementById('cpf'), document.getElementById('nome'), document.getElementById('senha')); //torna o global
		user.criarConta(user.cpf, user.nome, user.senha, document.getElementById('respostaSegurança'));
	}
}