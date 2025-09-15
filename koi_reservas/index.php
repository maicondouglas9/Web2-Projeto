<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <title>Cardápio</title>
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
            </ul>
            <ul id="carrinhomenu">
                <li><img id="carrinho-img" src="img/carrinho-bra.png" alt="Carrinho de compras"></li>
            </ul>
        </div>
    </nav>
    
            <div id="carrinho">
                <h3>Seu Carrinho</h3>
                <ul id="carrinho-lista"></ul>
                <button id="finalizar-compra">Finalizar Compra</button>
                <button id="fechar-carrinho">Fechar</button>

                <div id="carrinho-info">
                    <div class="campo">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" maxlength="9" placeholder="00000-000">
                    </div>

                    <div class="campo">
                        <label for="frete">Frete:</label>
                        <select id="frete">
                            <option value="0">Selecionar...</option>
                            <option value="10">Entrega (R$ 10,00)</option>
                            <option value="0">Retirada na loja (Grátis)</option>
                        </select>
                    </div>

                        <p id="total">Total: R$ 0,00</p>
                    </div>
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

    <main id="cardapio">
            <h2>Nosso Cardápio</h2>
            <div class="pratos-container">
    
                <div class="prato-card">
                    <img src="img/sushi1.png" alt="Sushi Especial">
                    <h3>Sushi Especial</h3>
                    <p>8 unidades de sushi fresco com salmão e atum selecionados.</p>
                    <span class="preco">R$ 45,00</span>
                    <button class="btn-add" data-nome="Sushi Especial" data-preco="45.00" data-img="img/sushi1.png">Adicionar ao Carrinho</button>
                    <button class="btn-excluir" style="display:none;">Excluir</button>
                </div>

                <div class="prato-card">
                    <img src="img/ramen.png" alt="Ramen Tradicional">
                    <h3>Ramen Tradicional</h3>
                    <p>Macarrão artesanal em caldo rico com carne de porco e ovo cozido.</p>
                    <span class="preco">R$ 38,00</span>
                    <button class="btn-add" data-nome="Ramen Tridicional" data-preco="38.00" data-img="img/ramen.png" >Adicionar ao Carrinho</button>
                    <button class="btn-excluir" style="display:none;">Excluir</button>
                </div>

                <div class="prato-card">
                    <img src="img/temaki.png" alt="Temaki de Salmão">
                    <h3>Temaki de Salmão</h3>
                    <p>Temaki crocante recheado com salmão fresco e cream cheese.</p>
                    <span class="preco">R$ 22,00</span>
                    <button class="btn-add" data-nome="Temaki de Salmão" data-preco="22.00" data-img="img/temaki.png">Adicionar ao Carrinho</button>
                    <button class="btn-excluir" style="display:none;">Excluir</button>
                </div>

            </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>