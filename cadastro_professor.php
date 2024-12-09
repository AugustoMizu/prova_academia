<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-jpg" href="imagens/icon.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Professor</title>
</head>

<body id="body-login">
    <form action="actions/action_cadastra_professor.php" method="post" class="container-fluid">
        <div class="container w-50 border border-3 rounded p-4 shadow position-absolute top-50 start-50 translate-middle" style="background-color: #f8f9fa;">
            <h2 class="text-center mb-4">Cadastro de Professor</h2>
            <div class="mb-3">
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" id="nome_input" name="nome_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="data_nascimento-input" class="form-label">Data de Nascimento</label>
                <input type="date" id="data_nascimento_input" name="data_nascimento_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefone-input" class="form-label">Telefone</label>
                <input type="text" id="telefone_input" name="telefone_input" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email-input" class="form-label">E-mail</label>
                <input type="email" id="email_input" name="email_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="senha-input" class="form-label">Senha</label>
                <input type="password" id="senha_input" name="senha_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="especialidade-input" class="form-label">Especialidade</label>
                <input type="text" id="especialidade_input" name="especialidade_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="salario-input" class="form-label">Salário</label>
                <input type="number" step="0.01" id="salario_input" name="salario_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="data_admissao-input" class="form-label">Data de Admissão</label>
                <input type="date" id="data_admissao_input" name="data_admissao_input" class="form-control" required>
            </div>
            <button type="submit" class="button2  start-50 translate-middle-x">Cadastrar</button>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>