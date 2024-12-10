<?php
require "../configPDO.php";
session_start();

$tipo = $_POST['tipo'];
$email = $_POST['email_input'];
$senha_digitada = $_POST['password_input'];

if ($tipo == "aluno") { // consulta email e senha no banco de dados

    $sql = $pdo->prepare("SELECT id, nome, senha FROM alunos WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha está correta
    if (password_verify($senha_digitada, $usuario['senha'])) {
        $_SESSION = $usuario;
        header("location: ../menu_aluno.php");
    } else {
        // Email ou senha incorretos
        header("location: ../login.php?status=false");
        exit;
    }
} else if ($tipo == "professor") { // consulta email e senha no banco de dados

    $sql = $pdo->prepare("SELECT id, nome, senha FROM professores WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha está correta
    if (password_verify($senha_digitada, $usuario['senha']) == true) {
        $_SESSION = $usuario;
        header("location: ../menu_professor.php");
    } else {
        // Email ou senha incorretos
        header("location: ../login.php?status=false");
        exit;
    }
} else if ($tipo == "admin") { // consulta email e senha no banco de dados

    $sql = $pdo->prepare("SELECT id, nome, senha FROM administradores WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha está correta
    if (password_verify($senha_digitada, $usuario['senha'])) {
        $_SESSION = $usuario;
        header("location: ../menu_admin.php");
    } else {
        // Email ou senha incorretos
        header("location: ../login.php?status=false");
        exit;
    }
}
