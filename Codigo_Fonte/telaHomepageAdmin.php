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
			$homepageAdmin = new ControllerHomepage();

			if(isset($_POST['sair'])){
				$homepageAdmin->sair();
				header('Location: ./index.php');
			}

			if(isset($_POST['bolaoEscolhido'])){
				$_SESSION['idBolaoEscolhido'] = $_POST['bolaoEscolhido'];
				$idbolao = $_SESSION['idBolaoEscolhido'];
				header('Location: ./telaBolao.php');
			}
			if(isset($_POST['bolaoExcluido'])){
				$homepageAdmin->confirmarExclusaoBolao($_POST['bolaoExcluido']);
			}


			if (isset($_POST['userExcluido'])){
				$homepageAdmin->confirmarExclusaoUsuario($_POST['userExcluido']);
			}

	    	$tela = new TelaUsuario();
	    	echo $tela->exibirNavBar('telaHomepageAdmin');
?>
	    
	    <div class = "container" style = "max-width: 900px;  position: relative; bottom: -50px;">
			<div class='new-game'>
				<button id="btn-boloes" class = "mt-5 btn btn-info" onclick = "exibirBoloes()"> Bolões</button>
				<button id="btn-usuarios" class = "ml-3 mt-5 btn btn-info" onclick = "exibirUsuarios()"> Usuários</button>
			</div>
			<div class="row mt-3">
				<div class="mb-5 col-8 offset-2">
					<div class="resultados shadow">
						<h5 id="titulo-lista" class="text-center">Bolões</h5>
						<div id="lista-boloes" class="border border-dark rounded">
							<ul class="list-group">
								<?php
									require_once "./ControllerHomepage.php";
									$home = new ControllerHomepage();
									echo $home->exibirBoloes();
								?>
							</ul>
						</div>
						<div style="display: none;" id="lista-usuarios" class="border border-dark rounded">
							<ul class="list-group">
								<?php
									require_once "./ControllerHomepage.php";
									$home = new ControllerHomepage();
									echo $home->exibirUsuarios();
								?>
						</div>						
						<div class="row mt-2">
							<div class="col-3">
								<form style ="text-align: left;" method = "post" action = "./telaHomepage.php">
									<input type = "hidden" value = "-1" name = "bolaoEscolhido" id = "bolaoEscolhido"> 
									<button disabled type = "submit" class = "btn btn-success" id = "exibir"> Exibir Bolão </button>
								</form>
							</div>
							<div class="col-3 offset-6">
								<input type = "hidden" value = "-1" name = "bolaoExcluir" id = "bolaoExcluir"> 
								<button disabled onclick="exibirModalExcluirBolao()" data-toggle="modal" data-target="#modalExcluirBolao" type = "button" class = "btn btn-danger" id = "excluir"> Excluir Bolão </button>
								<div id="modalExcluirBolao" class="modal fade" role="dialog">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-body">
												Tem certeza que deseja excluir o bolão?
											</div>
											<div class="modal-footer">
												<form method="post" action="./telaHomepageAdmin.php">
						        				<input type = "hidden" value = ""  name = "bolaoExcluido" id = "bolaoExcluido"> 
						        				<button type="submit" class="btn btn-danger">Excluir</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type = "text/javascript">

			let bolaoAnterior;

			function pegarIdBolao(idEscolhido, ativo){
				document.getElementById('exibir').disabled = false;
				document.getElementById('excluir').disabled = false;
				document.getElementById(String(idEscolhido)).style.backgroundColor = "#00FA9A";
				if(document.getElementById('bolaoEscolhido').value != -1 && document.getElementById('bolaoEscolhido').value != idEscolhido){
					if(bolaoAnterior == 'ativo'){
						document.getElementById(String(document.getElementById('bolaoEscolhido').value)).style.backgroundColor = "white";
					}
					else{
						document.getElementById(String(document.getElementById('bolaoEscolhido').value)).style.backgroundColor = "initial";						
					}
				}
				if(ativo == 0){
					bolaoAnterior = 'inativo';
				}
				else{
					bolaoAnterior = 'ativo';
				}
				document.getElementById('bolaoEscolhido').value = idEscolhido;
				document.getElementById('bolaoExcluir').value = idEscolhido; 
			}

			function exibirUsuarios(){
				document.getElementById('btn-usuarios').disabled = true;
				document.getElementById('btn-boloes').disabled = false;				
				document.getElementById('exibir').style.display = "none";
				document.getElementById('titulo-lista').innerHTML = "Usuarios";
				document.getElementById('lista-boloes').style.display = "none";
				document.getElementById('lista-usuarios').style.display = "block";				
				document.getElementById('exibir').disabled = true;
			}
			function exibirBoloes(){
				document.getElementById('btn-usuarios').disabled = false;
				document.getElementById('btn-boloes').disabled = true;								
				document.getElementById('exibir').style.display = "block";
				document.getElementById('titulo-lista').innerHTML = "Bolões";
				document.getElementById('lista-usuarios').style.display = "none";
				document.getElementById('lista-boloes').style.display = "block";				
				document.getElementById('exibir').disabled = true;				
			}
		</script>
		<script type="text/javascript" src="./TelaUsuario.js"></script>
		 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	    <script type = "text/javascript">
			function exibirModalExcluir(userExcluido, cpfExcluido){
				document.getElementById('nomeExcluido').innerHTML = userExcluido;
				document.getElementById('userExcluido').value = cpfExcluido;
			}
			function exibirModalExcluirBolao(){
				document.getElementById('bolaoExcluido').value = document.getElementById('bolaoExcluir').value;
			}	    	
	    </script>
	</body>

</html>