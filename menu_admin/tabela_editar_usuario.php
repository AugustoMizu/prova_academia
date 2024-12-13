<?php
require "../configPDO.php";

session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    header('Location: ../login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Consulta para buscar os registros de professores e alunos
$sql = $pdo->prepare("
    SELECT 'professor' AS tipo, p.id, p.nome, p.email FROM professores p
    UNION ALL
    SELECT 'aluno' AS tipo, a.id, a.nome, a.email FROM alunos a
");
$sql->execute();
$registros = $sql->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Tabela de Registros</title>
</head>

<body id="body-login">
    <main class="container-fluid">
        <section class="config-container container w-75 border border-3 rounded p-5 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle">
            <p><a href="../menu_admin.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">
                    VOLTAR</a></p>
            <h1 class="text-center">Tabela de Registros</h1>
            <table class="table table-bordered table-striped table-hover table-responsive text-center">
                <thead>
                    <tr class="table-dark">
                        <th>Tipo</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="table-danger" colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?= ucfirst($registro['tipo']); ?></td>
                            <td><?= $registro['id']; ?></td>
                            <td><?= $registro['nome']; ?></td>
                            <td><?= $registro['email']; ?></td>
                            <td><a href="../menu_professor/editar_professor.php?id=<?= $registro['id']; ?>&tipo=<?= $registro['tipo'] ?>">Editar</a></td>
                            <td><a href="#" onclick='confirmarExclusao(<?= $registro["id"] ?>, "<?= $registro["tipo"] ?>")'>Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        function confirmarExclusao(id, tipo) {
            const confirmacao = confirm("Você tem certeza que deseja excluir este registro?");
            if (confirmacao) {
                // Redireciona para o script de exclusão com confirmação
                window.location.href = `../actions/action_excluir_conta.php?id=${id}&tipo=${tipo}&confirmar=true`;
            }
        }
    </script>
     <script>
    window.addEventListener('load', function() {
      var status = <?= json_encode($status) ?>;

      if (status === 'deletado') {
        alert("Conta deletada com sucesso!      (^_^.)");
      }
    });
  </script>
</body>

</html>