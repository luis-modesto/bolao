import {Usuario} from "../models/Usuario.js"

class TelaRecuperaSenha{
	recuperaSenha(){
		let user = new Usuario(document.getElementById('cpf'), '', '');
		user.recuperaSenha(document.getElementById('recuperaSenha'));
	}
}