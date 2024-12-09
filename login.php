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
  <form action="" method="post" class="container-fluid">
    <div class="container w-50 border border-3 rounded p-4 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle" style="background-color: #f8f9fa;">
      <h2 class="text-center mb-4">Login</h2>
      <div class="mb-3">
        <label for="email-input" class="form-label">E-mail</label>
        <input type="email" id="email-input" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password-input" class="form-label">Senha</label>
        <input type="password" id="password-input" name="password" class="form-control" required>
      </div>
      <button type="submit" class="button2  start-50 translate-middle-x">Entrar</button>
      <p><a href="cadastro_aluno.php" class="link-success link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover">não possui conta? Cadastre-se aqui!</a></p>
    </div>
  </form>
  <script>
    window.addEventListener('load', function() {
      const confirmacao = confirm("Não há uma conta de Administrador cadastrada, deseja cadastrar uma? 	＼(>o<)ノ");
      if (confirmacao) {
        // Redireciona para o script de cadastro de admin
        window.location.href = 'cadastro_admin.php?status=true';
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>