<?php
/**
*Classe de instancia unica que faz conexao com a base de dados
*/
class DataGetter {

	private static $instance;

	/**
	*Evitam que DataGetter seja instanciado fora da classe
	*/
	private function __constructor(){}
	private function __clone(){}
	private function __wakeup(){}

	/**
	*Garante que a classe DataGetter so vai ter uma instancia. Se a classe nao tiver sido instanciada, cria uma nova instancia, se ja tiver sido instanciada, retorna essa instancia.
	*/
	public static function getInstance(){
		if (self::$instance===null){
			self::$instance = new self;
		}
		return self::$instance;
	}


	/**
	*Retorna o conteudo do arquivo cujo nome eh passado como parametro em forma de matriz
	*/
	public function getData($nomearquivo){
		$arquivo = fopen($nomearquivo, 'r');
 		$retorno = array();
 		
		while(($linha = fgets($arquivo)) !== false){
			array_push($retorno, explode(';', $linha));
		}
		
		fclose($arquivo);

		return $retorno;
	}


	/**
	*Substitui os dados do arquivo cujo nome eh recebido como parametro com o conteudo em data
	*/
	public function setData($nomearquivo, $data){
		$arquivo = fopen($nomearquivo, 'w');

		for ($i = 0; $i<count($data); $i++){
			for ($j = 0; $j<count($data[$i]); $j++){
				fwrite($arquivo, $data[$i][$j] . ';');
			}
			fwrite($arquivo, PHP_EOL);
		}
		
		fclose($arquivo);
	}


	/**
	*Incrementa o conteudo do arquivo cujo nome eh recebido como parametro com o conteudo em data
	*/
	public function appendData($nomearquivo, $data){
		$arquivo = fopen($nomearquivo, 'a');
		fwrite($arquivo, $data . PHP_EOL);
		fclose($arquivo);
	}

}
?>