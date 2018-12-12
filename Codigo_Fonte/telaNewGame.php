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

<body style="background-color: #f0f0f0;">
	<div class="container" style="background-color: #f0f0f0;">
		<header>
			<?php
            	//session_start();
            	//$user = $_SESSION["globalUser"];
            	//echo $user->nome;
            ?>
		</header>
		<div class="row">
			<a class="ml-auto" href="./index.php"> Sair </a>
		</div>
		<h1 class='main-title'><a id="cabecalho" href="./telaHomepage.php">Bolão</a></h1>
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
                                <form class="ml-auto" style="text-align: center;" method = "post" action="ControllerCriaJogo.php">
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
</body>

</html>