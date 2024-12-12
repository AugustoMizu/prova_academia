<?php
require "../configPDO.php";
session_start();

// Verifica se o usuário está autenticado
/*if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}*/

// Consulta para buscar os professores
$sql = $pdo->query("SELECT id, nome FROM professores");
$professores = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-jpg" href="imagens/icon.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Horário</title>
</head>

<body id="body-login">
    <form action="actions/action_cadastra_horario.php" method="post" class="container-fluid">
        <div class="container w-50 border border-3 rounded p-4 mt-3 shadow" style="background-color: #E2E3E5;">
            <h2 class="text-center mb-4 fw-bolder">Cadastro de Horário</h2>

            <div class="mb-3">
                <label for="professor_id" class="form-label">Professor</label>
                <select id="professor_id" name="professor_id" class="form-select" required>
                    <option value="" disabled selected>Selecione o Professor</option>
                    <?php foreach ($professores as $professor): ?>
                        <option value="<?= $professor['id']; ?>"><?= $professor['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
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

            <div class="mb-3">
                <label for="turno" class="form-label">Turno</label>
                <select id="turno" name="turno" class="form-select" required>
                    <option value="" disabled selected>Selecione o Turno</option>
                    <option value="MANHÃ">Manhã</option>
                    <option value="TARDE">Tarde</option>
                    <option value="NOITE">Noite</option>
                    <option value="INTEGRAL">Integral</option>
                </select>
            </div>

            <button type="submit" class="button2 start-50 translate-middle-x">Cadastrar</button>
            
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>