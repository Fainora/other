<?php

$sql = "SELECT `name`, COUNT(`books`.`id`) AS `count`
FROM `books`, `book_authors` AS ba
WHERE `books`.`id` = `ba`.`book_id`
GROUP BY `books`.`id`
HAVING `count` = 3";

