<?php
$skill = new Skill();
var_dump($skill);
if (!empty($_POST)) {
    $skill = new Skill($_POST);
    var_dump($skill);
}


?>

<form action="" method="post">
    <ul class="list-unstyled">
        <li>
            <label for="name">Nom de la compétence :</label>
            <input type="text" name="name">
        </li>
        <li>
            <label for="stat">Caractéristique associée :</label>
            <input type="text" name="stat">
        </li>
        <li>
            <label for="level">Niveau de la compétence (0 - 5) :</label>
            <input type="number" name="level">
        </li>
    </ul>
    <button class="btn btn-success" type="submit">Ajouter</button>
</form>