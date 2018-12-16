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
	    	require_once "./ControllerHomepage.php";

	    	$tela = new TelaUsuario();
	    	echo $tela->exibirNavBar('telaHomepage');
			//session_start();
			$homepage = new ControllerHomepage();

			if(isset($_POST['bolaoEscolhido'])){
				$_SESSION['idBolaoEscolhido'] = $_POST['bolaoEscolhido'];
				$idbolao = $_SESSION['idBolaoEscolhido'];
				header('Location: ./telaBolao.php');
			}
			else if(isset($_POST['bolaoParticipar'])){
				$_SESSION['idBolaoEscolhido'] = $_POST['bolaoParticipar'];
				$idbolao = $_SESSION['idBolaoEscolhido'];
				$homepage->solicitarParticiparBolao($idbolao);
				header('Location: ./telaHomepage.php');
			}
			if(isset($_POST['sair'])){
				$homepage->sair();
				header('Location: ./index.php');
			}
			if(isset($_POST['responderNotificacoes'])){
				$user = $_SESSION['globalUser'];
				for ($i=0; $i<count($user->solicitacoes); $i++){
					$s = $user->solicitacoes[$i];
					$b = $s->bolao;
					$idBolao = $b->id;
					if ($_POST['sol'.$idBolao]==1){
						$homepage->aceitarNotificacao($s);
					} else if($_POST['sol'.$idBolao]==2){
						$homepage->recusarNotificacao($s);
					}
				}
				for ($i=0; $i<count($user->convites); $i++){
					$c = $user->convites[$i];
					$b = $c->bolao;
					$idBolao = $b->id;
					if ($_POST['conv'.$idBolao]==1){
						$homepage->aceitarNotificacao($c);
					} else if($_POST['conv'.$idBolao]==2){
						$homepage->recusarNotificacao($c);
					}
				}
			}
?>
	    
	    <div class = "mt-5 container" style = "max-width: 900px; background-color: #f0f0f0; position: relative; bottom: -50px;">
			<div class='mt-5 new-game'>
					<form style="text-align: center;" action="./telaNewBolao.php">
						<button class = "mt-3 btn btn-info"> Criar novo bolão</button>
					</form>
				<button id="btn-meus-boloes"  class = "ml-3 mt-3 btn btn-info" onclick = "exibirMeusBoloes()"> Meus bolões</button>
			</div>
			<div class="row mt-3">
				<div class="mb-5 col-8 offset-2">
					<div class="resultados shadow">
						<h5 id="titulo-lista-boloes" class="text-center">Bolões</h5>
						<ul id="lista-boloes" class="list-group">
							<?php
								require_once "./ControllerHomepage.php";
								$home = new ControllerHomepage();
								echo $home->exibirBoloes();
							?>
						</ul>
						<div class="row">
							<div class="col-3">
								<form style ="text-align: left;" method = "post" action = "./telaHomepage.php">
									<input type = "hidden" name = "bolaoEscolhido" id = "bolaoEscolhido"> 
									<button disabled type = "submit" class = "btn btn-success" id = "exibir"> Exibir Bolão </button>
								</form>
							</div>
							<div class="col-2 offset-7">
								<form method = "post" action="telaHomepage.php">
									<input type = "hidden" name = "bolaoParticipar" id = "bolaoParticipar"> 
									<button style="position: relative; right: 26px;"disabled type="submit" class="btn btn-success" id = "participar">Participar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type = "text/javascript">
			function pegarIdBolao(idEscolhido){
				document.getElementById('exibir').disabled = false;
				document.getElementById('participar').disabled = false;
				document.getElementById('bolaoEscolhido').value = idEscolhido; 
				document.getElementById('bolaoParticipar').value = idEscolhido; 
			}

			function exibirMeusBoloes(){
				document.getElementById('titulo-lista-boloes').innerHTML = "Meus Bolões";

			}

			function aceitarNotificacao(id){
				document.getElementById(id).value = 1;
			}

			function rejeitarNotificacao(id){
				document.getElementById(id).value = 2;
			}
		</script>
		 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>

</html>
