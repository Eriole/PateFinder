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
    <?php 
    if (!empty($_SESSION)) {
        echo '
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?page=characters_list">Mes personnages</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="?page=new_character">Créer une fiche</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mon compte
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=logout">Déconnexion</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    ';
    }

    //Primary Alert New Character created successfully
    if (!empty($_GET['create']) && $_GET['create'] == true) {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">Personnage créé
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    //Warning Alert Logout successful
    if (!empty($_GET['disconnected']) && $_GET['disconnected'] == true) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Vous êtes déconnecté
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    //Success Alert Sign In successful
    if (!empty($_GET['signin']) && $_GET['signin'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Compte crée avec succès. Vous pouvez vous connecter
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    //Success Alert Login successful
    if (!empty($_GET['login']) && $_GET['login'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Connexion réussie
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>