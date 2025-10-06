<?php
require_once __DIR__ . "/src/Conexao/Conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id_pedido"]);
    $novo_endereco = $_POST["novo_endereco"];

    $bd = new Conexao();
    $con = $bd->getMysqli();

    $sql = "UPDATE pedidos SET endereco = ? WHERE id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $novo_endereco, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Endereço atualizado com sucesso!'); window.location='gerenciar_pedido.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar endereço.'); history.back();</script>";
    }
}
?>
