import {Usuario} from "../models/Usuario.js";

export class TelaLogin{
	login(){
		let user = new Usuario(document.getElementById('cpf').value, '', document.getElementById('senha').value);
		if(user.efetuarLogin(user.cpf, user.senha) == true){
			window.location.href = "./homepage.html";
		}
		else{
			alert("CPF ou senha inválido");
			window.location.href = "./login.html";
		}
	}
}