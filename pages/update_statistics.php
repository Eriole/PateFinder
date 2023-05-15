<?php
$characId = $_GET['characterid'];
$errors=[];

//SELECT FROM Played_Character
$character = selectCharacter($characId, $connection);

//SELECT FROM Character_statistic
selectStatistic($characId, $character, $connection);

if (!empty($_POST)){
    $character->update($_POST);
    $errors = $character->validate($isCreate = false);

    if (empty($errors)){
        //Creation of an Array with CharacterComposer decompose function based on $statistics (in variables.php) and $character
        $characterStatistics = (new CharacterComposer)->decompose($character, $statistics);

        //UPDATE Character_Statistic using array $characterStatistics
        foreach ($characterStatistics as $statId => $currentStat) {
        $updateCharacterStatistic = "UPDATE `character_statistic` 
            SET `current_statistic`= :current_stat
            WHERE `character_id` = :character_id AND `statistic_id` = :stat_id;";
        $statementUpdateCharStat = $connection->prepare($updateCharacterStatistic);
        $statementUpdateCharStat->bindValue(':character_id', $characId, PDO::PARAM_INT);
        $statementUpdateCharStat->bindValue(':stat_id', $statId, PDO::PARAM_INT);
        $statementUpdateCharStat->bindValue(':current_stat', $currentStat, PDO::PARAM_INT);
        $statementUpdateCharStat->execute();
        }

        header('Location: ?page=character_sheet&characterid=' . $characId);
    }
}

?>

<section class= "container">
    <h2 class="text-center my-5">Modifier les caractéristiques de <?php echo $character->getName(); ?></h2>
    <form class="my-5" action="" method="post">
        <fieldset class="my-4">
        <legend>Caractéristiques</legend>
        <label for="initiative">Initiative (max 10):</label>
        <input type="number" min="0" max="10" name="initiative" value="<?php echo $character->getInitiative(); ?>">
        <?php if (!empty($errors['initiative'])) {
            echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
        } ?>
        <div class="d-flex gap-5 w-75 justify-content-between">
            <div class="my-3 d-flex justify-content-between w-50 align-items-center">
                <label for="pvmax">Points de vie maximum (max 250):</label>
                <input type="number" min="0" max="250" name="pvmax" value="<?php echo $character->getPvmax(); ?>">
                <?php if (!empty($errors['pvmax'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </div>
            <div class="my-3 d-flex justify-content-between w-50 align-items-center">
                <label for="pmmax">Points de magie maximum (max 250):</label>
                <input type="number" min="0" max="250" name="pmmax" value="<?php echo $character->getPmmax(); ?>">
                <?php if (!empty($errors['pmmax'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </div>
        </div>
        <div class="d-flex gap-5 w-75">
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="strength">Force (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="strength"
                    value="<?php echo $character->getStrength(); ?>">
                    <?php if (!empty($errors['strength'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="dexterity">Dextérité (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="dexterity"
                        value="<?php echo $character->getDexterity(); ?>">
                    <?php if (!empty($errors['dexterity'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="constitution">Constitution (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="constitution"
                    value="<?php echo $character->getConstitution(); ?>">
                    <?php if (!empty($errors['constitution'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
            </ul>
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="intelligence">Intelligence (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="intelligence"
                        value="<?php echo $character->getIntelligence(); ?>">
                    <?php if (!empty($errors['intelligence'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="wisdom">Sagesse (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="wisdom" 
                    value="<?php echo $character->getWisdom(); ?>">
                    <?php if (!empty($errors['wisdom'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="luck">Chance (max 20) </label>
                    <input data-type="stat" type="number" min="0" max="20" name="luck" 
                    value="<?php echo $character->getLuck(); ?>">
                    <?php if (!empty($errors['luck'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
            </ul>
        </div>
        </fieldset>
        <button class="btn btn-success" type="submit">Modifier</button>
    </form>
</section>
