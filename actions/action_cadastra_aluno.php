<?php
require "../configPDO.php";

session_start();

$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$telefone = str_replace(' ', '', $telefone);

$email = $_POST['email_input'];
$senha = $_POST['senha_input'];
$data_matricula = $_POST['data_matricula_input']; 

// Verifica se o email já existe
$sql = $pdo->prepare("SELECT COUNT(*) FROM alunos WHERE email = :email");
$sql->bindValue(':email', $email);
$sql->execute();
$emailExiste = $sql->fetchColumn();

if ($emailExiste > 0) {
    // Redireciona para a página de cadastro se o email já existir
    header("location: ../cadastro_aluno.php?status=email_existente");
    exit;
}

try {
    $sql = $pdo->prepare("INSERT INTO alunos (nome, data_nascimento, telefone, email, senha, data_matricula) VALUES (:nome, :data_nascimento, :telefone, :email, :senha, :data_matricula)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);

    // Criptografa a senha antes de armazenar
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);
    $sql->bindValue(':senha', $hashedPassword);     
    $sql->bindValue(':data_matricula', $data_matricula);

    if($sql->execute()){
        // Armazena o ID do novo aluno na sessão
        $_SESSION['id'] = $pdo->lastInsertId();
        header('Location: ../menu_aluno.php');
        exit;
    }

} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>