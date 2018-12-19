<?php
require_once "./Usuario.php";
require_once "./Bolao.php";
require_once "./DataGetter.php";
require_once "./Aposta.php";
require_once "./Jogo.php";
require_once "./Placar.php";
require_once "./Convite.php";
require_once "./Solicitacao.php";

/**
*Classe que representa um usuario Apostador
*/
class Apostador extends Usuario{

	public $boloesCriados;
	public $boloesParticipa;
	public $boloesEncerrados;
	public $saldo;
	public $apostas;
	public $convites;
	public $solicitacoes;

	/**
	*Construtor que inicializa uma instancia de Apostador, preenchendo os atributos: boloesCriados, que contem informacoes dos boloes que esse apostador criou; boloesParticipa que contem informacoes dos boloes que esse apostador participa;
	*boloesEncerrados, que contem informacoes dos boloes que esse Apostador participou mas que ja se finalizaram todos os jogos e o vencedor geral ja foi declarado; saldo, que representa o quanto de cash o Apostador tem disponivel para fazer apostas;
	*apostas, que contem informacoes de todas as apostas que o Apostador ja fez; convites, que contem os convites que o Apostador recebeu e ainda nao respondeu; e solicitacoes, que contem as solicitacoes que o Apostador recebeu e ainda nao respondeu.
	*/
	function __construct($username, $cpf, $nome, $senha, $boloesCriados, $boloesParticipa, $boloesEncerrados, $saldo, $apostas, $convites, $solicitacoes){
		$this->username = $username;
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->senha = $senha;
		$this->boloesCriados = $boloesCriados;
		$this->boloesParticipa = $boloesParticipa;
		$this->boloesEncerrados = $boloesEncerrados;
		$this->saldo = $saldo;
		$this->apostas = $apostas;
		$this->convites = $convites;
		$this->solicitacoes = $solicitacoes;
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		if($this->cpf != '' && $this->username == '' && $this->nome == '' && $this->senha == ''){
			for ($i = 0; $i<count($users); $i++){
				if ($this->cpf==$users[$i][0]){
					$this->respostaSeguranca = $users[$i][5];
					$this->senha = $users[$i][1];
					$this->username = $users[$i][6];
					break;
				}
			}
		}
	} 


