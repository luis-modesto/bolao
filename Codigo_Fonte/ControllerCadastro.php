<?php
require_once "Apostador.php";
require_once "ClasseTelaCadastro.php";

$user = new Apostador($_POST['cpf'], $_POST['nome'], $_POST['senha'], array(), array(), array(), 500, '', '', '');
$resposta = $_POST['resposta'];
$telaCadastro = new TelaCadastro();
$telaCadastro->criaConta($user, $resposta);

?>