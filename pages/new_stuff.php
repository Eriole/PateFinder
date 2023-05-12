<?php
$stuff = new Stuff();
$errors = [];

if (!empty($_POST)) {
    $stuff = new Stuff($_POST);
    $errors = $stuff->validate();

    if (empty($errors)) {
        $insertStuff = "INSERT INTO `stuff`(stuff_name, stuff_dmg, stuff_range) 
        VALUES (:name, :damage, :range)";

        $statementInsertStuff = $connection->prepare($insertStuff);
        $statementInsertStuff->bindValue(':name', $stuff->getName(), PDO::PARAM_STR);
        $statementInsertStuff->bindValue(':damage', $stuff->getDamage(), PDO::PARAM_INT);
        $statementInsertStuff->bindValue(':range', $stuff->getRange(), PDO::PARAM_INT);
        $statementInsertStuff->execute();

        $idStuff = $connection->lastInsertId();

        // INSERT INTO character_stuff
        $insertCharSkill = "INSERT INTO character_stuff (character_id, stuff_id) 
                VALUES (:character_id, :stuff_id)";

        //Missing character_id info
        $charId = $_GET['characterid'];

        $statementInsertCharSkill = $connection->prepare($insertCharSkill);
        $statementInsertCharSkill->bindValue(':character_id', $charId, PDO::PARAM_INT);
        $statementInsertCharSkill->bindValue(':stuff_id', $idStuff, PDO::PARAM_INT);
        $statementInsertCharSkill->execute();

        header('Location: ?page=character_sheet&characterid='.$charId );
    }
}

?>
<section class="container">
    <h2 class="text-center my-5">Ajouter un équipement</h2>
    <form action="" method="post">
        <ul class="list-unstyled w-50">
            <li class="d-flex justify-content-between align-items-center">
                <label for="name">Nom de l'équipement :</label>
                <input type="text" name="name" class="w-50" value="<?php echo $stuff->getName() ?>">
                <?php if (!empty($errors['name'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center my-3">
                <label for="damage"> Dégâts de l'équipement :</label>
                <input type="number" name="damage" class="w-50" value="<?php echo $stuff->getDamage() ?>">
                <?php if (!empty($errors['damage'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center">
                <label for="range"> Portée de l'équipement (0 - 5) :</label>
                <input type="number" name="range" class="w-50" value="<?php echo $stuff->getRange() ?>">
                <?php if (!empty($errors['range'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
        </ul>
        <button class="btn btn-success" type="submit">Ajouter</button>
    </form>
</section>