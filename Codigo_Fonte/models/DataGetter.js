/**
*Classe de instancia unica que faz conexao com a base de dados
*/
export class DataGetter {

	/*constructor(){
		this.instance = null;
	}*/


	/**
	*Garante que a classe DataGetter so vai ter uma instancia. Se a classe nao tiver sido instanciada, cria uma nova instancia, se ja tiver sido instanciada, retorna essa instancia.
	*/
	getInstance(){
		if (this.instance==null){
			this.instance = new DataGetter();
		}
		return this.instance;
	}


	/**
	*Retorna o conteudo do arquivo cujo nome eh passado como parametro em forma de matriz
	*/
	getData(arquivo){
		let fs = require('fs');
		let contents = fs.readFileSync('../arquivos/' + arquivo, 'utf8');

		let retorno = [];
		let linha = [];
		let campo = "";

		for(let i = 0; i<contents.length; i++){
			if (contents[i]=='\n'){
				retorno.push(linha);
				linha = [];
			} else if (contents[i]==';'){
				linha.push(campo);
				campo = "";
			} else {
				campo += contents[i];
			}
		}
		return retorno;
	}


	/**
	*Substitui os dados do arquivo cujo nome eh recebido como parametro com o conteudo em data
	*/
	setData(arquivo, data){
		let fs = require('fs');
		if (data.length>0){
			if (data[0].length>0){
				fs.writeFile('../arquivos/' + arquivo, data[0][0] + ';', function(err){
					if (err) throw err;
				});
				for (let j = 1; j<data[0].length; j++){
					fs.appendFile('../arquivos/' + arquivo, data[0][j] + ';', function(err){
						if (err) throw err;
					});
				}
				fs.appendFile('../arquivos/' + arquivo, '\n', function(err){
					if (err) throw err;
				});
			}
			for (let i = 1; i<data.length; i++){
				for (let j = 0; j<data[i].length; j++){
					fs.appendFile('../arquivos/' + arquivo, data[i][j] + ';', function(err){
						if (err) throw err;
					});
				}
				fs.appendFile('../arquivos/' + arquivo, '\n', function(err){
					if (err) throw err;
				});
			}
		} else {
			fs.writeFile('../arquivos/' + arquivo, '', function(err){
				if (err) throw err;
			});
		}
	}


	/**
	*Incrementa o conteudo do arquivo cujo nome eh recebido como parametro com o conteudo em data
	*/
	appendData(arquivo, data){
		let fs = require('fs');
		fs.appendFile('../arquivos/' + arquivo, data + '\n', function(err){
			if (err) throw err;
		});
	}

}