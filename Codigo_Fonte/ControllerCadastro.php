<?php
require_once "./models/Apostador.php";
require_once "TelaCadastro.php";

$user = new Apostador($_POST['cpf'], $_POST['nome'], $_POST['senha'], array(), array(), array(), 500, '', '', '');
$resposta = $_POST['resposta'];
$telaCadastro = new TelaCadastro();
$telaCadastro->criaConta($user, $resposta);

?>