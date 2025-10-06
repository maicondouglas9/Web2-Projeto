<?php

session_start();
$funcionarioLogado = $_SESSION['funcionarioLogado'] ?? false;

require_once __DIR__ . "/src/Conexao/Conexao.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = intval($_POST["codigo"]);
    $bd = new Conexao();
    $con = $bd->getMysqli();


    $sql = "SELECT * FROM pedidos WHERE id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $pedido = $resultado->fetch_assoc();
        session_start();
        $_SESSION["pedido_id"] = $pedido["id_pedido"];
        $_SESSION["pedido_dados"] = $pedido;

        header("Location: gerenciar_pedido.php");
        exit();
    } else {
        echo "<script>alert('Código não encontrado!'); window.location='pedido.php';</script>";
    }
}

?>