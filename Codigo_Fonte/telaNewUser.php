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
    <h1><a id = "cabecalho" href = "./index.php"> Bolão </a></h1>
	<div class="container-fluid">
		<form class="ml-auto" style="text-align: center;" method = "post" action="ControllerCadastro.php">
			<div class="form-group">
                <label for="cpf"> CPF:</label>
                <div class='rightTab'>
                    <input required type="text" name = "cpf" id="cpf">
                </div>
                <br>
                <label for="nome"> Nome:</label>
                <div class='rightTab'>
				    <input required type="text" name = "nome" id="nome">
                </div>
                <br>
				<label for="senha">Senha:</label>
                <div class='rightTab'>
                    <input required type="password" name = "senha" id="senha">
                </div>
                <br>    
				<label placeholder='Digite aqui sua Resposta Segura'for="senha">Nome do seu melhor amigo de infância:</label>
                <div class='rightTab'>
                    <input required type="text" name = "resposta" id="respostaSeguranca">
                </div>
			</div>
			<button type="submit" class="btn btn-primary">Criar Cadastro</button>
		</form>

	</div>
</body>

</html>