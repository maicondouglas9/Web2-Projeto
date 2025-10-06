<?php
session_start();
$funcionarioLogado = $_SESSION['funcionarioLogado'] ?? false;

require_once __DIR__ . "/src/Conexao/Conexao.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id_pedido"]);

    $bd = new Conexao();
    $con = $bd->getMysqli();

    $sql = "UPDATE pedidos SET status = 'Cancelado' WHERE id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pedido cancelado com sucesso!'); window.location='pedidos.php';</script>";
    } else {
        echo "<script>alert('Erro ao cancelar o pedido.'); history.back();</script>";
    }
}
?>