	/**
	*Metodo concreto que implementa o metodo abstrato em Usuario. Carrega informacoes do apostador e o registra como usuario atual do sistema, caso cpf e senha sejam compativeis
	*/
	function efetuarLogin($username, $senha) {
		$dg = DataGetter::getInstance();
		$users = $dg->getData('usuarios');
		for ($i = 0; $i<count($users); $i++){
			if ($username==$users[$i][6] && $senha==$users[$i][1]){
				$this->cpf = $users[$i][0];
				$cpf = $this->cpf;
				$this->nome = $users[$i][2];
				$this->saldo = intval($users[$i][4]);
				
				$boloes = $dg->getData('bolao');
				for ($j = 0; $j<count($boloes); $j++){
					if ($boloes[$j][1]==$cpf){

						$jogos = array();
						$jogosBolao = $dg->getData('jogos_' . $boloes[$j][0]);
						for ($k = 0; $k<count($jogosBolao); $k++){
							$placar = new Placar($jogosBolao[$k][5], $jogosBolao[$k][6]);
							$jg = new Jogo($jogosBolao[$k][0], $jogosBolao[$k][1], $jogosBolao[$k][2], $jogosBolao[$k][3], $jogosBolao[$k][4], $placar, intval($jogosBolao[$k][7]));
							array_push($jogos, $jg); 
						}
						$b = new Bolao($boloes[$j][0], $boloes[$j][2], $boloes[$j][3], $boloes[$j][4], $jogos,$boloes[$j][1], explode(',', $boloes[$j][5]), explode(',', $boloes[$j][6]), intval($boloes[$j][7]), intval($boloes[$j][8]), intval($boloes[$j][9]), intval($boloes[$j][10]));
						array_push($this->boloesCriados, $b);
					}
				}

				$meusboloes = $dg->getData('boloes_' . $cpf);
				for ($j = 0; $j<count($meusboloes); $j++){
					for ($k = 0; $k<count($boloes); $k++){
						if ($meusboloes[$j][1]==$boloes[$k][0]){
							$jogos = array();
							$jogosBolao = $dg->getData('jogos_' . $boloes[$k][0]);
							for ($l = 0; $l<count($jogosBolao); $l++){
								$placar = new Placar($jogosBolao[$l][5], $jogosBolao[$l][6]);
								$jg = new Jogo($jogosBolao[$l][0], $jogosBolao[$l][1], $jogosBolao[$l][2], $jogosBolao[$l][3], $jogosBolao[$l][4], $placar, intval($jogosBolao[$l][7]));
								array_push($jogos, $jg); 
							}
							$b = new Bolao($boloes[$k][0], $boloes[$k][2], $boloes[$k][3], $boloes[$k][4], $jogos,$boloes[$k][1], explode(',', $boloes[$k][5]), explode(',', $boloes[$k][6]), intval($boloes[$k][7]), intval($boloes[$k][8]), intval($boloes[$k][9]), intval($boloes[$k][10]));
							break;
						}
					}
					if ($meusboloes[$j][0]=="ativo"){
						array_push($this->boloesParticipa, $b);
					} else {
						array_push($this->boloesEncerrados, $b);
					}
				}

				$matrizApostas = $dg->getData('apostas_' . $this->cpf);
				for ($j = 0; $j<count($matrizApostas); $j++){
					$placar = new Placar($matrizApostas[$j][1], $matrizApostas[$j][2]);
					$a = new Aposta($placar, $matrizApostas[$j][0]);
					array_push($this->apostas, $a);
				}

				$notificacoes = $dg->getData('notificacoes_' . $this->cpf);
				for ($j = 0; $j<count($notificacoes); $j++){
					for ($k = 0; $k<count($users); $k++){
						if ($users[$k][0]==$notificacoes[$j][1]){
							$remetente = new Apostador($users[$k][6], $users[$k][0], $users[$k][2], '', array(), array(), array(), 0, array(), array(), array());
							break;
						}
					}
					for ($k = 0; $k<count($boloes); $k++){
						if ($boloes[$k][0]==$notificacoes[$j][2]){
							$bolao = new Bolao($boloes[$k][0], $boloes[$k][2], $boloes[$k][3], $boloes[$k][4], array(),$boloes[$k][1], explode(',', $boloes[$k][5]), explode(',', $boloes[$k][6]), intval($boloes[$k][7]), intval($boloes[$k][8]), intval($boloes[$k][9]), intval($boloes[$k][10]));
							break;
						}
					}
					if (intval($notificacoes[$j][0])==1){
						$c = new Convite($remetente, $bolao);
						array_push($this->convites, $c);
					} else {
						$s = new Solicitacao($remetente, $bolao);
						array_push($this->solicitacoes, $s);
					}
				}

				session_start();
				$_SESSION["globalUser"] = $this;
				return true;
			}
		}
		return false;
	}


	/**
	*Instancia e registra um novo bolao, do qual o Apostador que chama a funcao sera administrador
	*/
	function criarBolao($bolao, $dataFinalizacao) {
		$dg = DataGetter::getInstance();
		$novoBolao = $bolao->id . ';' . $this->cpf . ';' . $bolao->nome . ';' . $bolao->campeonato . ';' . $bolao->esporte . ';' . $dataFinalizacao . ';'; 
		for ($i = 0; $i<count($bolao->apostadores); $i++){
			$novoBolao = $novoBolao . $bolao->apostadores[$i] . ',';
		}
		$novoBolao = $novoBolao . ';';
		for ($i = 0; $i<count($bolao->pontApostador); $i++){
			$novoBolao = $novoBolao . $bolao->$pontApostador[$i] . ',';
		}
		$novoBolao = $novoBolao . ';';
		$novoBolao = $novoBolao . $bolao->ptsAcertarPlacar . ';' . $bolao->ptsAcertarVencedor . ';' . $bolao->premio . ';' . $bolao->ativo . ';';

		$bolaouser = 'ativo;' . $bolao->id . ';';
		// escreve bolao no arquivo bolao
		$dg->appendData('bolao', $novoBolao);
		// escerve bolaouser no arquivo boloes_cpfuser
		$dg->appendData('boloes_' . $this->cpf, $bolaouser);
		$dg->setData('jogos_' . $bolao->id, array()); //cria arquivo de jogos
	}


