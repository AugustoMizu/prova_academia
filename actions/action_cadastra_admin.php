<?php
require "../configPDO.php";

session_start();

$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$email = $_POST['email_input'];
$senha = $_POST['password_input'];
$salario = $_POST['salario_input'];
$data_admissao = $_POST['data_admissao_input']; 

// Verifica se o email já existe
$sql = $pdo->prepare("SELECT COUNT(*) FROM administradores WHERE email = :email");
$sql->bindValue(':email', $email);
$sql->execute();
$emailExiste = $sql->fetchColumn();

if ($emailExiste > 0) {
    header("location: ../cadastra_admin.php");
    exit;
}

try {
    $sql = $pdo->prepare("INSERT INTO administradores (nome, data_nascimento, telefone, email, senha, salario, data_admissao) VALUES (:nome, :data_nascimento, :telefone, :email, :senha, :salario, :data_admissao)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT); // criptografa a senha antes de armazenar
    $sql->bindValue(':senha', $hashedPassword);    
    $sql->bindValue(':salario', $salario);
    $sql->bindValue(':data_admissao', $data_admissao);

    if($sql->execute()){
    
        $_SESSION['id'] = $pdo->lastInsertId();
        header('Location: ../menu_admin.php');
    }

} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>