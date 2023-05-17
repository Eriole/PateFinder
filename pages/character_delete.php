<?php
$charID = $_GET['characterid'];

combinationCheck($connection, $charID, $_SESSION['user']->getId());

$tableName = 'character_stuff';
deleteChar($tableName, $charID, $connection);
$tableName = 'character_skill';
deleteChar($tableName, $charID, $connection);
$tableName = 'character_statistic';
deleteChar($tableName, $charID, $connection);
$tableName = 'played_character';
deleteChar($tableName, $charID, $connection);

header('location: ?page=characters_list');