<!doctype html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
	<title>Bolão</title>
	<link rel="stylesheet" type="text/css" href="./estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>

<body style = "background-image: url('stadium2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: 0% 30%;">
<?php
    	require_once "./TelaUsuario.php";
		require_once "./ControllerExibeBolao.php";

		$telaExibeBolao = new ControllerExibeBolao();

		if(isset($_POST['sair'])){
			$telaExibeBolao->sair();
            header('Location: ./index.php');
		}
		
		if(isset($_POST['responderNotificacoes'])){
			$user = $_SESSION['globalUser'];
			$novas = array();
			for ($i=0; $i<count($user->solicitacoes); $i++){
				$s = $user->solicitacoes[$i];
				$b = $s->bolao;
				$idBolao = $b->id;
				if ($_POST['notf'.$idBolao]==1){
					$telaExibeBolao->aceitarNotificacao($s);
				} else if($_POST['notf'.$idBolao]==2){
					$telaExibeBolao->recusarNotificacao($s);
				} else {
					array_push($novas, $s);
				}
			}
			$user->solicitacoes = $novas;

			$novas = array();
			for ($i=0; $i<count($user->convites); $i++){
				$c = $user->convites[$i];
				$b = $c->bolao;
				$idBolao = $b->id;
				if ($_POST['notf'.$idBolao]==1){
					$telaExibeBolao->aceitarNotificacao($c);
				} else if($_POST['notf'.$idBolao]==2){
					$telaExibeBolao->recusarNotificacao($c);
				} else {
					array_push($novas, $c);
				}
			}
			$user->convites = $novas;

			$_SESSION['globalUser'] = $user;
			header('Location: ./telaBolao.php');

		}    	

    	$tela = new TelaUsuario();
    	echo $tela->exibirNavBar('telaBolao');


		if(isset($_POST['convidarApostadores'])){
			$dg = DataGetter::getInstance();
			$usuarios = $dg->getData('usuarios');
			$convidados = array();
			for ($i = 0; $i<count($usuarios); $i++){
				if ($usuarios[$i][0]!=$_SESSION['bolaoGlobal']->cpfAdmin && array_search($usuarios[$i][0], $_SESSION['bolaoGlobal']->apostadores)==false){
					if ($_POST['conv'.$usuarios[$i][0]]==1){
						array_push($convidados, $usuarios[$i][0]);
					}
				}
			}
			$telaExibeBolao->enviarConvite($convidados);
			header('Location: ./telaBolao.php');
		}
		$apostou = false;
		for($i=0; $i<count($_SESSION['jogosBolao']); $i++){
			if(isset($_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id]) && isset($_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id])){
				if($_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id]!= '' && $_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id] != '' && $_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id]!= '-' && $_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id] != '-'){
					if($_SESSION['operacao'.$_SESSION['jogosBolao'][$i]->id] == "cadastrando aposta"){
						$telaExibeBolao->confirmarAposta($_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id], $_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id], $_SESSION['jogosBolao'][$i]);
					}
					else if($_SESSION['operacao'.$_SESSION['jogosBolao'][$i]->id] == "editando aposta"){
						$telaExibeBolao->confirmarEdicaoAposta($_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id], $_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id], $_SESSION['jogosBolao'][$i]);
					}
					else{
						$telaExibeBolao->confirmarResultado($_POST['ptTime1' . $_SESSION['jogosBolao'][$i]->id], $_POST['ptTime2' . $_SESSION['jogosBolao'][$i]->id], $_SESSION['jogosBolao'][$i], $_SESSION['idBolaoEscolhido']);					
					}
					$apostou = true;
				}
			}
		}
		if($apostou == true){
			header('Location: ./telaBolao.php');
		}
		if (isset($_POST['excluido'])){
			$telaExibeBolao->confirmarExclusao($_POST['excluido']);
		}

		if(isset($_POST['mudarBotao'])){
			if (!isset($_SESSION['placarExibir']) || $_SESSION['placarExibir']=="resultado"){
				$_SESSION['placarExibir'] = "aposta";
			} else {
				$_SESSION['placarExibir'] = "resultado";
			}
		}
		
?>
	<div class="container mt-5">
		<div class="row mt-5 ml-2">
			<div class="col-8 offset-1 mt-5">
				<div class="resultados shadow">
					<div class = "row">
						<?php
							require_once "./ControllerExibeBolao.php";

							$infosBolao = new ControllerExibeBolao();
							echo $infosBolao->exibirInfosBolao();
							echo $infosBolao->exibirJogosBolao();
						?>
							</div>
						</li>
					</ul>
					<div class = "row">
						<div class = "text-left col-3">
								<button type = "submit" id = "confirmar" class="mt-2 btn btn-success" style = "display: none;">Confirmar</button>
						</div>
					</form>
						<div class = "text-right offset-7 col-2">
							<?php
								if($_SESSION['ehAdm'] == true && $_SESSION['bolaoGlobal']->ativo == 1){
								echo '<form style="text-align: left;" action="./telaNewGame.php">
										<button class="mt-2 btn btn-info" id = "criarJogo" style="padding-right: 5px;">Criar Jogo</button>
									</form>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				require_once "./ControllerExibeBolao.php";

				$apostadoresBolao = new ControllerExibeBolao();
				echo $apostadoresBolao->exibirApostadoresBolao();
			?>

		</div>
	</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 	    

	    <script type = "text/javascript">
	    	function permiteEditarResultado(idJogo){
	    		document.getElementById('confirmar').style.display = "block"; 
	    		if(document.getElementById('criarJogo') != null){
	    			document.getElementById('criarJogo').style.display = "none"; 
	    		}
	    		if(document.getElementById('ptTime1' + String(idJogo)).value == '-' && document.getElementById('ptTime2' + String(idJogo)).value == '-'){
		    		document.getElementById('ptTime1' + String(idJogo)).value = '';
		    		document.getElementById('ptTime2' + String(idJogo)).value = '';
		    	}
		    	let id1 = "#ptTime1" + String(idJogo);
    			$(id1).mask("00000");		  
		    	let id2 = "#ptTime2" + String(idJogo);
    			$(id2).mask("00000");    			  	
	    		document.getElementById('ptTime1' + String(idJogo)).disabled = false;
	    		document.getElementById('ptTime2' + String(idJogo)).disabled = false;
	    	}
	    	function guardarConvidado(id){
	    		if(document.getElementById('conv'+id).value==0){
					document.getElementById('conv'+id).value = 1;
					document.getElementById('btn-convidar').disabled = false;
					document.getElementById('li-'+id).classList.remove('bg-light');
					document.getElementById('btn-conv-'+id).classList.remove('bg-light');
					document.getElementById('btn-conv-'+id).style.backgroundColor = "transparent";
					document.getElementById('li-'+id).classList.add('list-group-item-success');
				} else {
					document.getElementById('conv'+id).value = 0;
					document.getElementById('li-'+id).classList.remove('list-group-item-success');
					document.getElementById('btn-conv-'+id).classList.add('bg-light');
					document.getElementById('li-'+id).classList.add('bg-light');
				}
			}
			function exibirModalExcluir(userExcluido, cpfExcluido){
				document.getElementById('nomeExcluido').innerHTML = userExcluido;
				document.getElementById('excluido').value = cpfExcluido;
			}
	    </script>
</body>
</html>