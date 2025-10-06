<?php

require_once "src/DAO/ReservaDAO.php";
require_once "src/DTO/Reserva.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $reserva = new Reserva();
    $reserva->setNome($_POST['nome']);
    $reserva->setTelefone($_POST['telefone']);
    $reserva->setDataReserva($_POST['data']);
    $reserva->setHorario($_POST['horario']);

    $dao = new ReservaDAO();
    if ($dao->salvarReserva($reserva)) {
        echo "<script>
            alert('Reserva salva com sucesso!');
            window.location.href = 'agendar-mesa.php';
          </script>";
        exit;
    } else {
        echo "<script>
            alert('Falha ao salvar a reserva!');
            window.location.href = 'agendar-mesa.php';
          </script>";
        exit;
    }

}