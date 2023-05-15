<?php
$characId = $_GET['characterid'];
$errors = [];

//SELECT FROM played_character
$characterStatement = "SELECT * FROM `played_character` WHERE `character_id` = :character_id;";
$queryCharacter = $connection->prepare($characterStatement);
$queryCharacter->bindValue(':character_id', $characId, PDO::PARAM_INT);
$queryCharacter->execute();
//Creation of an object $character based on Character class
$queryCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$character = $queryCharacter->fetch();

//Clone object $character to differenciate old and new object
$characterRename = clone $character;

if (!empty($_POST)) {
    $characterRename->setName(trim($_POST['name']));
    $errors = $characterRename->validate();

    //Check only on erros['name]
    if (empty($errors['name'])) {
        //UPDATE played_character with new name
        $updateName = "UPDATE `played_character` SET `character_name`= :character_name WHERE `character_id` = :character_id";
        $statementUpdateName = $connection->prepare($updateName);
        $statementUpdateName->bindValue(':character_id', $characId, PDO::PARAM_INT);
        $statementUpdateName->bindValue(':character_name', $characterRename->getName(), PDO::PARAM_STR);
        $statementUpdateName->execute();

        header('Location: ?page=character_sheet&characterid=' . $characId);
    }
}


?>
<section class="container">
    <h2 class="text-center my-5">Modifier le nom de
        <?php echo $character->getName(); ?>
    </h2>
    <form class="my-5" action="" method="post">
        <fieldset class="mb-3">
            <legend>Nouveau nom du personnage</legend>
            <input type="text" name="name" placeholder="Nom" value="<?php echo $characterRename->getName(); ?>">
            <?php if (!empty($errors['name'])) {
                echo '<p class="badge text-bg-danger m-0">Renseignez un nom</p>';
            } ?>
        </fieldset>
        <button class="btn btn-success" type="submit">Modifier</button>
</section>