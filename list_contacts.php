<?php
session_start();
require_once 'DatabaseRepository.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$contacts = DatabaseRepository::getAllContacts();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Lista de Contatos</h1>
    <a href="add_contact.php">Adicionar Novo Contato</a>
    <a href="logout.php">Sair</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= htmlspecialchars($contact['nome']); ?></td>
                    <td><?= htmlspecialchars($contact['telefone']); ?></td>
                    <td><?= htmlspecialchars($contact['email']); ?></td>
                    <td>
                        <a href="edit_contact.php?id=<?= $contact['id']; ?>">Editar</a>
                        <a href="delete_contact.php?id=<?= $contact['id']; ?>" 
                            onclick="return confirm('Tem certeza que deseja deletar este contato?');">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
