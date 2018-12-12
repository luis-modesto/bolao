<?php
require_once "./Apostador.php";
require_once "./Administrador.php";
require_once "ClasseTelaRecuperaSenha.php";

$cpf = $_POST['cpf'];

if ($cpf=="06721598567"){
	$user = new Administrador($cpf, '', '');
} else {
	$user = new Apostador($cpf, '', '', array(), array(), array(), 500, array(), array(), array());
}
$resposta = $_POST['resposta'];
$telaSenha = new TelaRecuperaSenha();
$telaSenha->recuperaSenha($user, $resposta);


?>