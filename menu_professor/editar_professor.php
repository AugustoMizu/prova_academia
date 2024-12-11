<?php
require "../configPDO.php";
$dataMinima = date('Y-m-d');
$teste = 2;
$sql = $pdo->prepare("SELECT * FROM professores WHERE id = :id");
$sql->bindValue(":id", $teste);
$sql->execute();

$dados = $sql->fetch(PDO::FETCH_ASSOC);
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
    <title>Atualizar de Professor</title>
</head>

<body id="body-login">
    <form action="../actions/action_editar_professor.php" method="post" class="container-fluid">
        <div class="container w-50 border border-3 rounded p-4 mt-3 shadow " style="background-color: #E2E3E5;">
            <h2 class="text-center mb-4 fw-bolder">Atualizar de Professor</h2>
            <div class="mb-3">
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" id="nome_input" name="nome_input" class="form-control"  value = <?= $dados['nome']?> >
            </div>
            <div class="mb-3 d-flex align-items-center ">
                <div class="container">
                    <label for="data_nascimento-input" class="form-label">Data de Nascimento</label>
                    <input type="date" id="data_nascimento_input" name="data_nascimento_input" class="form-control"  value= <?= $dados['data_nascimento']?> max="<?= $dataMinima ?>" required>
                </div>
                <div class="container">
                    <label for="telefone-input" class="form-label">Telefone</label>
                    <input type="text" id="telefone_input" name="telefone_input" class="form-control" value=<?= $dados['telefone'] ?> minlength="13"
                        placeholder="XX XXXXX XXXX" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email-input" class="form-label">E-mail</label>
                <input type="email" id="email_input" name="email_input" class="form-control" value=<?= $dados['email']?> required>
            </div>
            <div class="mb-3">
                <label for="especialidade-input" class="form-label">Especialidade</label>
                <input type="text" id="especialidade_input" name="especialidade_input" class="form-control" value=<?= $dados['especialidade'] ?> required>
            </div>
            <div class="mb-3 d-flex align-items-center">
                <div class="container">
                    <label for="salario-input" class="form-label">Salário</label>
                    <input type="text" step="0.01" id="salario_input" name="salario_input" class="form-control"  value=<?= $dados['salario']?> required>
                </div>
                <div class="container">
                    <label for="data_admissao-input" class="form-label">Data de Admissão</label>
                    <input type="date" id="data_admissao_input" name="data_admissao_input" class="form-control" value=<?= $dados['data_admissao']?> required>
                </div>
            </div>
            <button type="submit" class="button2  start-50 translate-middle-x"> Salvar</button>
        </div>
    </form>
    <script>
        function formatarTelefone(telefone) {
            telefone = telefone.replace(/\D/g, '');

            if (telefone.length <= 2) {
                return `${telefone}`;
            } else if (telefone.length <= 7) {
                return `${telefone.slice(0, 2)} ${telefone.slice(2)}`;
            } else {
                return `${telefone.slice(0, 2)} ${telefone.slice(2, 7)} ${telefone.slice(7, 11)}`;
            }
        }
        document.getElementById('telefone_input').addEventListener('input', function() {
            this.value = formatarTelefone(this.value);
        });
    </script>
    <script>
        function limitaSalario(salario) {

            salario = salario.replace(/[^0-9]/g, '');

            if (salario === '') {
                return '';
            }
            let valor = parseFloat(salario) / 100;
            let valorFormatado = valor.toFixed(2).toString().replace('.', ',');

            if (valorFormatado.length > 10) {
                return valorFormatado.slice(0, 10);
            }
            return valorFormatado;
        }
        document.getElementById('salario_input').addEventListener('input', function() {
            this.value = limitaSalario(this.value);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>