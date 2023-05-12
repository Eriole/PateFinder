<?php
$username = $_SESSION['user']->getUsername();
$idPlayer = $_SESSION['user']->getId();
//SELECT FROM played_Character
$selectCharacter = "SELECT * FROM played_character WHERE player_id = :id";

$queryCharacter = $connection->prepare($selectCharacter);
$queryCharacter->bindValue(':id', $idPlayer, PDO::PARAM_INT);

//PDO create an array $characters based on Character class
$queryCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$queryCharacter->execute();
$characters = $queryCharacter->fetchAll();
?>

<section class="container my-5">

    <div class=" d-flex justify-content-between">
        <h3>Bonjour
            <?= $username ?>
        </h3>
        <a class="btn btn-primary" href="?page=new_character">Créer une fiche</a>
    </div>

    <table class="table text-center mt-5 table-striped">
        <thead>
            <tr>
                <th scope="col">Nom du personnage</th>
                <th scope="col">Voir</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($characters as $character) { ?>
                <tr>
                    <td>
                        <?php echo $character->getName(); ?>
                    </td>
                    <td>
                        <a href="?page=character_sheet&characterid=<?php echo $character->getId(); ?>"
                            class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </td>
                    <td>
                        <a href="?page=edit_character&characterid=<?php echo $character->getId(); ?>"
                            class="btn btn-Succes">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="">
                        <a href="?page=remove_character&characterid=<?php echo $character->getId(); ?>"
                            class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
            } ?>

        </tbody>
    </table>

</section>