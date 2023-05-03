<?php
$character = new Character();
$errors = [];

if (!empty($_POST)) {
    $character = new Character($_POST);
    $errors = $character->validate();
}


var_dump($character);
var_dump($errors);
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
        <label for="initiative">Initiative (max 10):</label>
        <input type="number" name="initiative" value="<?php echo $character->getInitiative(); ?>">
        <?php if (!empty($errors['initiative'])) {
            echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
        } ?>
        <div class="d-flex gap-5 w-75 justify-content-between">
            <div class="my-3 d-flex justify-content-between w-50 align-items-center">
                <label for="pvmax">Points de vie maximum:</label>
                <input type="number" name="pvmax" value="<?php echo $character->getPvmax(); ?>">
                <?php if (!empty($errors['pvmax'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </div>
            <div class="my-3 d-flex justify-content-between w-50 align-items-center">
                <label for="pmmax">Points de magie maximum:</label>
                <input type="number" name="pmmax" value="<?php echo $character->getPmmax(); ?>">
                <?php if (!empty($errors['pmmax'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </div>
        </div>
        <div class="d-flex gap-5 w-75">
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="strength">Force (max 20) </label>
                    <input data-type="stat" type="number" name="strength"
                        value="<?php echo $character->getStrength(); ?>">
                    <?php if (!empty($errors['strength'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="dexterity">Dextérité (max 20) </label>
                    <input data-type="stat" type="number" name="dexterity"
                        value="<?php echo $character->getDexterity(); ?>">
                    <?php if (!empty($errors['dexterity'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="constitution">Constitution (max 20) </label>
                    <input data-type="stat" type="number" name="constitution"
                        value="<?php echo $character->getConstitution(); ?>">
                    <?php if (!empty($errors['constitution'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
            </ul>
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="intelligence">Intelligence (max 20) </label>
                    <input data-type="stat" type="number" name="intelligence"
                        value="<?php echo $character->getIntelligence(); ?>">
                    <?php if (!empty($errors['intelligence'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="wisdom">Sagesse (max 20) </label>
                    <input data-type="stat" type="number" name="wisdom" value="<?php echo $character->getWisdom(); ?>">
                    <?php if (!empty($errors['wisdom'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
                <li class="my-3 d-flex justify-content-between align-items-center">
                    <label for="luck">Chance (max 20) </label>
                    <input data-type="stat" type="number" name="luck" value="<?php echo $character->getLuck(); ?>">
                    <?php if (!empty($errors['luck'])) {
                        echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                    } ?>
                </li>
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