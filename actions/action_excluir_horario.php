<?php
require "../configPDO.php";
session_start();

// Verifica se o ID do horário foi passado e se a confirmação foi feita
if (isset($_GET['id']) && isset($_GET['confirmacao']) && $_GET['confirmacao'] == 'true') {
    $id_horario = $_GET['id'];

    try {
        $sql = $pdo->prepare("DELETE FROM horarios_professores WHERE id = :id");
        $sql->bindValue(':id', $id_horario);
        $sql->execute();

        // Redireciona de volta para a página de  horário, admin ou professor
        if ($_SESSION['tipo_login'] == 'admin') {
            header('Location: ../menu_admin/excluir_horario_admin.php');
        } else {
            header('Location: ../menu_professor/criar_horario.php');
        }
        exit;
    } catch (PDOException $e) {
        // Em caso de erro, redireciona com um status de erro
        echo "Erro ao excluir: " . $e->getMessage();
        header('Location: ../menu_professor/criar_horario.php?status=erro');
        exit;
    }
} else {
    // Se o ID não foi passado ou a confirmação não foi feita, redireciona com um status de erro
    if ($_SESSION['tipo_login'] == 'admin') {
        header('Location: ../menu_admin/excluir_horario_admin.php?status=erro');
    } else {
        header('Location: ../menu_professor/criar_horario.php?status=erro');
    }
    exit;
}
