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
		require_once "./ControllerCriaJogo.php";

		session_start();
    	$tela = new TelaUsuario();
    	echo $tela->exibirNavBar('telaNewGame');

		$telaJogo = new ControllerCriaJogo();
		if(isset($_POST['dataJogo']) && isset($_POST['dataLimite']) && isset($_POST['time1']) && isset($_POST['time2']) && isset($_POST['aposta'])){
			if($_POST['dataJogo'] != '' && $_POST['dataLimite'] != '' && $_POST['time1'] != '' && $_POST['time2'] != '' && $_POST['aposta'] != ''){
				$dataJogo = $_POST['dataJogo'];
				$dataLimite = $_POST['dataLimite'];
				$time1 = $_POST['time1'];
				$time2 = $_POST['time2'];
				$aposta = $_POST['aposta'];
				$telaJogo->confirmarCriacaoJogo($dataJogo, $dataLimite, $time1, $time2, $aposta);
				header('Location: ./telaBolao.php');
			}
			else{
				$_SESSION['message'] = "Insira todas as informações do jogo.";
			}
		}

		else if(isset($_POST['sair'])){
			$telaJogo->sair();
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
    <div class = "mt-5 container" style = "max-height: 150em; max-width: 900px; background: none; position: relative; padding-top: 20px;">
		<div class="resultados shadow">
			<?php
				if(isset($_SESSION['message'])){
					echo '<div class = "container-fluid" style = "background-color: none;"> <div class = "text-center alert alert-danger" > <strong> ' . $_SESSION['message'] . '</strong> </div> </div>';
					unset($_SESSION['message']);
				}
			?>
			<?php 
				echo '<a href = "./telaBolao.php" style = "text-decoration: none;"><h5 class = "text-left">' . $_SESSION['nomeBolao'] . '</h5></a>';
			?>
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
	                    <br>
						<label for="dataLimite">Data Limite para Editar Aposta: </label>
	                    <div class='rightTab'>
	                        <input type="text" name = "dataLimite" id="dataLimite">
	                    </div>                                        
	                </div>
	                <button type="submit" class="btn btn-primary">Cadastrar Jogo</button>
	            </form>
	        </div>
		</div>
	</div>
	<script type="text/javascript" src="./TelaUsuario.js"></script>
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	<script type = "text/javascript">
    	$("#dataJogo, #dataLimite").mask("00/00/0000");		
    	$("#aposta").mask("00000");
	</script>
</body>

</html>