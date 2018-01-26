<?php

require_once 'app/init.php';

if(isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if (!empty($name)) {
        $addedQuery = $db->prepare("
            INSERT INTO items (tarefa, user, done, created)
            VALUES (:tarefa, :user, 0, NOW())
        ");

        $addedQuery->execute([
           'tarefa' => $name,
            'user' => $_SESSION['user_id']

        ]);
    }
}
header('Location: index.php');
