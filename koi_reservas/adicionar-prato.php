<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <title>Registro de pratos</title>
    <link rel="icon" href="img/logoa.png" type="image/png">
</head>
<body>
    <nav id="menu">
        <div class="nav-container">
            <a href="index.php"><img src="img/logoa.png" id="logo" alt="Logo"></a>
            <ul id="itensm">
                <li class="nav-item"><a class="nav-item" href="index.php">Cardápio</a></li>
                <li class="nav-item"><a class="nav-item" href="contato.php">Contato</a></li>
                <li class="nav-item"><a class="nav-item" href="agendar-mesa.php">Reserva</a></li>
            </ul>
            </ul>
            <ul id="carrinhomenu">
                <li><img id="carrinho-img" src="img/carrinho-bra.png" alt="Carrinho de compras"></li>
            </ul>
        </div>
    </nav>
    
    <div id="carrinho">
        <h3>Seu Carrinho</h3>
        <ul id="carrinho-lista"></ul>
        <button id="fechar-carrinho">Fechar</button>
    </div>


    <form id="form-prato">
        <label>Nome do prato:</label>
        <input type="text" id="nome-prato" required>

        <label>Descrição:</label>
        <textarea id="descricao-prato" required></textarea>

        <label>Preço:</label>
        <input type="text" id="preco-prato" required oninput="formatarPreco(this)">

        <label>Imagem do prato:</label>
        <input type="file" id="imagem-prato" accept="image/*">

        <img id="preview-imagem" src="" alt="Prévia da imagem" style="max-width:200px; display:none;">

        <button type="submit">Adicionar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>