<?php
$skill = new Skill();
$errors = [];
$charId = intval($_GET['characterid']);

combinationCheck($connection, $charId, $_SESSION['user']->getId());

if (!empty($_POST)) {
    $skill = new Skill($_POST);
    $errors = $skill->validate();

    if (empty($errors)) {
        // INSERT INTO Skill
        $insertSkill = "INSERT INTO skill (skill_name, skill_level, statistic_id) 
        VALUES (:name, :level, :statistic_id)";

        $statementInsertSkill = $connection->prepare($insertSkill);
        $statementInsertSkill->bindValue(':name', $skill->getName(), PDO::PARAM_STR);
        $statementInsertSkill->bindValue(':level', $skill->getLevel(), PDO::PARAM_INT);
        $statementInsertSkill->bindValue(':statistic_id', $skill->getStatId(), PDO::PARAM_INT);
        $statementInsertSkill->execute();
        $idSkill = $connection->lastInsertId();

        // INSERT INTO character_skill
        $insertCharSkill = "INSERT INTO character_skill (character_id, skill_id) 
                VALUES (:character_id, :skill_id)";

        $statementInsertCharSkill = $connection->prepare($insertCharSkill);
        $statementInsertCharSkill->bindValue(':character_id', $charId, PDO::PARAM_INT);
        $statementInsertCharSkill->bindValue(':skill_id', $idSkill, PDO::PARAM_INT);
        $statementInsertCharSkill->execute();

        // heading to Character Sheet
        header('Location: ?page=character_sheet&characterid=' . $charId);
    }
}

?>

<section class="container">
    <h2 class="text-center my-5">Ajouter une compétence</h2>
    <form action="" method="post">
        <ul class="list-unstyled w-50">
            <li class="d-flex justify-content-between align-items-center">
                <label for="name">Nom de la compétence :</label>
                <input type="text" name="name" class="w-50" value="<?php echo $skill->getName(); ?>">
                <?php if (!empty($errors['name'])) {
                    echo '<p class="badge text-bg-danger m-0">Renseignez un nom</p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center my-3">
                <label for="stat">Caractéristique associée :</label>
                <select name="stat" class="w-50">
                    <option value="">--</option>
                    <?php foreach ($statisticList as $key => $statistic) { ?>
                        <option value="<?php echo $key ?>">
                            <?php echo $statistic ?>
                        </option>
                    <?php } ?>
                </select>
                <?php if (!empty($errors['stat'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
            <li class="d-flex justify-content-between align-items-center">
                <label for="level">Niveau de la compétence (0 - 5) :</label>
                <input type="number" name="level" class="w-50" value="<?php echo $skill->getLevel(); ?>">
                <?php if (!empty($errors['level'])) {
                    echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
                } ?>
            </li>
        </ul>
        <button class="btn btn-success" type="submit">Ajouter</button>
    </form>
</section>