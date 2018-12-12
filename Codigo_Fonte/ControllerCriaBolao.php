<?php
require_once "ClasseTelaCriaBolao.php";

$nome = $_POST['nome'];
$campeonato = $_POST['campeonato'];
$esporte = $_POST['esporte'];
$pontosPlacar = $_POST['pontosPlacar'];
$pontosVencedor = $_POST['pontosVencedor'];

$telaBolao = new TelaCriaBolao();
$telaBolao->confirmarCriacaoBolao($nome, $campeonato, $esporte, $pontosPlacar, $pontosVencedor);

?>