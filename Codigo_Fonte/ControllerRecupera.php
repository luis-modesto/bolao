<?php
require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "ClasseTelaRecuperaSenha.php";
require_once "ClasseTelaLogin.php";

$cpf = $_POST['cpf'];

if ($cpf=="06721598567"){
	$user = new Administrador($cpf, '', '');
} else {
	$user = new Apostador($cpf, '', '', array(), array(), array(), 500, array(), array(), array());
}
$resposta = $_POST['resposta'];
$telaSenha = new TelaRecuperaSenha();
if ($telaSenha->recuperaSenha($user, $resposta)){
	$telaLogin = new TelaLogin();
	$telaLogin->login($user);
}


?>