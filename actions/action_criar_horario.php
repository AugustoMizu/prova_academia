<?php
require "../configPDO.php";
session_start();

$dia_semana = $_POST['dia_da_semana'];
$turno = $_POST['turno'];

// Verifica se o admin está cadastrando e pega o id do professor
$id_professor = isset($_POST['professor_id']) ? $_POST['professor_id'] : $_SESSION['id'];

if (isset($dia_semana) && isset($turno)) {
    try {
        $sql = $pdo->prepare("INSERT INTO horarios_professores (professor_id, dia_da_semana, turno)
                             VALUES (:id_professor, :dia_semana, :turno)");
        $sql->bindValue(':id_professor', $id_professor);
        $sql->bindValue(':dia_semana', $dia_semana);
        $sql->bindValue(':turno', $turno);
        $sql->execute();

        // Redireciona de volta para a página de criação de horário
        header('location: ' . (isset($_POST['professor_id']) ? '../menu_admin/criar_horario_admin.php?status=casdastrado' : '../menu_professor/criar_horario.php'));
        exit;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
        header('location: ' . (isset($_POST['professor_id']) ? '../menu_admin/criar_horario_admin.php?status=duplicado' : '../menu_professor/criar_horario.php?status=duplicado'));
        exit;
    }
} else {
    header('location: ../menu_professor/criar_horario.php?status=erro');
    exit;
}