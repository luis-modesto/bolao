<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
		<title>Bolão</title>

		<link rel="stylesheet" type="text/css" href="./estilo.css">

		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet"> 
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
	</head>

	<body style="background-color: #f0f0f0;">
	    <div class = "container" style = "background-color: #f0f0f0;">
	        <header>
	            <?php
					require_once "./Apostador.php";
					require_once "./Administrador.php";
	            	session_start();
	            	$user = $_SESSION["globalUser"];
	            	echo '<br>' . $user->nome;
	            ?>
	        </header>
	        <div class = "row">
	        	<div class="col-1 offset-11">
		        	<form style="text-align: right;"  method = "post" action="./telaHomepage.php">
		        		<input value = "1" type = "hidden" name = "sair" id = "sair"> 
		            	<button type="submit" class = "btn"> Sair </button>
		            </form>
		        </div>
	        </div>
			<h1 class='main-title'><a id = "cabecalho" href = "./telaHomepage.php"> Bolão</a></h1>
			<div class='new-game'>
					<form style="text-align: center;" action="./telaNewBolao.php">
						<button class = "btn btn-info"> Criar novo bolão</button>
					</form>
				<button id="btn-meus-boloes"  class = "ml-3 btn btn-info" onclick = "exibirMeusBoloes()"> Meus bolões</button>
			</div>
			<div class="row mt-3">
				<div class="col-8 offset-2">
					<div class="resultados shadow">
						<h5 id="titulo-lista-boloes" class="text-center">Bolões</h5>
						<ul id="lista-boloes" class="list-group">
							<?php
								require_once "ControllerHomepage.php";

								$home = new ControllerHomepage();
								echo $home->exibirBoloes();
							?>

						</ul>
						<div class="row">
							<div class="col-3">
								<form style ="text-align: left;" method = "post" action = "telaHomepage.php">
									<input type = "hidden" name = "bolaoEscolhido" id = "bolaoEscolhido"> 
									<button disabled type = "submit" class = "btn btn-success" id = "exibir"> Exibir Bolão </button>
								</form>
							</div>
							<div class="col-2 offset-7">
								<form method = "post" action="telaHomepage.php">
									<input type = "hidden" name = "bolaoParticipar" id = "bolaoParticipar"> 
									<button disabled type="submit" class="btn btn-success" id = "participar">Participar</button>
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
		</script>
		<?php
		require_once "ControllerHomepage.php";
		session_start();
		$homepage = new ControllerHomepage();

		if(isset($_POST['bolaoEscolhido'])){
			$_SESSION['idBolaoEscolhido'] = $_POST['bolaoEscolhido'];
			unset($_POST['bolaoEscolhido']);
			$idbolao = $_SESSION['idBolaoEscolhido'];
			echo $idbolao;
		}
		else if(isset($_POST['bolaoParticipar'])){
			$_SESSION['idBolaoEscolhido'] = $_POST['bolaoParticipar'];
			unset($_POST['bolaoParticipar']);
			$idbolao = $_SESSION['idBolaoEscolhido'];
			$homepage->solicitarParticiparBolao($idbolao);
			header('Location: ./telaHomepage.php');
		}
		else if(isset($_POST['sair'])){
			unset($_POST['sair']);
			$homepage->sair();
		}
		?>		
	</body>

</html>
