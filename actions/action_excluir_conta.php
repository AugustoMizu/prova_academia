<?php
require "../configPDO.php";
session_start();

// Verifica se o ID da conta foi passado e se a confirmação foi feita
if (isset($_GET['id']) && isset($_GET['confirmar']) && $_GET['confirmar'] == 'true') {
    $id_conta = $_GET['id'];
    $tipo_conta = $_GET['tipo']; // Tipo da conta a ser excluída

    try {
        // Verifica o tipo de conta e prepara a consulta de exclusão
        if ($tipo_conta == 'admin') {
            $sql = $pdo->prepare("DELETE FROM administradores WHERE id = :id");
        } elseif ($tipo_conta == 'professor') {
            $sql = $pdo->prepare("DELETE FROM professores WHERE id = :id");
        } elseif ($tipo_conta == 'aluno') {
            $sql = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
        } else {
            echo "erro";
        }

        $sql->bindValue(':id', $id_conta);
        $sql->execute();

        // Redireciona de volta para a página de gerenciamento de contas
        header('Location: ../menu_admin/tabela_editar_usuario.php?status=deletado');
        exit;
    } catch (PDOException $e) {
        // Em caso de erro, redireciona com um status de erro
        echo "Erro ao excluir: " . $e->getMessage();
        header('Location: ../menu_admin/tabela_editar_usuario.php?status=erro');
        exit;
    } catch (Exception $e) {
        // Em caso de erro de tipo
        echo $e->getMessage();
        header('Location: ../menu_admin/tabela_editar_usuario.php?status=erro');
        exit;
    }
} else {
    // Se o ID não foi passado ou a confirmação não foi feita, redireciona com um status de erro
    header('Location: ../menu_admin/tabela_editar_usuario.php?status=erro');
    exit;
}