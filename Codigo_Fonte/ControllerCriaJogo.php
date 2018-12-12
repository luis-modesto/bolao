<?php
require_once "ClasseTelaCriaJogo.php";

$dataJogo = $_POST['dataJogo'];
$dataLimite = $_POST['dataLimite'];
$time1 = $_POST['time1'];
$time2 = $_POST['time2'];
$aposta = $_POST['aposta'];


$telaJogo = new TelaCriaJogo();
$telaJogo->confirmarCriacaoJogo($dataJogo, $dataLimite, $time1, $time2, $aposta);

?>