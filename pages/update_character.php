<?php
$characId = $_GET['characterid'];
$errors = [];

$characterStatement = "SELECT * FROM `played_character` WHERE `character_id` = :character_id;";
$queryCharacter = $connection->prepare($characterStatement);
$queryCharacter->bindValue(':character_id', $characId, PDO::PARAM_INT);
$queryCharacter->execute();
$queryCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$character = $queryCharacter->fetch();

$characterRename = clone $character;

if(!empty($_POST)){
    $characterRename->setName(trim($_POST['name'])) ;
    $errors = $characterRename->validate();

    if (empty($errors)){
        
    }
}


?>
<section class="container">
    <h2 class="text-center my-5">Modifier le nom de <?php echo $character->getName(); ?></h2>
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