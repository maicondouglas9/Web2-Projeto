<?php

class Carrinho
{
    private $id;
    private $nome;
    private $telefone;
    private $endereco;
    private $cep;
    private $pagamento;
    private $entrega;
    private $total;
    private $itens = [];

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

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getPagamento()
    {
        return $this->pagamento;
    }

    public function getEntrega()
    {
        return $this->entrega;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getItens()
    {
        return $this->itens;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function setItens(array $itens)
    {
        $this->itens = $itens;
    }
}
