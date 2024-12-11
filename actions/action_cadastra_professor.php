<?php
require "../configPDO.php";

session_start();

$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$telefone = str_replace(' ', '', $telefone);

$email = $_POST['email_input'];
$senha = $_POST['senha_input'];
$especialidade = $_POST['especialidade_input'];
$salario = $_POST['salario_input'];
$salario = floatval($salario);

$data_admissao = $_POST['data_admissao_input'];

// Verifica se o email já existe
$sql = $pdo->prepare("SELECT COUNT(*) FROM professores WHERE email = :email");
$sql->bindValue(':email', $email);
$sql->execute();
$emailExiste = $sql->fetchColumn();

if ($emailExiste > 0) {
    header("location: ../cadastra_professor.php?status=email_existente");
    exit;
}

try {
    $sql = $pdo->prepare("INSERT INTO professores (nome, data_nascimento, telefone, email, senha, especialidade, salario, data_admissao) VALUES (:nome, :data_nascimento, :telefone, :email, :senha, :especialidade, :salario, :data_admissao)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT); // criptografa a senha antes de armazenar
    $sql->bindValue(':senha', $hashedPassword);
    $sql->bindValue(':especialidade', $especialidade);
    $sql->bindValue(':salario', $salario);
    $sql->bindValue(':data_admissao', $data_admissao);

    if ($sql->execute()) {

        $_SESSION['id'] = $pdo->lastInsertId();
        // Verifica se o tipo de login é admin, caso sim retorna para o menu de admin
        if ($_SESSION['tipo_login'] === 'admin') {
            header('Location: ../menu_admin.php?status=cadastrado');
        } else {
            header('Location: ../menu_professor.php');
        }
    }
} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
