<?php
require "../configPDO.php";

session_start();

$id_aluno = $_POST['id_input'];
$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$telefone = str_replace(' ', '', $telefone);
$email = $_POST['email_input'];
$senha = $_POST['senha_input']; // A senha pode ser deixada em branco se não for alterada

// Verifica se a senha foi alterada
if (!empty($senha)) {
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a nova senha
} else {
    $hashedPassword = null; // Não altera a senha se não for fornecida
}

try {
    // Prepara a consulta para atualizar os dados do aluno
    $sql = $pdo->prepare("UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, telefone = :telefone, email = :email" . 
                          ($hashedPassword ? ", senha = :senha" : "") . 
                          " WHERE id = :id");

    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);
    if ($hashedPassword) {
        $sql->bindValue(':senha', $hashedPassword);
    }
    $sql->bindValue(':id', $id_aluno);

    if ($sql->execute()) {
        // Verifica se o tipo de login é admin, caso sim retorna para o menu de admin
        if ($_SESSION['tipo_login'] === 'admin') {
            header('Location: ../menu_admin/tabela_editar_usuario.php?status=atualizado');
        } else {
            header('Location: ../menu_aluno.php?status=atualizado');
        }
    } else {
        // Se a execução falhar, redireciona com um status de erro
        header('Location: ../editar_aluno.php?status=erro_atualizacao');
        exit;
    }
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro ao atualizar: " . $e->getMessage();
}