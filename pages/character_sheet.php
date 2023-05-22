<?php
$characId = $_GET['characterid'];
$errors = [];
$inSumStats = [];
$editableStats = [];
$regularStats = [];

combinationCheck($connection, $charID, $_SESSION['user']->getId());


//SELECT FROM Played_Character
$selectCharac = "SELECT * FROM played_character
    WHERE character_id = :charact_id";
$queryCharac = $connection->prepare($selectCharac);
$queryCharac->bindValue(':charact_id', $characId, PDO::PARAM_INT);
//PDO create an object $currentCharact based on Character class
$queryCharac->setFetchMode(PDO::FETCH_CLASS, Character::class);
$queryCharac->execute();
$currentCharact = $queryCharac->fetch();

//SELECT FROM Character_Statistic
$selectStat = "SELECT * FROM character_statistic 
    WHERE character_id= :charact_id";
$queryStat = $connection->prepare($selectStat);
$queryStat->bindValue(':charact_id', $characId, PDO::PARAM_INT);
$queryStat->setFetchMode(PDO::FETCH_CLASS, CharacterStatistic::class);
$queryStat->execute();
$characStat = $queryStat->fetchAll();

foreach ($characStat as $key => $characterStatistic) {
    $statId = $characterStatistic->getStatistic_id();
    // array_push($regularStats, $statId);
    if ($statsById[$statId]->getInSum() == true) {
        $inSumStats[$statId] = $characterStatistic;
    } elseif ($statsById[$statId]->getEditable() == true) {
        $editableStats[$statId] = $characterStatistic;
    } else {
        $regularStats[$statId] = $characterStatistic;
    }
}

//UPDATE PV and PM
if (!empty($_POST)) {
    foreach ($_POST as $statId => $statValue) {
        $editableStats[$statId]->setCurrent_statistic($statValue);
        if (!$editableStats[$statId]->validate($statsById[$statId])) {
            $errors[$statId] = true;
        }
    }

    if (empty($errors)) {
        foreach ($editableStats as $key => $characterStatistic) {
            $updatePVPM = "UPDATE `character_statistic` SET `current_statistic`=:current_statistic 
                WHERE statistic_id = :statistic_id
                AND character_id = :character_id";
            $statementUpdatePVPM = $connection->prepare($updatePVPM);
            $statementUpdatePVPM->bindValue(':current_statistic', $characterStatistic->getCurrent_statistic(), PDO::PARAM_INT);
            $statementUpdatePVPM->bindValue(':character_id', $characId, PDO::PARAM_INT);
            $statementUpdatePVPM->bindValue(':statistic_id', $characterStatistic->getStatistic_id(), PDO::PARAM_INT);
            $statementUpdatePVPM->execute();
        }
    }
}

//SELECT FROM Character_Skill
$selectSkill = "SELECT character_skill.skill_id, skill_name, skill_level, statistic_id FROM character_skill
    LEFT JOIN skill ON character_skill.skill_id = skill.skill_id
    WHERE character_skill.character_id = :charact_id";
$querySkill = $connection->prepare($selectSkill);
$querySkill->bindValue(':charact_id', $characId, PDO::PARAM_INT);
//PDO create an array $characSkill based on Skill class
$querySkill->setFetchMode(PDO::FETCH_CLASS, Skill::class);
$querySkill->execute();
$characSkill = $querySkill->fetchAll();

//SELECT FROM Character_Stuff
$selectStuff = "SELECT character_stuff.stuff_id, stuff_name, stuff_dmg, stuff_range FROM character_stuff
    LEFT JOIN stuff ON character_stuff.stuff_id = stuff.stuff_id
    WHERE character_stuff.character_id = :charact_id";
$queryStuff = $connection->prepare($selectStuff);
$queryStuff->bindValue(':charact_id', $characId, PDO::PARAM_INT);
//PDO create an array $characSkill based on Stuff class
$queryStuff->setFetchMode(PDO::FETCH_CLASS, Stuff::class);
$queryStuff->execute();
$characStuff = $queryStuff->fetchAll();

?>

