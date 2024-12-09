<?php
require "configPDO.php";
$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$email = $_POST['email_input'];
$senha = $_POST['password_input'];
$especialidade = $_POST['especialidade_input'];
$salario = $_POST['salario_input'];
$data_admissao = $_POST['data_admissao_input']; 

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

    if($sql->execute()){
        header('Location: menu_professor.php');
    }

} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}

?>
