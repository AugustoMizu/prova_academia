<?php
require "../configPDO.php";
session_start();

$dataMinima = date('Y-m-d'); // data minima de nascimento no input é a data de hoje

// Verifica se a sessão não estiver iniciada e redireciona para a página de login
if(!isset($_SESSION['id'])){ 
    session_destroy();
    header('location:../login.php');
    exit;
}

// Usa o id na sessão para buscar o registro do aluno no banco
if ($_SESSION['tipo_login'] == 'aluno') {
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(":id", $_SESSION['id']);
    $sql->execute();
} else if ($_SESSION['tipo_login'] == 'admin') {
    // Se o tipo for admin, pega o id da URL 
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(":id", $_GET['id']);
    $sql->execute();
}

$dados = $sql->fetch(PDO::FETCH_ASSOC); // dados do aluno para preencher o formulário
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
    <title>Atualizar Aluno</title>
</head>

<body id="body-login">
    <form action="../actions/action_edita_aluno.php" method="post" class="container-fluid">
        <div class="container w-50 border border-3 rounded p-4 mt-3 shadow " style="background-color: #E2E3E5;">

            <?php if ($_SESSION['tipo_login'] === 'admin'): ?>
                <p><a href="../menu_admin/tabela_editar_usuario.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">
                    VOLTAR</a></p>
            <?php else: ?>
                <p><a href="../menu_aluno.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">
                    VOLTAR</a></p>
            <?php endif; ?>

            <div class="text-center mb-4 fw-bolder">
                <h2>Atualizar Aluno</h2>
                <h4>Altere somente o necessário</h4>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id_input" value=<?= $dados['id'] ?>>
                <label for="nome-input" class="form-label">Nome</label>
                <input type="text" id="nome_input" name="nome_input" class="form-control" value="<?= $dados['nome'] ?>" required>
            </div>
            <div class="mb-3 d-flex align-items-center ">
                <div class="container">
                    <label for="data_nascimento-input" class="form-label">Data de Nascimento</label>
                    <input type="date" id="data_nascimento_input" name="data_nascimento_input" class="form-control" value=<?= $dados['data_nascimento'] ?> max="<?= $dataMinima ?>" required>
                </div>
                <div class="container">
                    <label for="telefone-input" class="form-label ">Telefone</label>
                    <input type="text" id="telefone_input" name="telefone_input" class="form-control" value="<?= $dados['telefone'] ?>" minlength="13" placeholder="XX XXXXX XXXX" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email-input" class="form-label">E-mail</label>
                <input type="email" id="email_input" name="email_input" class="form-control" value="<?= $dados['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha-input" class="form-label">Senha</label>
                <input type="password" id="senha_input" name="senha_input" class="form-control" placeholder="Digite a nova senha (deixe em branco para não alterar)">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </form>
</body>

</html>