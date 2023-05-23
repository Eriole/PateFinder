<?php
$characId = $_GET['characterid'];
$errors = [];
//SELECT FROM Played_character 
$character = selectCharacter($characId, $connection);

//SELECT FROM Character_statistic
$characterStats = selectStatistic($characId, $connection);
$character -> setStats($characterStats); 

if (!empty($_POST)) {
    //Generating an array of CharacterStatistic objects 
    foreach ($_POST as $statId => $statValue) {
        $characterStats[$statId] = new CharacterStatistic($characId, $statId, $statValue);
        $character->addStat($characterStats[$statId]);
    }

    if (empty($errors)){
        //UPDATE Character_Statistic using array $characterStatistics
        foreach ($character->getStats() as $statId => $currentStat) {
        $updateCharacterStatistic = "UPDATE `character_statistic` 
            SET `current_statistic`= :current_stat
            WHERE `character_id` = :character_id AND `statistic_id` = :stat_id;";
        $statementUpdateCharStat = $connection->prepare($updateCharacterStatistic);
        $statementUpdateCharStat->bindValue(':character_id', $currentStat->getCharacter_id(), PDO::PARAM_INT);
        $statementUpdateCharStat->bindValue(':stat_id', $currentStat->getStatistic_id(), PDO::PARAM_INT);
        $statementUpdateCharStat->bindValue(':current_stat', $currentStat->getCurrent_statistic(), PDO::PARAM_INT);
        $statementUpdateCharStat->execute();
        }

        header('Location: ?page=character_sheet&characterid=' . $characId);
    }
}

?>

<section class="container">
    <h2 class="text-center my-5">Modifier les caractéristiques de
        <?php echo $character->getName(); ?>
    </h2>
    <form class="my-5" action="" method="post">
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
                            <input type="number" min="0" max="<?= $stat->getQuantity(); ?>" name="<?= $stat->getId(); ?>"
                                value="<?php
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
        </fieldset>
        <button class="btn btn-success" type="submit">Modifier</button>
    </form>
</section>