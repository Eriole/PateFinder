<?php
//SELECT FROM Statistic
$queryStat = $connection->prepare("SELECT * FROM statistic");
//PDO create an array $statistics based on Statistic class
$queryStat->setFetchMode(PDO::FETCH_CLASS, Statistic::class);
$queryStat->execute();
$statistics = $queryStat->fetchAll();

$statisticList = [];

foreach ($statistics as $key => $statistic) {
    $statisticList[$statistic->getId()] = $statistic->getName();
}