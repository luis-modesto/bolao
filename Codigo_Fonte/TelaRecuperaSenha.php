<?php

require_once "./models/Apostador.php";
require_once "./models/Administrador.php";

class TelaRecuperaSenha{
	function recuperaSenha($user, $resposta){
		$senha = $user->recuperarSenha($resposta);
		if ($senha!=''){
			$user->efetuarLogin($user->cpf, $senha);
		}
	}
}

?>