<?php
require "../configPDO.php";
session_start();

// Verifica se o ID do horário foi passado e se a confirmação foi feita
if (isset($_GET['id']) && isset($_GET['confirmacao']) && $_GET['confirmacao'] == 'true') {
    $id_horario = $_GET['id'];

    try {
        $sql = $pdo->prepare("DELETE FROM agendamentos WHERE id = :id");
        $sql->bindValue(':id', $id_horario);
        $sql->execute();

        header('Location: ../menu_aluno/excluir_agenda.php');
        exit;
    } catch (PDOException $e) {
        // Em caso de erro, redireciona com um status de erro
        echo "Erro ao excluir: " . $e->getMessage();
        header('Location: ../menu_aluno/excluir_agenda.php?status=erro');
        exit;
    }
}else{
    header('location: ./menu_aluno/excluir_agenda.php');
    exit;
}
