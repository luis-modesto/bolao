<!doctype html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=width-device, initial-scale=1.0, shrink-to-fit=no">
	<title>Bolão</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./estilo.css">
</head>

<body style="background-color: #f0f0f0;">
	<div class="mt-5 container-fluid" style="border-style: solid; border-width: 1px; border-color: #C0C0C0; border-radius: 7px;">
		<h1>Bolão</h1>
		<?php
			session_start();
			if (isset($_SESSION['message'])) {
				echo '<div class = "container-fluid" style = "background-color: white;"> <div class = "text-center alert alert-danger" > <strong> ' . $_SESSION['message'] . '</strong> </div> </div>';
				unset($_SESSION['message']);
			}
		?>
		<form class="ml-auto" style="text-align: center;" method = "post" action = "index.php">
			<div class="form-group">
				<label for="cpf">CPF:</label>
				<div class='rightTab'>
					<input type="text" name = "cpf" id="cpf">
				</div>
				<br>
				<label for="senha">Senha:</label>
				<div class='rightTab'>
					<input type="password" name = "senha" id="senha">	
				</div>
				<div class="linkhome"><a href="./telaNewUser.php">Ainda não possuo cadastro</a></div>
				<div class="linkhome"><a href="./telaForgotPassword.php">Esqueci minha senha</a></div>
			</div>
			<button type="submit" class="mb-3 btn btn-midnight">Login</button>
		</form>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>	

	 <?php
	 	require_once "./ControllerLogin.php";
		require_once "./Administrador.php";
		require_once "./Apostador.php";

		if(isset($_POST['cpf']) && isset($_POST['senha'])){
			$cpf = $_POST['cpf'];
			$senha = $_POST['senha'];

			if ($cpf=="06721598567"){
				$user = new Administrador($cpf, '', $senha);
			} else {
				$user = new Apostador($cpf, '', $senha, array(), array(), array(), 500, array(), array(), array());
			}
			$telaLogin = new ControllerLogin();
			$telaLogin->login($user);
		}
	?>
</body>

</html>