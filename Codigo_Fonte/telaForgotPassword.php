<!doctype html>

<html>

<head>
	<meta charset="utf-8">
    <meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
	<title>Bolão</title>
	<link rel="stylesheet" type="text/css" href="./estilo.css">
</head>

<body style="background-color: #f0f0f0;">
	<h1><a id = "cabecalho" href = "./index.php"> Bolão </a></h1>
	<div class="container-fluid">
		<form class="ml-auto" style="text-align: center;" method = "post" action = "telaForgotPassword.php">
			<div class="form-group">
                <label for="cpf"> CPF:</label>
                <div class='rightTab'>
                    <input type="text" name = "cpf" id="cpf">
                </div>
                <br>
                <label for="Respota de segurança"> Resposta de Segurança:</label>
                <div class='rightTab'>
                    <input type="text" name = "resposta" id="respostaSeguranca">
                </div>
			</div>
			<button type="submit" class="btn btn-primary" >Recuperar senha</button>
		</form>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
	<?php
	require_once "Apostador.php";
	require_once "Administrador.php";
	require_once "ControllerRecupera.php";
	require_once "ControllerLogin.php";

	if(isset($_POST['cpf']) && isset($_POST['resposta'])){
		$cpf = $_POST['cpf'];
		if ($cpf=="06721598567"){
			$user = new Administrador($cpf, '', '');
		} else {
			$user = new Apostador($cpf, '', '', array(), array(), array(), 500, array(), array(), array());
		}
		$resposta = $_POST['resposta'];
		$telaSenha = new ControllerRecupera();
		unset($_POST['cpf']);
		unset($_POST['resposta']);
		if ($telaSenha->recuperaSenha($user, $resposta)){
			$telaLogin = new ControllerLogin();
			$telaLogin->login($user);
		}
	}
	?>	 
</body>

</html>