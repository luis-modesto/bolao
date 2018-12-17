<!doctype html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
	<title>Bolão</title>

	<link rel="stylesheet" type="text/css" href="./estilo.css">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
</head>

<body style = "background-image: url('stadium2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
<?php
    	require_once "./TelaUsuario.php";
		require_once "./ControllerCriaJogo.php";

    	$tela = new TelaUsuario();
    	echo $tela->exibirNavBar('telaNewGame');

		$telaJogo = new ControllerCriaJogo();
		if(isset($_POST['dataJogo']) && isset($_POST['dataLimite']) && isset($_POST['time1']) && isset($_POST['time2']) && isset($_POST['aposta'])){

			$dataJogo = $_POST['dataJogo'];
			$dataLimite = $_POST['dataLimite'];
			$time1 = $_POST['time1'];
			$time2 = $_POST['time2'];
			$aposta = $_POST['aposta'];
			$telaJogo->confirmarCriacaoJogo($dataJogo, $dataLimite, $time1, $time2, $aposta);
			header('Location: ./telaBolao.html');
		}

		else if(isset($_POST['sair'])){
			$telaExibeBolao->sair();
            header('Location: ./index.php');
		}
		if(isset($_POST['responderNotificacoes'])){
				$user = $_SESSION['globalUser'];
				for ($i=0; $i<count($user->solicitacoes); $i++){
					$s = $user->solicitacoes[$i];
					$b = $s->bolao;
					$idBolao = $b->id;
					if ($_POST['notf'.$idBolao]==1){
						$homepage->aceitarNotificacao($s);
					} else if($_POST['notf'.$idBolao]==2){
						$homepage->recusarNotificacao($s);
					}
				}
				for ($i=0; $i<count($user->convites); $i++){
					$c = $user->convites[$i];
					$b = $c->bolao;
					$idBolao = $b->id;
					if ($_POST['notf'.$idBolao]==1){
						$homepage->aceitarNotificacao($c);
					} else if($_POST['notf'.$idBolao]==2){
						$homepage->recusarNotificacao($c);
					}
				}
				header('Location: ./telaHomepage.php');

			}
?>
	<div class="container" style="background-color: #f0f0f0;">
		<div class="row">
        <div class="col-1 offset-11">
            <form style="text-align: right;"  method = "post" action="./telaNewGame.php">
                <input value = "1" type = "hidden" name = "sair" id = "sair"> 
                <button type="submit" class = "btn"> Sair </button>
            </form>
        </div>
		</div>
		<div class='new-game'>
			<form style="text-align: center;" action="./telaNewBolao.php">
				<button class="btn btn-info"> Criar novo bolão</button class="btn btn-info">
			</form>
			<button class="ml-3 btn btn-info"> Meus bolões</button class="btn btn-info">
		</div>
		<div class="row mt-3">
			<div class="col-8 offset-2">
				<div class="resultados shadow">
					<h6 class="text-center">Novo Jogo</h6>
                        <div class="container-fluid">
                                <form class="ml-auto" style="text-align: center;" method = "post" action="telaNewGame.php">
                                    <div class="form-group">
                                        <label for="timea"> Time A:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "time1" id="time1">
                                        </div>
                                        <br>
                                        <label for="timeb"> Time B:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "time2" id="time2">
                                        </div>
                                        <br>
                                        <label for="aposta">Valor da Aposta: </label>
                                        <div class='rightTab'>
                                            <input type="text" name = "aposta" id="aposta">
										</div>
										<br>
										<label for="dataJogo">Data do Jogo: </label>
                                        <div class='rightTab'>
                                            <input type="text" name = "dataJogo" id="dataJogo">
                                        </div>
										<label for="dataLimite">Data Limite para Editar Aposta: </label>
                                        <div class='rightTab'>
                                            <input type="text" name = "dataLimite" id="dataLimite">
                                        </div>                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary">Criar Jogo</button>
                                </form>
				</div>
			</div>
		</div>
	</div>
		<script type="text/javascript" src="./TelaUsuario.js"></script>
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>