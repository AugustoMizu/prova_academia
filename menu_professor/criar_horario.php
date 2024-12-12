<?php
require "../configPDO.php";
session_start();

// Verifica se o usuário está autenticado
/*if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}*/

// Consulta para buscar os registros de horário
$sql = $pdo->prepare("SELECT hp.id, hp.dia_da_semana, hp.turno, p.nome AS nome_professor,
 p.id AS id_professor FROM horarios_professores hp INNER JOIN professores p ON hp.professor_id = p.id
 WHERE hp.professor_id = :id");
$sql->bindParam(':id', $_SESSION['id']);
$sql->execute();
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-jpg" href="imagens/icon.png">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Horário</title>
</head>

<body id="body-login">
    <form action="" method="get" class="container-fluid">
        <div class="container w-50 border border-3 rounded p-5 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle" style="background-color: #E2E3E5;">
            <p><a href="../menu_professor.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">
                    VOLTAR</a></p>
            <h2 class="text-center mb-4 fw-bolder">
                Cadastro de Horário</h2>
            <div class="mb-3 d-flex align-items-center ">
                <div class="container">
                    <label for="dia_da_semana" class="form-label">Dia da Semana</label>
                    <select id="dia_da_semana" name="dia_da_semana" class="form-select" required>
                        <option value="" disabled selected>Selecione o Dia</option>
                        <option value="SEGUNDA">Segunda</option>
                        <option value="TERÇA">Terça</option>
                        <option value="QUARTA">Quarta</option>
                        <option value="QUINTA">Quinta</option>
                        <option value="SEXTA">Sexta</option>
                        <option value="SÁBADO">Sábado</option>
                        <option value="DOMINGO">Domingo</option>
                    </select>
                </div>
                <div class="container">
                    <label for="turno" class="form-label">Turno</label>
                    <select id="turno" name="turno" class="form-select" required>
                        <option value="" disabled selected>Selecione o Turno</option>
                        <option value="MANHÃ">Manhã</option>
                        <option value="TARDE">Tarde</option>
                        <option value="NOITE">Noite</option>
                        <option value="INTEGRAL">Integral</option>
                    </select>
                </div>
            </div>
            <button type="button" onclick="<?php cadastraHorario()?>" class="button2 mb-3">Cadastrar</button>
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
                            <td><?= $horario['nome_professor']; ?></td>
                            <td><?= $horario['dia_da_semana']; ?></td>
                            <td><?= $horario['turno']; ?></td>
                            <td><a href="editar_horario.php?id=<?= $horario['id']; ?>">Editar</a></td>
                            <td><a href="#" onclick='confirmarExclusao(<?= $horario["id"] ?>)'>Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php

function cadastraHorario()
{
    require "../configPDO.php";
    $dia_semana = $_GET['dia_da_semana'];
    $turno = $_GET['turno'];
    $id_professor = $_SESSION['id'];

    if (isset($dia_semana) && isset($turno)) {

        try {
            $sql = $pdo->prepare("INSERT INTO horarios_professores (professor_id, dia_da_semana, turno)
                                 VALUES (:id_professor, :dia_semana, :turno)");
            $sql->bindValue(':id_professor', $id_professor);
            $sql->bindValue(':dia_semana', $dia_semana);
            $sql->bindValue(':turno', $turno);
            $sql->execute();

        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>