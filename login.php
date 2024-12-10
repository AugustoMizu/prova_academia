<?php
require "configPDO.php";
session_start();
session_destroy();

$status = isset($_GET['status']) ? $_GET['status'] : null;

// ver se já há um cadastro de admin 
$sql = $pdo->query("SELECT COUNT(*) FROM administradores");
$sql->execute();
$adminExiste = $sql->fetchColumn();

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
  <title>Login</title>
</head>

<body id="body-login">
  <form action="actions/action_login.php" method="post" class="container-fluid">
    <div class="container w-50 border border-3 rounded p-4 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle" style="background-color: #f8f9fa;">
      <h2 class="text-center mb-4 fw-bolder">Login</h2>

      <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Usuário</label>
        <select id="tipo" name="tipo" class="form-select" required>
          <option value="" disabled selected>Selecione o tipo de usuário</option>
          <option value="aluno">Aluno</option>
          <option value="professor">Professor</option>
          <option value="admin">Administrador</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="email_input" class="form-label">E-mail</label>
        <input type="email" id="email_input" name="email_input" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password_input" class="form-label">Senha</label>
        <input type="password" id="password_input" name="password_input" class="form-control" required>
      </div>
      <button type="submit" class="button2 start-50 translate-middle-x">Entrar</button>
      <p><a href="cadastro_aluno.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">não possui conta? Cadastre-se aqui!</a></p>
    </div>
  </form>
  <script>
    // cadastrar admin caso não exista
    window.addEventListener('load', function() {
      var adminExiste = <?= $adminExiste; ?>;
      if (adminExiste == 0) {
        const confirmacao = confirm("Não há uma conta de Administrador cadastrada, deseja cadastrar uma?        ＼(>o<)ノ");
        if (confirmacao) {
          // Redireciona para o script de cadastro de admin
          window.location.href = 'cadastro_admin.php?status=cadastrar';
        }
      }
    });
  </script>
  <script>
    window.addEventListener('load', function() {
      var status = <?= $status ?>;

      if (status == false) {
        alert("E-mail ou senha incorretos!      ＼(>o<)ノ");
        <?php $status = null?>;
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>