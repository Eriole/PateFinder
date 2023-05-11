<?php
include_once 'variables.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>
        <?php if (isset($pageTitle)) {
            echo $pageTitle;
        } ?> PATEFINDER
    </title>
    <script src="https://kit.fontawesome.com/ed398f5d99.js" crossorigin="anonymous"></script>
    <title>PâteFinder</title>
</head>

<body>
    <header>
        <div>
            <h1>PâteFinder</h1>
            <p>Gérez vos fiches de personnages pour vos parties de Jeu de Rôle !</p>
        </div>
    </header>
    <?php if (!empty($_SESSION)) {
        echo '
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?page=characters-list">Mes personnages</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="?page=new_character">Créer une fiche</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Commencer une partie</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mon compte
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="?page=logout">Déconnexion</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    ';
    } ?>

<<<<<<< HEAD
    <?php
    //Primary Alert New Character created successfully
    if (!empty($_GET['create']) && $_GET['create'] == true) {
        echo '<div class="alert alert-primary d-flex align-items-center" role="alert">Personnage créé</div>';
    }
    //Warning Alert Logout successful
    if (!empty($_GET['disconnected']) && $_GET['disconnected'] == true) {
        echo '<div class="alert alert-warning d-flex align-items-center" role="alert" >Vous êtes déconnecté</div>';
    }

    if (!empty($_GET['addStuff']) && $_GET['addStuff'] == true) {
        echo '<div class="alert alert-primary d-flex align-items-center" role="alert" >Equipement ajouté</div>';
    }

    if (!empty($_GET['updateStuff']) && $_GET['updateStuff'] == true) {
        echo '<div class="alert alert-primary d-flex align-items-center" role="alert" >Equipement modifié</div>';
    }
    ?>
=======
<?php
//Primary Alert New Character created successfully
if(!empty($_GET['create']) && $_GET['create'] == true) {
    echo '<div class="alert alert-primary d-flex align-items-center" role="alert">Personnage créé</div>';
}
//Warning Alert Logout successful
if (!empty($_GET['disconnected']) && $_GET['disconnected'] == true) {
    echo '<div class="alert alert-warning d-flex align-items-center" role="alert" >Vous êtes déconnecté</div>';
};

if (!empty($_GET['updateskill']) && $_GET['updateskill'] == true) {
    echo '<div class="alert alert-primary d-flex align-items-center"role="alert" >Compétences modifier </div>';
};


?>
>>>>>>> 8590b59 (F9)
