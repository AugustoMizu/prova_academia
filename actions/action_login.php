<?php
require "../configPDO.php";
session_start();

$tipo = $_POST['tipo'];
$email = $_POST['email_input'];
$senha_digitada = $_POST['password_input'];

if ($tipo == "aluno") {
    $sql = $pdo->prepare("SELECT id, tipo_login, nome, senha FROM alunos WHERE email = :email");

} else if ($tipo == "professor") {
    $sql = $pdo->prepare("SELECT id, tipo_login, nome, senha FROM professores WHERE email = :email");

} else if ($tipo == "admin") {
    $sql = $pdo->prepare("SELECT id, tipo_login, nome, senha FROM administradores WHERE email = :email");

} else {
    header("location: ../login.php?status=tipo_invalido");
    exit;
}

$sql->bindValue(':email', $email);
$sql->execute();
$usuario = $sql->fetch(PDO::FETCH_ASSOC);


if ($usuario && password_verify($senha_digitada, $usuario['senha'])) { // dereciona ao menu adequado ou ao login
    $_SESSION = $usuario;

    if ($tipo == "aluno") {
        header("Location: ../menu_aluno.php");

    } else if ($tipo == "professor") {
        header("Location: ../menu_professor.php");

    } else if ($tipo == "admin") {
        header("Location: ../menu_admin.php");
    }
    exit;
} else {
     header("location: ../login.php?status=false");
    exit;
}