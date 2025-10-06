<?php
session_start();
$funcionarioLogado = $_SESSION['funcionarioLogado'] ?? false;

// Recebe itens do carrinho via fetch (JSON)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $dados = json_decode(file_get_contents("php://input"), true);
  if ($dados) {
    $_SESSION["carrinho"] = $dados["itens"];
    $_SESSION["total"] = $dados["total"];
  }
}

// Pega dados do carrinho da sessão
$itens = $_SESSION["carrinho"] ?? [];
$total = $_SESSION["total"] ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Finalizar Compra</title>
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

  <h1>Finalizar Compra</h1>

  <form id="form-reserva" method="post" action="confirmar-pedido.php">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" required maxlength="11">

    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>

    <label for="cep">CEP:</label>
    <input type="text" name="cep" required maxlength="9">

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

    <h3>Método de Pagamento</h3>
    <select name="pagamento" required>
      <option value="cartao">Cartão</option>
      <option value="pix">PIX</option>
      <option value="dinheiro">Dinheiro</option>
    </select>

    <h3>Método de Entrega</h3>
    <select name="entrega" required>
      <option value="retirada">Retirada no Local</option>
      <option value="delivery">Delivery</option>
    </select>

    <button type="submit">Confirmar Pedido</button>
  </form>
</body>

</html>