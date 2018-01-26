<?php
require_once 'app/init.php';

$itemsQuery = $db->prepare("
     SELECT id, tarefa, done
        FROM items
        WHERE user = :user
");

$itemsQuery->execute([
        'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Lista de tarefas</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


    </head>
    <body>
        <div class="list">
            <h1 class="header">Lista de Tarefas</h1>

            <?php if(!empty($items)): ?>
            <ul class="items">
                <?php foreach ($items as $item): ?>
                    <li>
                        <span class="item<?php echo $item['done'] ? ' done ' : '' ?>"><?php echo $item['tarefa']; ?></span>
                        <?php if (!$item['done']): ?>
                            <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Marcar</a>
                        <?php endif;?>
                        <?php if ($item['done']): ?>
                            <a href="mark.php?as=notdone&item=<?php echo $item['id']; ?>" class="done-button">Desmarcar</a>
                        <?php endif;?>
                        <a href="mark.php?as=delete&item=<?php echo $item['id']; ?>" class="done-button">Apagar</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p>Você não tem tarefas.</p>
            <?php endif; ?>

            <form class="item-add" action="add.php" method="post">
                <input type="text" name="name" placeholder="Escreva uma nova tarefa aqui." class="input" autocomplete="off" required>
                <input type="submit" value="Adicionar" class="submit">
            </form>
        </div>
    </body>
</html>




















































