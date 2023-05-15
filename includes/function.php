<?php
//ATTENTION ! IT'S A DELETE QUERY !
function deleteChar($tableName, $charaID, $connection)
{
    $queryDelete = "DELETE FROM $tableName WHERE character_id = :charact_id ";
    $statementDeleteCharacter = $connection->prepare($queryDelete);
    $statementDeleteCharacter->bindValue(':charact_id', $charaID, PDO::PARAM_INT);
    $statementDeleteCharacter->execute();
}