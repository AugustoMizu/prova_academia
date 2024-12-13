<?php
require "../configPDO.php";
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    header('Location: ../login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Consulta para buscar os registros de agendamentos com os nomes dos professores
$sql = $pdo->prepare("
    SELECT a.id, p.nome AS nome_professor, hp.dia_da_semana, hp.turno
    FROM agendamentos a
    INNER JOIN horarios_professores hp ON a.horario_id = hp.id
    INNER JOIN professores p ON hp.professor_id = p.id
");
$sql->execute();
$agendamentos = $sql->fetchAll(PDO::FETCH_ASSOC);

// pega o status do action excluir
$status = isset($_GET['status']) ? $_GET['status'] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Excluir Agendamentos</title>
</head>

<body id="body-login">
    <div class="container w-75 border border-3 rounded p-5 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle">
        <p><a href="../menu_aluno.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">
                VOLTAR</a></p>
        <h2 class="text-center mb-4 fw-bolder">Excluir Agendamentos</h2>
        <table class="table table-bordered table-striped table-hover table-responsive text-center">
            <thead>
                <tr class="table-dark">
                    <th>ID</th>
                    <th>Professor</th>
                    <th>Dia da Semana</th>
                    <th>Turno</th>
                    <th class="table-danger">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendamentos as $agendamento) : ?>
                    <tr>
                        <td><?= $agendamento['id']; ?></td>
                        <td><?= $agendamento['nome_professor']; ?></td>
                        <td><?= $agendamento['dia_da_semana']; ?></td>
                        <td><?= $agendamento['turno']; ?></td>
                        <td><a href="#" onclick='confirmarExclusao(<?= $agendamento["id"] ?>)'>Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmarExclusao(id) {
            const confirmacao = confirm("Você tem certeza que deseja excluir este agendamento?");
            if (confirmacao) {
                // Redireciona para o script de exclusão com confirmação
                window.location.href = `../actions/action_excluir_agenda.php?id=${id}&confirmacao=true`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>