<?php
require "../configPDO.php";
session_start();

// pega os ids da tabela
$id_hora = isset($_GET['id']) ? $_GET['id'] : null;
$id_aluno = isset($_SESSION['id']) ? $_SESSION['id'] : null;

try {
    // Insere os dados na tabela agendamentos
    $sql = $pdo->prepare("INSERT INTO agendamentos (aluno_id, horario_id)
                             VALUES (:aluno_id ,:horario_id)");
    $sql->bindValue(':aluno_id', $id_aluno);
    $sql->bindValue(':horario_id', $id_hora);
    $sql->execute();

    // Redireciona de volta para a página de criação de horário
    header('location: ../menu_aluno/criar_agenda.php?status=cadastrado');
    exit;
} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
    exit;
}
