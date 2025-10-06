<?php
require_once "src/DAO/PratoDAO.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dao = new PratoDAO();

    if ($dao->excluirPrato($id)) {

        header("Location: listar-pratos.php");
        exit;
    } else {
        echo "Erro ao excluir o prato!";
    }
} else {
    echo "ID do prato não informado!";
}