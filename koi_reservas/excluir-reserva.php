<?php
require_once "src/DAO/ReservaDAO.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dao = new ReservaDAO();

    if ($dao->excluirReserva($id)) {

        header("Location: listar-reservas.php");
        exit;
    } else {
        echo "Erro ao excluir a reserva!";
    }
} else {
    echo "ID da reserva não foi informado!";
}