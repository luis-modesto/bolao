<?php

session_start();
$_SESSION['idBolaoEscolhido'] = $_POST['bolaoEscolhido'];
$idbolao = $_SESSION['idBolaoEscolhido'];
echo $idbolao;
?>