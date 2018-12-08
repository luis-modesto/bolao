import {Usuario} from "./Usuario.js";
import {Bolao} from "./Bolao.js";
import {DataGetter} from "./DataGetter.js";

/**
*Classe que representa um usario especial que tem funcoes no sistema diferentes da classe Apostador
*/
export class Administrador extends Usuario {

	/**
	*Construtor que inicializa uma instancia de Administrador, preenchendo os atributos cpf, nome e senha do usuario
	*/
    constructor(cpf, nome, senha){
        super(cpf, nome, senha);
    }

	/**
	*Exclui um bolao dos registros do SisBolao. Apaga dados de um bolao de arquivos gerais e arquivos voltados para usuarios especificos
	*/
	excluirBolao(bolao) {
		let boloes = DataGetter.prototype.getInstance().getData('bolao');
		let novosboloes = [];
		let apostadores = [];
		for (j = 0; j<boloes.length; j++){
			if (bolao.id==parseInt(boloes[j][0])){
				let cpfs_apostadores = boloes[j][5]; // string com tds os cpfs do bolao
				let cpf = '';
				for(i=0; i<cpfs_apostadores.length; i++){
					if(cpfs_apostadores[i] != ','){
						cpf += cpfs_apostadores[i];
					} else if(cpfs_apostadores[i] == ','){ // achou virgula significa que um novo cpf esta por vir
						apostadores.push(cpf);
						cpf = ''; // zera o cpf atual
					}
				}
			} else {
				novosboloes.push(boloes[j]);
			}
		}
		DataGetter.prototype.getInstance().setData('bolao', novosboloes);

		//resgata boloes que o usuario excluido participa
		for (i = 0; i<apostadores.length; i++){
			let boloesuser = DataGetter.prototype.getInstance().getData('boloes_' + apostadores[i]);
			let novosboloesuser = [];
			for (j = 0; j<boloesuser.length; j++){
				if (parseInt(boloesuser[j][1])!=bolao.id){
					novosboloesuser.push(boloesuser[j]);
				}
			}
			DataGetter.prototype.getInstance().setData('boloes_' + apostadores[i], novosboloesuser);
		}
	}


	/**
	*Exclui registros de um usuario do SisBolao. Apaga dados que possibilitam login e arquivos voltados somente para esse usuario
	*/
	excluirContaUsuario(usuario) {
		let users = DataGetter.prototype.getInstance().getData('usuarios');
		let novosusuarios = [];
		for (i = 0; i<users.length; i++){
			if (usuario.cpf!=users[i][0]){
				novosusuarios.push(users[i]);
			}
		}
		DataGetter.prototype.getInstance().setData('usuarios', novosusuarios);
	}
}
