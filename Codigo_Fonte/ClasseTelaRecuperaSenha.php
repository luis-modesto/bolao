<?php

require_once "./Apostador.php";
require_once "./Administrador.php";

class TelaRecuperaSenha{
	function recuperaSenha($user, $resposta){
		$senha = $user->recuperarSenha($resposta);
		if ($senha!=''){
			return $user->efetuarLogin($user->cpf, $senha);
		}
	}
}

?>