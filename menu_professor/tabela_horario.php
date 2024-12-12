<?php
require "../configPDO.php";

session_start();

// Verifica se o usuário está autenticado
/*if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}*/

// Consulta para buscar os registros de horário
$sql = $pdo->prepare("SELECT hp.id, hp.dia_da_semana, hp.turno, p.nome AS nome FROM horarios_professores hp 
    INNER JOIN professores p ON hp.professor_id = p.id 
    WHERE hp.professor_id = :id");
$sql->bindValue(':id', $_SESSION['id']);
$sql->execute();
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="shortcut icon" type="imagex/x-icon" href="imagens/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tabela de Horários</title>
</head>

<body id="body-login">
    <main class="container-fluid">
        <section class="config-container container w-50 border border-3 rounded p-5 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle">
            <h1 class="text-center">Tabela de Horários</h1>
            <table class="table table-bordered table-striped table-hover table-responsive text-center">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Professor</th>
                        <th>Dia da Semana</th>
                        <th>Turno</th>
                        <th class="table-danger" colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($horarios as $horario): ?>
                        <tr>
                            <td><?= $horario['id']; ?></td>
                            <td><?= $horario['nome']; ?></td>
                            <td><?= $horario['dia_da_semana']; ?></td>
                            <td><?= $horario['turno']; ?></td>
                            <td><a href="editar_horario.php?id=<?= $horario['id']; ?>">Editar</a></td>
                            <td><a href="#" onclick='confirmarExclusao(<?= $horario["id"] ?>)'>Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        function confirmarExclusao(id) {
            const confirmacao = confirm("Você tem certeza que deseja excluir este horário?");
            if (confirmacao) {
                // Redireciona para o script de exclusão com confirmação
                window.location.href = `action_excluir_horario.php?id=${id}&confirmar=true`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>