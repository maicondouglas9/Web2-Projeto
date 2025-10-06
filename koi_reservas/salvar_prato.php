<?php
require_once "src/DAO/PratoDAO.php";
require_once "src/DTO/Prato.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prato = new Prato();
    $prato->setNome($_POST['nome']);
    $prato->setDescricao($_POST['descricao']);
    $prato->setPreco(str_replace(',', '.', $_POST['preco']));
    $prato->setFoto($_FILES['foto']);

    $dao = new PratoDAO();
    if ($dao->salvarPrato($prato)) {
        echo "<script>alert('Prato salvo com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Falha ao salvar o prato!'); window.location.href='index.php';</script>";
    }
}