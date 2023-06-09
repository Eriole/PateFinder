<?php
$characId = $_GET['characterid'];
$errors = [];

combinationCheck($connection, $characId, $_SESSION['user']->getId());

//SELECT FROM Played_character 
$character = selectCharacter($characId, $connection);

//SELECT FROM Character_statistic
$characterStats = selectCharStatistic($characId, $connection);
$character->setStats($characterStats); 

if (!empty($_POST)) {
    //Generating an array of CharacterStatistic objects 
    foreach ($_POST as $statId => $statValue) {
        $characterStats[$statId] = new CharacterStatistic($characId, $statId, $statValue);
        //AddStat to Character
        $character->addStat($characterStats[$statId]);
    }

    if (empty($errors)){
        //UPDATE Character_Statistic using Character->getStat() array
        foreach ($character->getStats() as $statId => $currentStat) {
            $statValue = $currentStat->getCurrent_statistic();
            updateCharStatistic($characId, $statId, $statValue, $connection);
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
        <button class="btn btn-success" type="submit">Mettre à jour</button>
    </form>
</section>