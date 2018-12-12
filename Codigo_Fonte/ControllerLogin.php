<?php
require_once "TelaLogin.php";
require_once "./models/Administrador.php";
require_once "./models/Apostador.php";

echo "oi\n";
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if ($cpf=="06721598566"){
	$user = new Administrador($cpf, '', $senha);
} else {
	$user = new Apostador($cpf, '', $senha, array(), array(), array(), 500, array(), array(), array());
}
$telaLogin = new TelaLogin();
$telaLogin->login($user);


?>