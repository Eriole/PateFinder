<?php
$characId = 5;

//SELECT FROM Played_Character
$selectCharac = "SELECT character_id, character_name, player_id FROM played_character
    WHERE character_id = :charact_id";
$queryCharac = $connection->prepare($selectCharac);
$queryCharac->bindValue(':charact_id', $characId, PDO::PARAM_INT);
//PDO create an object $currentCharact based on Character class
$queryCharac ->setFetchMode(PDO::FETCH_CLASS, Character::class);
$queryCharac ->execute();
$currentCharact = $queryCharac->fetch();

//SELECT FROM Character_Statistic
$selectStat = "SELECT character_statistic.statistic_id, current_statistic, statistic_shortname FROM character_statistic 
    LEFT JOIN statistic ON character_statistic.statistic_id = statistic.statistic_id 
    WHERE character_id= :charact_id";
$queryStat = $connection->prepare($selectStat);
$queryStat->bindValue(':charact_id', $characId, PDO::PARAM_INT);
//PDO create an array $characSkill based on Skill class
// $queryStat->setFetchMode(PDO::FETCH_CLASS, Skill::class);
$queryStat->execute();
$characStat = $queryStat->fetchAll();
$currentCharact  = (new CharacterComposer())->compose($currentCharact, $characStat);

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

var_dump($currentCharact, $characStat, $characSkill, $characStuff, $statisticList);

?>

<div class="container d-flex flex-column align-items-center my-5 gap-5">
    <div class="w-75">
        <div class="d-flex justify-content-around align-items-center">
            <h2>Nom personnage</h2>
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <hr class="mx-auto w-75">
    </div>

    <!-- Statistics -->
    <section class="w-50">
        <!-- Title -->
        <div class="d-flex justify-content-around align-items-center gap-3">
            <h3>Caractéristiques</h3>
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <!-- Display -->
        <div class="bg-gray px-3 py-5 rounded">
            <p class="mb-4"><span class="p-2 dark-gray rounded me-3">12</span> Initiative (INIT) </p>

            <div class="d-flex justify-content-between align-items-center">
                <ul class="list-unstyled my-0">
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> Points de vie max </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> Points de vie actuels </p>
                    </li>
                </ul>
                <ul class="list-unstyled">
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> Points de magie max </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> Points de magie actuels </p>
                    </li>
                </ul>
            </div>

            <div class="d-flex justify-content-around mx-auto align-items-center w-50 bg-light-gray p-3 rounded ">
                <ul class="list-unstyled my-0">
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> FOR </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> DEX </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> CONST </p>
                    </li>
                </ul>
                <ul class="list-unstyled my-0">
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> INT </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> SAG </p>
                    </li>
                    <li>
                        <p><span class="p-2 dark-gray rounded me-3">12</span> CHA </p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Skill and Stuff -->
    <section class="w-75 d-flex justify-content-around gap-3">
        <!-- Skill -->
        <article class="w-50">
            <h3 class="text-center">Compétences</h3>
            <div class="bg-gray px-2 py-4 rounded">
                <p class="text-end"><i class="fa-solid fa-plus"></i></p>
                <!-- Display -->
                <table class="table table-striped">
                    <tr>
                        <th>Nom</th>
                        <th class="text-center">Caractéristique</th>
                        <th class="text-center">Niveau (0-5)</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Voleur à la sauvette</td>
                        <td class="text-center">DEX</td>
                        <td class="text-center">2</td>
                        <td class="text-end"><i class="fa-solid fa-pen-to-square"></i></td>
                    </tr>
                    <tr>
                        <td>Voleur à la sauvette</td>
                        <td class="text-center">DEX</td>
                        <td class="text-center">2</td>
                        <td class="text-end"><i class="fa-solid fa-pen-to-square"></i></td>
                    </tr>
                </table>
            </div>
        </article>
        <!-- Stuff -->
        <article class="w-50">
            <h3 class="text-center">Equipement</h3>
            <div class="bg-gray px-2 py-4 rounded">
                <p class="text-end"><i class="fa-solid fa-plus"></i></p>
                <!-- Display -->
                <table class="table table-striped">
                    <tr>
                        <th>Nom</th>
                        <th>Dégâts</th>
                        <th>Niveau (0-5)</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Sandales destructrices</td>
                        <td class="text-center">18</td>
                        <td class="text-center">2</td>
                        <td class="text-end"><i class="fa-solid fa-pen-to-square"></i></td>
                    </tr>
                    <tr>
                        <td>Voleur à la sauvette</td>
                        <td class="text-center">18</td>
                        <td class="text-center">2</td>
                        <td class="text-end"><i class="fa-solid fa-pen-to-square"></i></td>
                    </tr>
                </table>
            </div>
        </article>
    </section>
</div>