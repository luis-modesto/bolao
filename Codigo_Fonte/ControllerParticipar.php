<?php
require_once "ClasseTelaHomepage.php";

session_start();
$_SESSION['idBolaoEscolhido'] = $_POST['bolaoParticipar'];
$idbolao = $_SESSION['idBolaoEscolhido'];
$homepage = new homepage();
$homepage->solicitarParticiparBolao($idbolao);
header('Location: ./telaHomepage.php');

?>