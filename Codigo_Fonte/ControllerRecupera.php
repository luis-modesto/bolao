<?php
require_once "./models/Apostador.php";
require_once "./models/Administrador.php";
require_once "TelaRecuperaSenha.php";

$cpf = $_POST['cpf'];

if ($cpf=="06721598566"){
	$user = new Administrador($cpf, '', '');
} else {
	$user = new Apostador($cpf, '', '', array(), array(), array(), 500, array(), array(), array());
}
$resposta = $_POST['resposta'];
$telaSenha = new TelaRecuperaSenha();
$telaSenha->recuperaSenha($user, $resposta);


?>