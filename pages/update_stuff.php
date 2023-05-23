<?php
$idStuff = $_GET['idstuff'];
$characId = $_GET['characterid'];
$errors = [];

combinationCheck($connection, $characId, $_SESSION['user']->getId());

$selectStuff = "SELECT * FROM stuff WHERE stuff_id = :stuff_id";

$statementSelectStuff = $connection->prepare($selectStuff);
$statementSelectStuff->bindValue(':stuff_id', $idStuff, PDO::PARAM_INT);
$statementSelectStuff->execute();
$statementSelectStuff->setFetchMode(PDO::FETCH_CLASS, Stuff::class);
$stuff = $statementSelectStuff->fetch();



if (!empty($_POST)) {
    $stuff = new Stuff($_POST);
    $errors = $stuff->validate();

    if (empty($errors)) {

        $updateStuff = "UPDATE stuff 
            SET stuff_id=:stuff_id, stuff_name=:name, stuff_dmg=:dmg, stuff_range=:range 
            WHERE stuff_id = :stuff_id";

        $statementUpdateStuff = $connection->prepare($updateStuff);
        $statementUpdateStuff->bindValue(':stuff_id', $idStuff, PDO::PARAM_INT);
        $statementUpdateStuff->bindValue(':name', $stuff->getName(), PDO::PARAM_STR);
        $statementUpdateStuff->bindValue(':dmg', $stuff->getDamage(), PDO::PARAM_INT);
        $statementUpdateStuff->bindValue(':range', $stuff->getRange(), PDO::PARAM_INT);
        $statementUpdateStuff->execute();

        header('location: ?page=character_sheet&characterid=' . $characId);
    }
}

?>
<section class="container">
    <h2 class="text-center my-5">Modifier un équipement</h2>
    <form action="" method="post">
        <ul class="list-unstyled w-50">
            <li class="d-flex justify-content-between align-items-center">
                <label for="name">Nom de l'équipement :</label>
                <input type="text" name="name" class="w-50" value="<?php echo $stuff->getName(); ?>">
                <?php if (!empty($errors['name'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center my-3">
                <label for="damage"> Dégâts de l'équipement :</label>
                <input type="number" name="damage" class="w-50" value="<?php echo $stuff->getDamage(); ?>">
                <?php if (!empty($errors['damage'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center">
                <label for="range"> Portée de l'équipement (0 - 5) :</label>
                <input type="number" name="range" class="w-50" value="<?php echo $stuff->getRange(); ?>">
                <?php if (!empty($errors['range'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
        </ul>
        <button class="btn btn-success" type="submit">Mettre à jour</button>
    </form>
</section>