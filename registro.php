<?php
require_once 'DatabaseRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (DatabaseRepository::getUserByUsername($username)) {
        $error = "Este nome de usuário já está em uso. Por favor, escolha outro.";
    } else {
        DatabaseRepository::insertUser($username, $password);
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registrar</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>
    <form action="registro.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
    <a href="login.php">Já tem uma conta? Faça login</a>
</body>
</html>
