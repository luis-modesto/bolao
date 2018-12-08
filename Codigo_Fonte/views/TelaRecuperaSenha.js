import {Usuario} from "../models/Usuario.js"

class TelaRecuperaSenha{
	recuperaSenha(){
		let user = new Usuario(document.getElementById('cpf'), '', ''); //global
		user.recuperaSenha(document.getElementById('recuperaSenha'));
	}
}