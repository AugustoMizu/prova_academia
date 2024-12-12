<?php
require "../configPDO.php";

session_start();

// Obtém os dados do formulário
$id_professor = $_POST['id_input'];
$nome = $_POST['nome_input'];
$data_nascimento = $_POST['data_nascimento_input'];
$telefone = $_POST['telefone_input'];
$telefone = str_replace(' ', '', $telefone);

$email = $_POST['email_input'];
$especialidade = $_POST['especialidade_input'];
$salario = $_POST['salario_input'];
$salario = floatval($salario);

$data_admissao = $_POST['data_admissao_input'];

try {
    $sql = $pdo->prepare("UPDATE professores SET nome = :nome, data_nascimento = :data_nascimento, telefone = :telefone, email = :email, especialidade = :especialidade, salario = :salario, data_admissao = :data_admissao WHERE id = :id");

    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':especialidade', $especialidade);
    $sql->bindValue(':salario', $salario);
    $sql->bindValue(':data_admissao', $data_admissao);
    $sql->bindValue(':id', $id_professor);

    if ($sql->execute()) {
        // Verifica se o tipo de login é admin, caso sim retorna para o menu de admin
        if ($_SESSION['tipo_login'] === 'admin') {
            header('Location: ../menu_admin/tabela_editar_usuario.php?status=atualizado');
        } else {
            header('Location: ../menu_professor.php?status=atualizado');
        }
    } else {
        // Se a execução falhar, redireciona com um status de erro
        header('Location: ../editar_professor.php?status=erro_atualizacao');
        exit;
    }
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro ao atualizar: " . $e->getMessage();
}
