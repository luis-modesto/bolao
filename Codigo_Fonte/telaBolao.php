<!doctype html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
	<title>Bolão</title>

	<link rel="stylesheet" type="text/css" href="./estilo.css">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body style = "background-image: url('stadium2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
	<?php
    	require_once "./TelaUsuario.php";

    	$tela = new TelaUsuario();
    	echo $tela->exibirNavBar();
    ?>
	<div class="container" style="background-color: #f0f0f0;">
		<div class="row mt-5">
			<div class="col-8 offset-2">
				<div class="resultados shadow">
					<h6 class="text-center">Bolão 1</h6>
					<form style="text-align: center;" action="./telaNewGame.php">
						<button class="btn btn-info">Criar jogo</button>
					</form>
					<ul class="list-group">
						<?php
							require_once "./ControllerExibeBolao.php";

							$exibe = new ControllerExibeBolao();
							$exibe->exibirInfosBolao();
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php
		require_once "./ControllerExibeBolao.php";
		$telaExibeBolao = new ControllerExibeBolao();

		if(isset($_POST['sair'])){
			$telaExibeBolao->sair();
		}
	?>
</body>

</html>