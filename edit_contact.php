<?php
session_start();
require_once 'DatabaseRepository.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$id = $_GET['id'];
$contact = DatabaseRepository::getContactById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    DatabaseRepository::updateContact($id, $nome, $telefone, $email);
    header('Location: list_contacts.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Contato</h1>
    <form action="edit_contact.php?id=<?= $contact['id']; ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required value="<?= htmlspecialchars($contact['nome']); ?>">
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required value="<?= htmlspecialchars($contact['telefone']); ?>">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required value="<?= htmlspecialchars($contact['email']); ?>">
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="list_contacts.php">Voltar para a lista de contatos</a>
</body>
</html>
