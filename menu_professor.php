<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" type="imagex/x-icon" href="imagens/icon.png">
    <!--google fonts-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>configurações</title>
</head>

<body id="body-login">
    <header>

    </header>
    <main class="container-fluid">
        <div class="config-container container w-50 border border-3 rounded p-5 shadow position-absolute top-50 start-50 translate-middle bg-secondary-subtle">
            <label for="" style="font-size: xx-large; font-family: 'Times New Roman', Times, serif;"><strong>Configuração da
                    Conta</strong></label>
            <span class="material-symbols-outlined">
                settings
            </span>
            <div class="config-options text-black">
                <div class="option">
                    <a href="editar_professor.php"><label for="perfil">Editar Dados Pessoais</label> </a>                   
                </div>
                <div class="option">
                    <label for="inventario">Gerenciar Horário</label>
                    <div class="submenu border border-3 rounded p-4 shadow">
                        <h2>Gerenciar Inventário</h2>
                        <ul>
                            <a href="tabela_horario.php" class="text-black link-underline link-underline-opacity-0"><li>Remover/Editar Horário</li></a>
                            <a href="criar_horario.php" class="text-black link-underline link-underline-opacity-0"><li>Adicionar Horário</li></a>
                        </ul>
                    </div>
                </div>
                <div class="option">
                    <label for="suporte">Financeiro</label>
                    <div class="submenu border border-3 rounded p-4 shadow">
                        <h2>Financeiro</h2>
                        <ul>
                        <a href="tabela_pagamento.php" class="text-black link-underline link-underline-opacity-0"><li>Visualizar Folha de Pagamento</li></a>
                        <a href="tabela_pagamento_print.php" class="text-black link-underline link-underline-opacity-0"><li>Imprimir Folha de Pagamento</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>