<?php
session_start();
require_once 'DatabaseRepository.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$id = $_GET['id'];
DatabaseRepository::deleteContact($id);
header('Location: list_contacts.php');
exit;
?>