	/**
	*Registra uma aposta, dado o placar de palpite e o jogo ao qual a aposta se refere
	*/
	function criarAposta($placar, $jogo) {
		$dg = DataGetter::getInstance();
		$aposta = $jogo->id . ';' . $placar->pontosTime1 . ';' . $placar->pontosTime2 . ';';
		// escreve no arquivo apostas_cpfuser
		$dg->appendData('apostas_' . $this->cpf, $aposta);
		//desconta saldo
		$this->saldo -= $jogo->valorAposta;
		for($i=0; $i<count($this->boloesParticipa); $i++){
			$bolao = $this->boloesParticipa;
			if($bolao->id == $_SESSION['idBolaoEscolhido']){
				$bolao->premio += $jogo->valorAposta;
				break;
			}
		}
		$boloes = $dg->getData('bolao');
		for($i=0; $i<count($boloes); $i++){
			if($boloes[$i][0] == $bolao->id){
				$boloes[$i][9] = $bolao->premio;
				$dg->setData('bolao', $boloes);
				break;
			}
		}
		$users = $dg->getData('usuarios');
		for($i=0; $i<count($users); $i++){
			if($users[$i][0] == $this->cpf){
				$users[$i][4] = $this->saldo;
			}
		}
		$dg->setData('usuarios', $users);
	}


	/**
	*Edita uma aposta ja existente - caso ainda essa aposta ainda esteja editavel - dada qual aposta se deseja editar e com qual placar a aposta deve ser atualizada
	*/
	function editarAposta($jogo, $novoPlacar) {
		$dg = DataGetter::getInstance();
		$apostas = $dg->getData('apostas_' . $this->cpf);
		for($j=0; $j<count($apostas); $j++){
			if($apostas[$j][0] == $jogo->id){
				$apostas[$j][1] = $novoPlacar->pontosTime1;
				$apostas[$j][2] = $novoPlacar->pontosTime2;				
				break;
			}
		}
		$dg->setData('apostas_' . $this->cpf, $apostas);
	}


	/**
	*Registra convites a outros Apostadores para um bolao do qual eh administrador, dados os apostadores que se deseja convidar e o bolao que eles devem aceitar ou nao participar
	*/
	function convidarApostadores($apostadores, $bolao) {
		$dg = DataGetter::getInstance();
		for($i=0; $i<count($apostadores); $i++){
			$convite = '1;' . $this->cpf . ';' . $bolao->id . ';';
			// escreve no arquivo convites_cpfuser
			for ($i = 0; $i<count($apostadores); $i++){
				$dg->appendData('notificacoes_' . $apostadores[$i], $convite);
			}
		}
	}


