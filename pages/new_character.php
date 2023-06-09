<?php
$playerId = $_SESSION['user']->getId();
$character = new Character($_POST);
$errors = [];

//Creation Character
if (!empty($_POST)) {
    $errors = $character->validate($statsById, true);
    if (empty($errors)) {

        //INSERT INTO Played_Character
        $insertCharacter = "INSERT INTO played_character (character_name, player_id) VALUES (:name, :player_id)";
        $statementInsertChar = $connection->prepare($insertCharacter);
        $statementInsertChar->bindValue(':player_id', $playerId, PDO::PARAM_INT);
        $statementInsertChar->bindValue(':name', $character->getName(), PDO::PARAM_STR);
        $statementInsertChar->execute();
        $idCharacter = $connection->lastInsertId();

        $characterStats = $character->getStats();

        foreach ($characterStats as $key => $characterStatistic) {
            //INSERT INTO Character_Statistic using array $characterStatistics
            $insertCharacterStatistic = "INSERT INTO character_statistic (character_id, statistic_id, current_statistic) 
                VALUES (:id, :stat_id, :current_stat)";
            $statementInsertCharStat = $connection->prepare($insertCharacterStatistic);
            $statementInsertCharStat->bindValue(':id', $idCharacter, PDO::PARAM_INT);
            $statementInsertCharStat->bindValue(':stat_id', $characterStatistic->getStatistic_id(), PDO::PARAM_INT);
            $statementInsertCharStat->bindValue(':current_stat', $characterStatistic->getCurrent_statistic(), PDO::PARAM_INT);
            $statementInsertCharStat->execute();
        }

        //heading to player dashboard
        header('Location: ?page=characters_list&create=true');
    }
}

?>
<form class="container my-5" action="" method="post">
    <fieldset>
        <legend>Nom du personnage</legend>
        <input type="text" name="name" placeholder="Nom" value="<?php echo $character->getName(); ?>">
        <?php if (!empty($errors['name'])) {
            echo '<p class="badge text-bg-danger m-0">Renseignez un nom</p>';
        } ?>
    </fieldset>
    <fieldset class="my-4">
        <legend>Caractéristiques</legend>
        <div class="d-flex gap-5 w-75">
            <ul class="list-unstyled w-50">
                <!-- Use of $statistics array to generate input -->
                <?php foreach ($statistics as $key => $stat) {
                    ?>
                    <li class="my-3 d-flex justify-content-between align-items-center">
                        <label for="stat_<?= $stat->getId(); ?>">
                            <?= $stat->getName(); ?> (max <?= $stat->getQuantity(); ?>):
                        </label>
                        <input <?php if ($stat->getInSum()) { ?>data-stat<?php } ?> type="number" min="0"
                            max="<?= $stat->getQuantity(); ?>" name="stats[<?= $stat->getId(); ?>]" value="<?php
                                $currentStat = $character->getStatById($stat->getId());
                                if ($currentStat) {
                                    echo $currentStat->getCurrent_statistic();
                                }
                                ?>">
                        <?php
                        if (!empty($errors['stat_' . $stat->getId()])) {
                            echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                        } ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <p class="fw-light text-center">FOR + DEX + CONST + INT + SAG + CHA entre 60 et 80 pts. <span id="count"></span>
            <?php if (!empty($errors['stat'])) {
                echo '</br><span class="badge text-bg-danger">Vous ne respectez pas les conditions</span>';
            } ?>
        </p>

    </fieldset>
    <button class="btn btn-success" type="submit">Créer</button>
</form>
<script src="script/main.js"></script>