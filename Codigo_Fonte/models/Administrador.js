import Usuario from "./Usuario.js";
import Bolao from "./Bolao.js";

/**
*Classe que representa um usario especial que tem funcoes no sistema diferentes da classe Apostador
*/
class Administrador extends Usuario {

	/**
	*Exclui um bolao dos registros do SisBolao. Apaga dados de um bolao de arquivos gerais e arquivos voltados para usuarios especificos
	*/
	excluirBolao(bolao) {

	}


	/**
	*Exclui registros de um usuario do SisBolao. Apaga dados que possibilitam login e arquivos voltados somente para esse usuario
	*/
	excluirContaUsuario(usuario) {

	}
}
