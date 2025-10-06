<?php
require_once __DIR__ . "/../Conexao/Conexao.php";
require_once __DIR__ . "/../DTO/Carrinho.php";

class CarrinhoDAO
{
    private $con;

    private function getCon()
    {
        if ($this->con === null) {
            $bd = new Conexao();
            $this->con = $bd->getMysqli();
        }
        return $this->con;
    }

    public function salvarPedido(Carrinho $pedido)
    {
        $con = $this->getCon();

        $sql = "INSERT INTO pedidos (nome, telefone, endereco, cep, pagamento, entrega, total) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        $nome = $pedido->getNome();
        $telefone = $pedido->getTelefone();
        $endereco = $pedido->getEndereco();
        $cep = $pedido->getCep();
        $pagamento = $pedido->getPagamento();
        $entrega = $pedido->getEntrega();
        $total = $pedido->getTotal();

        $stmt->bind_param("ssssssd", $nome, $telefone, $endereco, $cep, $pagamento, $entrega, $total);
        $stmt->execute();

        $idPedido = $stmt->insert_id;

        foreach ($pedido->getItens() as $item) {
            $sqlItem = "INSERT INTO itens_pedido (id_pedido, nome_prato, quantidade, preco) VALUES (?, ?, ?, ?)";
            $stmtItem = $con->prepare($sqlItem);

            $nomePrato = $item["nome"];
            $qtd = $item["qtd"];
            $preco = $item["preco"];

            $stmtItem->bind_param("isid", $idPedido, $nomePrato, $qtd, $preco);
            $stmtItem->execute();
        }

        return $idPedido;
    }

    public function listarPedidos()
    {
        $con = $this->getCon();
        $result = $con->query("SELECT * FROM pedidos ORDER BY data_pedido DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function listarItens($idPedido)
    {
        $con = $this->getCon();
        $stmt = $con->prepare("SELECT * FROM itens_pedido WHERE id_pedido = ?");
        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
