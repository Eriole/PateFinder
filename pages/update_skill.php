<?php
$skillId = $_GET['idskill'];
$characterid = $_GET['characterid'];
$errors = [];

combinationCheck($connection, $characterid, $_SESSION['user']->getId());

$skillstatement = "SELECT * FROM `skill` WHERE `skill_id`= :skill_id";
$querySkill = $connection->prepare($skillstatement);
$querySkill->bindValue(':skill_id', $skillId, PDO::PARAM_INT);
$querySkill->execute();
$querySkill->setFetchMode(PDO::FETCH_CLASS, Skill::class);
$skill = $querySkill->fetch();

if (!empty($_POST)) {
    $skill = new Skill($_POST);
    $errors = $skill->validate();

    if (empty($errors)) {
        // UPDATE Skill
        $updateSkill = "UPDATE `skill` SET `skill_id`= :skill_id ,`skill_name`= :name ,`skill_level`= :level ,`statistic_id`= :statistic_id  
            WHERE skill_id = :skill_id";

        $statementUpdateSkill = $connection->prepare($updateSkill);
        $statementUpdateSkill->bindValue(':skill_id', $skillId, PDO::PARAM_INT);
        $statementUpdateSkill->bindValue(':name', $skill->getName(), PDO::PARAM_STR);
        $statementUpdateSkill->bindValue(':level', $skill->getLevel(), PDO::PARAM_INT);
        $statementUpdateSkill->bindValue(':statistic_id', $skill->getStatId(), PDO::PARAM_INT);
        $statementUpdateSkill->execute();

        header('Location: ?page=character_sheet&characterid=' . $characterid);
    }
}
?>

<section class="container">
    <h2 class="text-center my-5">Modifier une compétence</h2>
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
                            <?php echo $statistic; ?>
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
        <button class="btn btn-success" type="submit">Mettre à jour</button>
    </form>
</section>