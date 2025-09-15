<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <title>Reserva</title>
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
                <li class="nav-item"><a class="nav-item" id="login-funcionario" href="#">Funcionário</a></li>
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

    <div id="modal-login" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
                    <div style="background:#fff; padding:20px; border-radius:10px;">
                        <h3>Login Funcionário</h3>
                        <input type="text" id="usuario" placeholder="Usuário"><br><br>
                        <input type="password" id="senha" placeholder="Senha"><br><br>
                        <button id="btn-login">Entrar</button>
                        <button id="btn-fechar-login">Cancelar</button>
                    </div>
    </div>

    <div class="reserva-container">
        <form id="form-reserva">
            <div class="campo">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="campo">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>
             </div>

            <div class="campo">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
            </div>

            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            </div>

            <button type="submit">Reservar</button>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>