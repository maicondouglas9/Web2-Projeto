<?php

require_once __DIR__ . "/../Conexao/Conexao.php";

class ReservaDAO
{

    private $con = null;

    public function getCon()
    {
        if ($this->con === null) {
            $bd = new Conexao();
            $this->con = $bd->getMysqli();
        }
        return $this->con;
    }

    public function getDescon()
    {
        if ($this->con !== null) {
            $this->con->close();
            $this->con = null;
        }
    }

    public function salvarReserva(Reserva $reserva)
    {
        $sql = "INSERT INTO tb_reserva(nome, telefone, data_reserva, horario) 
        VALUES ('{$reserva->getNome()}','{$reserva->getTelefone()}', '{$reserva->getDataReserva()}','{$reserva->getHorario()}')";

        $con = $this->getCon();
        if (!$con->query($sql)) {
            error_log("Erro SQL: " . $con->error);
            return false;
        }

        return true;
    }

    public function listarReservas()
    {
        $con = $this->getCon();
        $sql = "SELECT * FROM tb_reserva ORDER BY nome ASC";
        $result = $con->query($sql);

        $reservas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reserva = new Reserva();
                $reserva->setId($row['id_reserva']);
                $reserva->setNome($row['nome']);
                $reserva->setTelefone($row['telefone']);
                $reserva->setDataReserva($row['data_reserva']);
                $reserva->setHorario($row['horario']);

                $reservas[] = $reserva;
            }
        }
        return $reservas;
    }

    public function excluirReserva($id)
    {
        $con = $this->getCon();

        $id = intval($id);

        $sql = "DELETE FROM tb_reserva WHERE id_reserva = $id";

        if ($con->query($sql)) {
            return true;
        } else {
            echo "Erro ao excluir a reserva";
            return false;
        }
    }

    public function alterarReserva($reserva)
    {
        $con = $this->getCon();

        $id = intval($reserva->getId());
        $nome = $reserva->getNome();
        $telefone = $reserva->getTelefone();
        $data_reserva = $reserva->getDataReserva();
        $horario = $reserva->getHorario();

        $sql = "UPDATE tb_reserva 
            SET nome = '$nome', telefone = '$telefone', data_reserva = '$data_reserva', horario = '$horario' 
            WHERE id_reserva = $id";

        if ($con->query($sql)) {
            return true;
        } else {
            echo "Erro ao atualizar reserva: " . $con->error;
            return false;
        }
    }

}