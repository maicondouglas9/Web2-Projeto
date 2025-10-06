<?php
require_once "src/DAO/PratoDAO.php";
require_once "src/DTO/Prato.php";

session_start();
$funcionarioLogado = $_SESSION['funcionarioLogado'] ?? false;

$dao = new PratoDAO();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = floatval(str_replace(',', '.', str_replace('.', '', $_POST['preco'])));
    $fotoAtual = $_POST['foto-atual'];
    $foto = $fotoAtual;


    if (isset($_FILES['foto']) && $_FILES['foto']['tmp_name'] != '') {
        $pasta = __DIR__ . "/img_pratos/";
        $nomeArquivo = time() . '_' . basename($_FILES['foto']['name']);
        $caminhoFinal = $pasta . $nomeArquivo;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFinal)) {
            echo "Erro ao mover a imagem!";
            exit;
        }

        $foto = "img_pratos/" . $nomeArquivo;
    }

    $prato = new Prato();
    $prato->setId($id);
    $prato->setNome($nome);
    $prato->setDescricao($descricao);
    $prato->setPreco($preco);
    $prato->setFoto($foto);

    if ($dao->alterarPrato($prato)) {
        header("Location: listar-pratos.php");
        exit;
    } else {
        echo "Erro ao atualizar prato!";
        exit;
    }
}


$idPrato = $_GET['id'] ?? null;
if (!$idPrato) {
    echo "Prato não encontrado!";
    exit;
}

$pratos = $dao->listarPratos();
$prato = null;
foreach ($pratos as $p) {
    if ($p->getId() == $idPrato) {
        $prato = $p;
        break;
    }
}

if (!$prato) {
    echo "Prato não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <title>Contato</title>
    <link rel="icon" href="img/logoa.png" type="image/png">
</head>

<body>
    <nav id="menu">
        <div class="nav-container">
            <div class="nav-left">
                <a href="index.php"><img src="img/logoa.png" id="logo" alt="Logo"></a>
                <ul id="itensm">
                    <li class="nav-item"><a class="nav-item" href="index.php">Cardápio</a></li>
                    <li class="nav-item"><a class="nav-item" href="contato.php">Contato</a></li>
                    <li class="nav-item"><a class="nav-item" href="agendar-mesa.php">Reserva</a></li>
                    <li class="nav-item"><a class="nav-item" href="pedidos.php">Ver pedido</a></li>
                    <?php if (!$funcionarioLogado): ?>
                        <li class="nav-item" id="login-funcionario"><a class="nav-item" href="#">Funcionário</a></li>
                    <?php endif; ?>

                    <?php if ($funcionarioLogado): ?>
                        <li class="nav-item"><a class="nav-item" href="adicionar-prato.php">Adicionar Prato</a></li>
                        <li class="nav-item"><a class="nav-item" href="listar-pratos.php">Gerenciar Pratos</a></li>
                    <?php endif; ?>
                    <?php if ($funcionarioLogado): ?>
                        <li class="nav-item"><a class="nav-item" href="logout.php">Sair</a></li>
                    <?php endif; ?>
                </ul>
            </div>
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

    <div id="modal-login" style="display:none; position:fixed; top:0; left:0; 
    width:100%; height:100%; background:rgba(0,0,0,0.5); 
    justify-content:center; align-items:center;">
        <div style="background:#fff; padding:20px; border-radius:10px;">
            <h3>Login Funcionário</h3>
            <input type="text" id="usuario" placeholder="Usuário"><br><br>
            <input type="password" id="senha" placeholder="Senha"><br><br>
            <button id="btn-login">Entrar</button>
            <button id="btn-fechar-login">Cancelar</button>
        </div>
    </div>

    <form id="form-prato" method="post" enctype="multipart/form-data" action="editar-prato.php">
        <input type="hidden" name="id" value="<?= $prato->getId() ?>">
        <input type="hidden" name="foto-atual" value="<?= $prato->getFoto() ?>">

        <label>Nome do prato:</label>
        <input type="text" id="nome-prato" name="nome" value="<?= htmlspecialchars($prato->getNome()) ?>" required>

        <label>Descrição:</label>
        <textarea id="descricao-prato" name="descricao"
            required><?= htmlspecialchars($prato->getDescricao()) ?></textarea>

        <label>Preço:</label>
        <input type="text" id="preco-prato" name="preco" value="<?= number_format($prato->getPreco(), 2, ',', '.') ?>"
            required oninput="formatarPreco(this)">

        <label>Imagem do prato:</label>
        <input type="file" id="imagem-prato" name="foto" accept="image/*">

        <img id="preview-imagem" src="<?= $prato->getFoto() ?>" alt="Prévia da imagem"
            style="max-width:200px; display:block; margin-top:10px;">

        <button type="submit">Atualizar</button>
    </form>

    <script>
        const imagemInput = document.getElementById('imagem-prato');
        const preview = document.getElementById('preview-imagem');

        imagemInput.addEventListener('change', () => {
            const file = imagemInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '<?= $prato->getFoto() ?>';
            }
        });

        function formatarPreco(input) {
            let valor = input.value.replace(/\D/g, '');
            valor = (valor / 100).toFixed(2);
            input.value = valor.replace('.', ',');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>