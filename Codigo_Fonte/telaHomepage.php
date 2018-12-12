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
	            	//session_start();
	            	//$user = $_SESSION["globalUser"];
	            	//echo $user->nome;
	            ?>
	        </header>
	        <div class = "row">
	            <a class = "ml-auto" href = "./index.php"> Sair </a>
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
						<h6 id="titulo-lista-boloes" class="text-center">Bolões</h6>
						<ul id="lista-boloes" class="list-group">
						
							<li class="list-group-item" onclick = "pegarIdBolao()">Bolão 1</li>
						</ul>
						<form style ="text-align: left;" method = "post" action = "ControllerExibeBolao.php">
							<input type = "hidden" name = "bolaoEscolhido" id = "bolaoEscolhido"	> 
							<button disabled type = "submit" class = "btn btn-success" id = "exibir"> Exibir Bolão </button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type = "text/javascript">
			function pegarIdBolao(idEscolhido){
				document.getElementById('exibir').disabled = false;
				document.getElementById('bolaoEscolhido').value = idEscolhido; 
			}

			function exibirMeusBoloes(){
				document.getElementById('titulo-lista-boloes').innerHTML = "Meus Bolões";

			}
		</script>
	</body>

</html>
