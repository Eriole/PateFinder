<?php
spl_autoload_register(function ($class) {
    require_once "../../classes/$class.php";
});

require_once 'list_statistic.php';
require_once '../../includes/config.inc.php';

//Emptying tables
$connection->exec("SET foreign_key_checks = 0;
    TRUNCATE TABLE statistic;
    TRUNCATE TABLE played_character;
    TRUNCATE TABLE character_statistic;
    SET foreign_key_checks = 1");

//INSERT INTO Table 'statistic'
$insertStatistic = "INSERT INTO statistic (statistic_name, statistic_shortname, statistic_quantity, inSum) 
VALUES (:name, :shortname, :quantity, :inSum)";
$statement = $connection->prepare($insertStatistic);
foreach ($statistics as $statistic) {
    $statement->bindValue(':name', $statistic->getName(), PDO::PARAM_STR);
    $statement->bindValue(':shortname', $statistic->getShortname(), PDO::PARAM_STR);
    $statement->bindValue(':quantity', $statistic->getQuantity(), PDO::PARAM_INT);
    $statement->bindValue(':inSum', $statistic->getInSum(), PDO::PARAM_BOOL);
    $statement->execute();
}