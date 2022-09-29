<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 Задание</title>
</head>
<body>
    <img src="banner.php"/>
    <?php 
        $views = $db->query("SELECT SUM(`views`) FROM `visitors`")->fetchColumn();
        $count = $db->query("SELECT COUNT(DISTINCT `views`) FROM `visitors`")->fetchColumn();
    ?>
    <p>Просмотров: <?= $views; ?></p>
    <p>Кол-во уникальных пользователей: <?= $count; ?></p>
</body>
</html>