	/**
	*Registra o Apostador que chama essa funcao como participante de um novo bolao, caso a resposta ao convite para esse bolao seja true. Exclui registros desse convite
	*/
	function responderConviteBolao($convite, $resposta) {
		$bol = $convite->bolao;
		$idBolao = $bol->id;
		$dg = DataGetter::getInstance();
		$notificacoes = $dg->getData('notificacoes_' . $this->cpf);
		$novasNot = array();
		for ($i = 0; $i<count($notificacoes); $i++){
			if ($notificacoes[$i][2]!=$idBolao){
				array_push($novasNot, $notificacoes[$i]);
			}
		}
		$remetente - $convite->usuarioRemetente;
		if($resposta == true){
			// procurar bolao do convite que recebeu como parametro no arquivo de boloes
			$boloes = $dg->getData('bolao');
			for ($i = 0; $i<count($boloes); $i++){
				if (intval($boloes[$i][0])==$idBolao){
					$apostadores = explode(',', $boloes[$i][5]);
					$pontuacoes = explode(',', $boloes[$i][6]);
					array_push($pontuacoes, '0');
					array_push($apostadores, $remetente->cpf);
					$boloes[$i][5] = implode(',', $apostadores);
					$boloes[$i][6] = implode(',', $pontuacoes);
					break;
				}
			}
			$dg->setData('bolao', $boloes);

			$dg->appendData('boloes_' . $this->cpf, 'ativo;' . $idBolao . ';'); //adiciona a boloes que participa
		}
		$dg->setData('notificacoes_' . $this->cpf, $novasNot);
	}


	/**
	*Registra uma solicitacao ao Apostador administrador para participar de um dado bolao.
	*/
	function solicitarParticiparBolao($bolao) {
		$dg = DataGetter::getInstance();
		$solicitacao = '2;' . $this->cpf . ';' . $bolao->id . ';';
		// escrever no arquivo solicitacoes_cpfuser do administrador do bolao
		$dg->appendData('notificacoes_' . $bolao->cpfAdmin, $solicitacao);
		$dg->appendData('solicitacoesfeitas_' . $this->cpf, $bolao->id . ';');
	}


	/**
	*Registra o Apostador criador de uma dada solicitacao como participante de um bolao cujo Apostador que chama essa funcao eh administrador, caso a resposta para essa solicitacao seja true. Exclui registros dessa solicitacao
	*/
	function responderSolicitacao($solicitacao, $resposta) {
		$bol = $solicitacao->bolao;
		$idBolao = $bol->id;
		$dg = DataGetter::getInstance();
		$notificacoes = $dg->getData('notificacoes_' . $this->cpf);
		$novasNot = array();
		for ($i = 0; $i<count($notificacoes); $i++){
			if (intval($notificacoes[$i][2])!=$idBolao){
				array_push($novasNot, $notificacoes[$i]);
			}
		}
		$remetente = $solicitacao->usuarioRemetente;
		$solicitacoesF = $dg->getData('solicitacoesfeitas_' . $remetente->cpf);
		$novasSoli = array();
		for ($i = 0; $i<count($solicitacoesF); $i++){
			if (intval($solicitacoesF[$i][0])!=$idBolao){
				array_push($novasSoli, $solicitacoesF[$i]);
			}
		}
		
		if($resposta == true){
			// procurar bolao da solicitacao que recebeu como parametro no arquivo de boloes
			$boloes = $dg->getData('bolao');
			for ($i = 0; $i<count($boloes); $i++){
				if (intval($boloes[$i][0])==$idBolao){
					$apostadores = explode(',', $boloes[$i][5]);
					$pontuacoes = explode(',', $boloes[$i][6]);
					array_push($pontuacoes, '0');
					array_push($apostadores, $remetente->cpf);
					$boloes[$i][5] = implode(',', $apostadores);
					$boloes[$i][6] = implode(',', $pontuacoes);
					break;
				}
			}
			$dg->setData('bolao', $boloes);
			$u = $solicitacao->usuarioRemetente;
			$dg->appendData('boloes_' . $u->cpf, 'ativo;' . $idBolao . ';'); //adiciona a boloes que participa
		}
		$dg->setData('notificacoes_' . $this->cpf, $novasNot);
		$dg->setData('solicitacoesfeitas_' . $remetente->cpf, $novasSoli);
	}



