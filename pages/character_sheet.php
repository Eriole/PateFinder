<?php
$characId = $_GET['characterid'];
$errors = [];

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
$selectStat = "SELECT character_statistic.statistic_id, current_statistic, statistic_shortname FROM character_statistic 
    LEFT JOIN statistic ON character_statistic.statistic_id = statistic.statistic_id 
    WHERE character_id= :charact_id";
$queryStat = $connection->prepare($selectStat);
$queryStat->bindValue(':charact_id', $characId, PDO::PARAM_INT);
$queryStat->execute();
$characStat = $queryStat->fetchAll();
$currentCharact = (new CharacterComposer())->compose($currentCharact, $characStat);

//UPDATE PV and PM
if (!empty($_POST)) {
    $currentCharact->setPmcur($_POST['pmcur']);
    $currentCharact->setPvcur($_POST['pvcur']);

    $errors = $currentCharact->validate(isCreate: false);

    if (empty($errors)) {
        $updatePVPM = "UPDATE character_statistic 
        SET current_statistic = :currentStat 
        WHERE statistic_id = (SELECT statistic_id FROM statistic WHERE statistic_shortname = :shortname) 
        AND character_id = :charact_id ";
        $statementUpdatePVPM = $connection->prepare($updatePVPM);
        $statementUpdatePVPM->bindValue(':charact_id', $characId, PDO::PARAM_INT);
        $statementUpdatePVPM->bindValue(':shortname', 'PVact', PDO::PARAM_STR);
        $statementUpdatePVPM->bindValue(':currentStat', $currentCharact->getPvcur(), PDO::PARAM_INT);
        $statementUpdatePVPM->execute();
        $statementUpdatePVPM->bindValue(':shortname', 'PMact', PDO::PARAM_STR);
        $statementUpdatePVPM->bindValue(':currentStat', $currentCharact->getPmcur(), PDO::PARAM_INT);
        $statementUpdatePVPM->execute();
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
            <a href="?page=update_statistics&characterid=<?= $currentCharact->getId(); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
        </div>

        <!-- Display Stats -->
        <form class="bg-gray px-3 py-5 rounded" method="POST" action="">
            <p class="mb-4">
                <span class="p-2 dark-gray rounded me-3">
                    <?php echo $currentCharact->getInitiative(); ?>
                </span>
                Initiative (INIT)
            </p>

            <!-- Display PV and PM -->
            <div class="d-flex justify-content-between align-items-center">
                <ul class="list-unstyled">
                    <li>
                        <p>
                            <span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getPvmax(); ?>
                            </span>
                            Points de vie max
                        </p>
                    </li>
                    <li>
                        <p>Points de vie actuels </p>
                        <div class="current">
                            <input type="number" min="0" max="<?php echo $currentCharact->getPvmax(); ?>" name="pvcur"
                                class="p-2 dark-gray rounded"
                                value="<?php echo $currentCharact->getPvcur(); ?>"></input>
                            <?php if (!empty($errors['pvcur'])) {
                                echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                            } ?>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled">
                    <li>
                        <p>
                            <span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getPmmax(); ?>
                            </span>
                            Points de magie max
                        </p>
                    </li>
                    <li class="">
                        <p>Points de magie actuels </p>
                        <div class="current">
                            <input type="number" min="0" max="<?php echo $currentCharact->getPmmax(); ?>" name="pmcur"
                                class="p-2 dark-gray rounded"
                                value="<?php echo $currentCharact->getPmcur(); ?>"></input>
                            <?php if (!empty($errors['pmcur'])) {
                                echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                            } ?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mb-2 row justify-content-center">
                <input type="submit" class="col-1 btn btn-light" value="OK">
            </div>
            <!-- Display stats -->
            <div class="d-flex justify-content-around mx-auto align-items-center w-75 bg-light-gray p-3 rounded ">
                <ul class="list-unstyled my-0">
                    <li>
                        <p>
                            <span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getStrength(); ?>
                            </span>
                            FOR
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getDexterity(); ?>
                            </span>
                            DEX
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getConstitution(); ?>
                            </span>
                            CONST
                        </p>
                    </li>
                </ul>
                <ul class="list-unstyled my-0">
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getInitiative(); ?>
                            </span> INT </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getWisdom(); ?>
                            </span> SAG </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">
                                <?php echo $currentCharact->getLuck(); ?>
                            </span> CHA </p>
                    </li>
                </ul>
            </div>
        </form>
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