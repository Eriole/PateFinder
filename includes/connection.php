<?php
$pseudonymeCorrect = 'ID';
$passwordCorrect = 'toto';
$errors = [];

if (isset($_POST['pseudonyme'])) {
    $pseudonyme = ($_POST['pseudonyme']);
    $password = ($_POST['password']);

    if (empty($pseudonyme)) {
        $errors['pseudonyme'] = 'ID non remplie';

    } elseif ($pseudonyme != $pseudonymeCorrect) {
        $errors['pseudonyme'] = 'ID incorrect!';
    }
    if (empty($password)) {
        $errors['password'] = 'Password non remplie';

    } elseif ($password != $passwordCorrect) {
        $errors['password'] = 'Mot de passe incorrect!';
    }

    if (empty($errors)) {
        $_SESSION['pseudonyme'] = $_POST['pseudonyme'];

        header('location: ?login=success');
    }
}
?>
<!-- // var_dump($_POST); -->
<form action="" method="post">
    <section class="col-12 text-center d-flex justify-content-around mt-5">

        <!-- formulaire de connexion -->

        <div class="col-5">
            <h2>Me Connecter</h2>

            <div class="bg-forms ">
                <form action="" method="post" class="d-flex justify-content-center flex-column">
                    <div class="form-group mx-5">
                        <label for="pseudonyme"></label>
                        <input type="text" class="form-control" id="pseudonyme" name="pseudonyme" placeholder="Pseudo">
                        <?php
                        if (!empty($errors['pseudonyme'])) {
                            echo '<p class="badge text-bg-danger">' . $errors['pseudonyme'] . '</p>';
                        }
                        ?>
                    </div>
                    <div class="form-group mx-5">
                        <label for="password"></label>
                        <input type="password" class="form-control" id="mdp" name="password" placeholder="Mot de passe">
                        <?php
                        if (!empty($errors['password'])) {
                            echo '<p class="badge text-bg-danger">' . $errors['password'] . '</p>';
                        }
                        ?>
                    </div>
                    <div class="form-check text-center p-3">
                        <button type="submit" class="btn btn-primary">SE CONNECTER</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- formulaire inscription  -->

        <div class="col-5">
            <h2>Créer un compte</h2>

            <div class="bg-forms ">
                <form action="" method="post" class="d-flex justify-content-center flex-column">
                    <div class="form-group mx-5">
                        <label for="pseudonyme"></label>
                        <input type="text" class="form-control" id="pseudonyme" name="pseudonyme" placeholder="Pseudo">
                    </div>

                    <form action="" method="post">
                        <div class="form-group mx-5">
                            <label for="mailuser"></label>
                            <input type="email" class="form-control" id="mailuser" aria-describedby="emailHelp"
                                name="mailuser" placeholder="Votre Adresse Mail ">
                        </div>

                        <div class="form-group mx-5">
                            <label for="password"></label>
                            <input type="password" class="form-control" id="mdp" name="password"
                                placeholder="Mot de Passe">
                        </div>
                        <div class="form-check text-center p-3">

                            <button type="submit" class="btn btn-primary">CRÉER UN COMPTE</button>
                        </div>
                    </form>
            </div>
        </div>
    </section>
</form>