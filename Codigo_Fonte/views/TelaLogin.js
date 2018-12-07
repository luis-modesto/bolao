import {Usuario} from "../models/Usuario.js"

export class TelaLogin{


	login(){
		let user = new Usuario(document.getElementById('cpf'), '', document.getElementById('senha'));
		if(user.efetuarLogin(user.cpf, user.senha) == true){
			window.location.href = "./homepage.html";
		}
		else{
			window.location.href = "./login.html";
		}
	}
}