<div class="container d-flex flex-column justify-content-center align-items-center my-5 gap-5">
    <!-- Character Name -->
    <div class="w-75">
        <div class="d-flex justify-content-around align-items-center">
            <h2>
                <?php echo $currentCharact->getName(); ?>
            </h2>
            <a href="?page=update_character&characterid=<?= $currentCharact->getId(); ?>"><i
                    class="fa-solid fa-pen-to-square"></i></a>
        </div>
        <hr class="mx-auto w-75">
    </div>

    <!-- Statistics -->
    <section class="w-50">

        <!-- Title -->
        <div class="d-flex justify-content-around align-items-center gap-3">
            <h3>Caractéristiques</h3>
            <a href="?page=update_statistics&characterid=<?= $currentCharact->getId(); ?>"><i
                    class="fa-solid fa-pen-to-square"></i></a>
        </div>

        <!-- Display regularStats -->
        <div class="bg-gray px-3 py-5 rounded">
            <?php foreach ($regularStats as $statId => $regularStat) {
                echo '<p class="mb-4"> <span class="p-2 dark-gray rounded me-3">'
                    . $regularStat->getCurrent_statistic() .
                    '</span>'
                    . $statsById[$statId]->getName() .
                    '</p>';
            } ?>

            <!-- Display editableStat -->
            <form action="" method="post" class="my-3">
                <ul class="bg-gray px-3 rounded d-flex list-unstyled justify-content-between align-items-center">
                    <?php foreach ($editableStats as $statId => $editableStat) {

                        echo '<li class="text-center"> '
                            . $statsById[$statId]->getName() .
                            '<input type="number" name="' . $statId . '" min="0" max="' . $statsById[$statId]->getQuantity() . '" class="p-2 dark-gray rounded mt-1" value="' . $editableStat->getCurrent_statistic() . '" ></li>';
                        if (!empty($errors[$statId])) {
                            echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                        }
                    } ?>
                </ul>
                <div class="mb-2 row justify-content-center">
                    <button type="submit" class="btn btn-light col-1">Ok</button>
                </div>
            </form>

            <!-- Display inSumStats -->
            <div class="d-flex flex-wrap mx-auto w-75 bg-light-gray p-3 rounded">
                <?php foreach ($inSumStats as $statId => $inSumStat) {
                    echo '<p class="my-3 w-50"> <span class="p-2 dark-gray rounded me-3">'
                        . $inSumStat->getCurrent_statistic() .
                        '</span>'
                        . $statsById[$statId]->getShortname() .
                        '</p>';
                } ?>
            </div>
        </div>
    </section>

    <!-- Skill and Stuff -->
    <section class="w-75 d-flex justify-content-around gap-3">
        <!-- Skill -->
        <article class="w-50 ">
            <h3 class="text-center">Compétences</h3>
            <div class="bg-gray px-2 py-4 rounded">
                <p class="text-end"><a href="?page=new_skill&characterid=<?php echo $characId; ?>"><i
                            class="fa-solid fa-plus"></i></p></a>
                <!-- Display -->
                <table class="table table-striped ">
                    <tr>
                        <th>Nom</th>
                        <th class="text-center">Stat</th>
                        <th class="text-center">Niveau (0-5)</th>
                        <th></th>
                    </tr>
                    <?php foreach ($characSkill as $key => $skill) { ?>
                        <tr>
                            <td>
                                <?php echo $skill->getName(); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $statisticShortnameList[$skill->getStatId()]; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $skill->getLevel(); ?>
                            </td>
                            <td class="text-end">
                                <a
                                    href="?page=update_skill&characterid=<?php echo $characId; ?>&idskill=<?php echo $skill->getSkillId(); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </article>

        <!-- Stuff -->
        <article class="w-50 align-content-stretch">
            <h3 class="text-center">Équipement</h3>
            <div class="bg-gray px-2 py-4 rounded">
                <p class="text-end"><a href="?page=new_stuff&characterid=<?php echo $characId; ?>"><i
                            class="fa-solid fa-plus"></i></p></a>
                <!-- Display -->
                <table class="table table-striped">
                    <tr>
                        <th>Nom</th>
                        <th class="text-center">Dégâts</th>
                        <th class="text-center">Portée (0-5)</th>
                        <th></th>
                    </tr>
                    <?php foreach ($characStuff as $key => $stuff) { ?>
                        <tr>
                            <td>
                                <?php echo $stuff->getName(); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $stuff->getDamage(); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $stuff->getRange(); ?>
                            </td>
                            <td class="text-end">
                                <a
                                    href="?page=update_stuff&characterid=<?php echo $characId; ?>&idstuff=<?php echo $stuff->getStuffId(); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </article>
    </section>
    <div class="text-center">
        <p>Personnage créé le :
            <?php echo $currentCharact->getCreationDate(); ?>
        </p>
        <a href="?page=character_delete&characterid=<?= $characId ?>"
            onclick="return confirm('Valider la suppression?')" class="btn btn-danger">Supprimer</a>
    </div>
</div>