<?php

class Reserva
{

    private $id;
    private $nome;
    private $telefone;
    private $data_reserva;
    private $horario;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTelefone()
    {

        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getDataReserva()
    {
        return $this->data_reserva;
    }
    public function setDataReserva($data_reserva)
    {
        $this->data_reserva = $data_reserva;
    }

    public function getHorario()
    {
        return $this->horario;
    }
    public function setHorario($horario)
    {
        $this->horario = $horario;
    }


}