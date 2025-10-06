<?php
session_start();

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($usuario === 'admin' && $senha === '1234') {
    $_SESSION['funcionarioLogado'] = true;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'msg' => 'Usuário ou senha incorretos']);
}
?>