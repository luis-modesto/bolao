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

<body style = "background-image: url('stadium2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="mt-5 container" style = "background-color: #f0f0f0; opacity: 0.9; position: relative; bottom: -40px; max-width: 500px; border-style: solid; border-radius: 7px; border-color: #C0C0C0;">
    	<h1><a style = "color: black; text-decoration: none;" href = "./index.php"> Bolão </a></h1>
		<form class="ml-auto" style="text-align: center;" method = "post" action="telaNewUser.php">
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
			<button type="submit" class="mb-3 btn btn-midnight">Criar Cadastro</button>
		</form>

	</div>
    <?php
    require_once "./Apostador.php";
    require_once "./ControllerCadastro.php";
    if(isset($_POST['cpf']) && isset($_POST['nome']) && isset($_POST['senha']) && isset($_POST['resposta'])){
        $user = new Apostador($_POST['cpf'], $_POST['nome'], $_POST['senha'], array(), array(), array(), 500, '', '', '');
        $resposta = $_POST['resposta'];
        $telaCadastro = new ControllerCadastro();
        $telaCadastro->criaConta($user, $resposta);
    }
    ?>
</body>

</html>