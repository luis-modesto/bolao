<?php
require_once "ClasseTelaLogin.php";
require_once "./Administrador.php";
require_once "./Apostador.php";

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if ($cpf=="06721598567"){
	$user = new Administrador($cpf, '', $senha);
} else {
	$user = new Apostador($cpf, '', $senha, array(), array(), array(), 500, array(), array(), array());
}
$telaLogin = new TelaLogin();
$telaLogin->login($user);


?>