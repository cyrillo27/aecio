<?php
session_start();
require_once 'DatabaseRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = DatabaseRepository::getUserByUsername($username);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Armazena o ID do usuário na sessão
        header('Location: list_contacts.php');
        exit;
    } else {
        $error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
    <a href="registro.php">Ainda não tem uma conta? Registre-se</a>
</body>
</html>
