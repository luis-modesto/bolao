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
    <script type="text/javascript" src="./TelaCriaBolao.js"></script>
    <link rel="stylesheet" type="text/css" href="./estilo.css">
</head>

<body style = "background-image: url('stadium2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <?php
        require_once "./TelaUsuario.php";

        $tela = new TelaUsuario();
        echo $tela->exibirNavBar();
    ?>
        <div class = "mt-5 container" style = "max-width: 900px; background-color: #f0f0f0; position: relative; bottom: -40px;">
        <div class='mt-5 new-game'>
            <button class = "mt-2 btn btn-info" disabled> Criar novo bolão</button>
            <button class = "ml-3 mt-2 btn btn-info"> Meus bolões</button>
        </div>
        <div class="row mt-3">
    			<div class="col-8 offset-2">
    				<div class="resultados shadow">
    					<h6 class="text-center">Novo Bolão</h6>
                        <div class="container-fluid">
                                <form class="ml-auto" style="text-align: center;" method = "post" action="telaNewBolao.php">
                                    <div class="form-group">
                                        <label for="nome"> Nome:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "nome" id="nome">
                                        </div>
                                        <br>
                                        <label for="campeonato"> Campeonato:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "campeonato" id="campeonato">
                                        </div>
                                        <br>
                                        <label for="esporte">Esporte:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "esporte" id="esporte">
                                        </div>
                                        <br>
                                        <label for="ptsAcertarPlacar">Pontos por acertar placar:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "pontosPlacar" id="pontosPlacar">
                                        </div>
                                        <br>
                                        <label for="ptsAcertarVencedor">Pontos por acertar o vencedor do jogo:</label>
                                        <div class='rightTab'>
                                            <input type="text" name = "pontosVencedor" id="pontosVencedor">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Criar Bolão</button>
                                </form>
                        </div>
    				</div>
    			</div>
    	</div>
    </div>
    <?php
    require_once "./ControllerCriaBolao.php";
    
    $telaBolao = new ControllerCriaBolao();
    if(isset($_POST['nome']) && isset($_POST['campeonato']) && isset($_POST['esporte']) && isset($_POST['pontosPlacar']) && isset($_POST['pontosVencedor'])){
        $nome = $_POST['nome'];
        $campeonato = $_POST['campeonato'];
        $esporte = $_POST['esporte'];
        $pontosPlacar = $_POST['pontosPlacar'];
        $pontosVencedor = $_POST['pontosVencedor'];     
        $telaBolao->confirmarCriacaoBolao($nome, $campeonato, $esporte, $pontosPlacar, $pontosVencedor);
    }
    else if(isset($_POST['sair'])){
        $telaBolao->sair();
    }
    ?>
</body>

</html>