	/**
	*Exclui um Apostador especifico da lista de Apostadores de um dado bolao cujo Apostador que chama essa funcao eh administrador. Exclui registros desse bolao da lista de boloes que o Apostador excluido participa
	*/
	function excluirApostadorBolao($idBolao, $cpfApostador) {
		$dg = DataGetter::getInstance();
		// resgata cpfs dos apostadores arquivo do bolao
		$boloes = $dg->getData('bolao');
		for ($j = 0; $j<count($boloes); $j++){
			if ($idBolao==$boloes[$j][0]){
				$cpfs_apostadores = $boloes[$j][5]; // string com tds os cpfs do bolao
				$cpf = '';
				$novo_cpfs_apostadores = '';
				for($i=0; $i<count($cpfs_apostadores); $i++){
					if($cpfs_apostadores[$i] != ','){
						$cpf = $cpf . $cpfs_apostadores[$i];
					}
					else if($cpfs_apostadores[$i] == ','){ // achou virgula significa que um novo cpf esta por vir e n achamos o que procuramos ainda
						if($cpf != $cpfApostador){
							$novo_cpfs_apostadores = $novo_cpfs_apostadores . $cpf . ',';
						}
						$cpf = ''; // zera o cpf atual
					}
				}
				$boloes[$j][5] = $novo_cpfs_apostadores;
				// substitui cpfs_apostadores no arquivo do bolao por novo_cpfs_apostadores
				$dg->setData('bolao', $boloes);
				break;
			}
		}

		//resgata boloes que o usuario excluido participa
		$boloesuser = $dg->getData('boloes_' . $cpfApostador);
		$novosboloes = array();
		for ($i = 0; $i<count($boloesuser); $i++){
			if (intval($boloesuser[$i][1])!=$idBolao){
				array_push($novosboloes, $boloesuser[$i]);
			}
		}
		$dg->setData('boloes_' . $cpfApostador, $novosboloes);
	}


	/**
	*Instancia e registra um novo jogo referente a um dado bolao do qual o Apostador que chama essa funcao eh administrador
	*/
	function cadastrarJogo($id, $idBolao, $jogo) {
		$dg = DataGetter::getInstance();
		$novoJogo = $id . ';' . $jogo->data . ';' . $jogo->limiteEdicaoAposta . ';' . $jogo->time1 . ';' . $jogo->time2 . ';-;-;' . $jogo->valorAposta . ';';
		$dg->appendData('jogos_' . $idBolao, $novoJogo);
	}


	/**
	*Registra o resultado de um jogo dado, pertencente a um bolao especifico do qual o Apostador que chama essa funcao eh administrador
	*/
	function cadastrarResultados($placar, $jogo, $idBolao) {
		$dg = DataGetter::getInstance();
		$jogo->resultado = $placar;
		$jogos = $dg->getData('jogos_' . $idBolao);
		for ($i = 0; $i<count($jogos); $i++){
			if (intval($jogos[$i][0])==$jogo->id){
				$p = $jogo->resultado;
				$jogoVetor = array();
				array_push($jogoVetor, $jogo->id);
				array_push($jogoVetor, $jogo->data);
				array_push($jogoVetor, $jogo->limiteEdicaoAposta);
				array_push($jogoVetor, $jogo->time1);
				array_push($jogoVetor, $jogo->time2);
				array_push($jogoVetor, $p->pontosTime1);
				array_push($jogoVetor, $p->pontosTime2);
				array_push($jogoVetor, $jogo->valorAposta);
				array_push($jogoVetor, ';');
				$jogos[$i] = $jogoVetor;
				break;
			}
		}
		// escreve no arquivo jogos_idBolao
		$dg->setData('jogos_' . $idBolao, $jogos);
	}

	/**
	*Retorna todas as apostas ja feitas pelo Apostador que chama essa funcao
	*/
	function verificarHistoricoApostas() {
		$dg = DataGetter::getInstance();
		return $dg->getData('apostas_' . $this->cpf);
	}
}

/*let a = new Apostador("cpfuser", "nome", "senha", "boloesCriados", "boloesParticipa", "boloesEncerrados", "saldo", "apostas", "convites", "solicitacoes");
let c = new Convite("eu mesmo", 1);
a.responderConviteBolao(c, true);*/
?>