<?php
session_start();
$funcionarioLogado = $_SESSION['funcionarioLogado'] ?? false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? '';
    $telefone = $_POST["telefone"] ?? '';
    $endereco = $_POST["endereco"] ?? '';
    $cep = $_POST["cep"] ?? '';
    $pagamento = $_POST["pagamento"] ?? '';
    $entrega = $_POST["entrega"] ?? '';
    $itens = $_SESSION["carrinho"] ?? [];
    $total = $_SESSION["total"] ?? 0;

    unset($_SESSION["carrinho"]);
    unset($_SESSION["total"]);
}

require_once "src/DAO/CarrinhoDAO.php";
require_once "src/DTO/Carrinho.php";

$carrinho = new Carrinho();
$carrinho->setNome($nome);
$carrinho->setTelefone($telefone);
$carrinho->setEndereco($endereco);
$carrinho->setCep($cep);
$carrinho->setPagamento($pagamento);
$carrinho->setEntrega($entrega);
$carrinho->setTotal($total);
$carrinho->setItens($itens);

$dao = new CarrinhoDAO();
$idPedido = $dao->salvarPedido($carrinho);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pedido Confirmado</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <nav id="menu">
        <div class="nav-container">
            <div class="nav-left">
                <a href="index.php"><img src="img/logoa.png" id="logo" alt="Logo"></a>
                <ul id="itensm">
                    <li class="nav-item"><a href="index.php">Cardápio</a></li>
                    <li class="nav-item"><a href="contato.php">Contato</a></li>
                    <li class="nav-item"><a href="agendar-mesa.php">Reserva</a></li>
                    <li class="nav-item"><a class="nav-item" href="pedidos.php">Ver pedido</a></li>
                    <?php if (!$funcionarioLogado): ?>
                        <li class="nav-item" id="login-funcionario"><a href="#">Funcionário</a></li>
                    <?php endif; ?>
                    <?php if ($funcionarioLogado): ?>
                        <li class="nav-item"><a href="adicionar-prato.php">Adicionar Prato</a></li>
                        <li class="nav-item"><a href="listar-pratos.php">Gerenciar Pratos</a></li>
                        <li class="nav-item"><a href="listar-reservas.php">Gerenciar Reservas</a></li>
                        <li class="nav-item"><a href="logout.php">Sair</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <ul id="carrinhomenu">
                <li><img id="carrinho-img" src="img/carrinho-bra.png" alt="Carrinho de compras"></li>
            </ul>
        </div>
    </nav>
    <div class="pedido">
        <h1>Pedido Confirmado ✅</h1>
        <p><strong>Código do pedido:</strong> <?= htmlspecialchars($idPedido) ?></p>
        <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($telefone) ?></p>
        <p><strong>Endereço:</strong> <?= htmlspecialchars($endereco) ?></p>
        <p><strong>CEP:</strong> <?= htmlspecialchars($cep) ?></p>
        <p><strong>Pagamento:</strong> <?= htmlspecialchars($pagamento) ?></p>
        <p><strong>Entrega:</strong> <?= htmlspecialchars($entrega) ?></p>

        <h3>Produtos:</h3>
        <ul>
            <?php foreach ($itens as $item): ?>
                <li>
                    <?= htmlspecialchars($item["nome"]) ?> -
                    <?= intval($item["qtd"]) ?>x -
                    R$ <?= number_format($item["preco"], 2, ",", ".") ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <p><strong>Total: R$ <?= number_format($total, 2, ",", ".") ?></strong></p>
    </div>
</body>

</html>