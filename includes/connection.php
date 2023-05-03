<?php
$pseudonymeCorrect = 'ID';
$passwordCorrect = 'toto';
$erreur = [];

if (isset($_POST['pseudonyme'])) {
    $pseudonyme = ($_POST['pseudonyme']);
    $password = ($_POST['password']);

    if (empty($pseudonyme)) {
        $erreur[] = 'ID non remplie';

    } elseif ($pseudonyme != $pseudonymeCorrect) {
        $erreur[] = 'ID incorrect!';
    }
    if (empty($password)) {
        $erreur[] = 'Password non remplie';

    } elseif ($password != $passwordCorrect) {
        $erreur[] = 'Mot de passe incorrect!';
    }


    if (empty($erreur)) {
        $_SESSION['pseudonyme'] = $_POST['pseudonyme'];

        header('location: ?login=success');
    }
}
?>
<?php
foreach ($erreur as $erreur) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?= $erreur; ?>
    </div>
    <?php
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
                    </div>

                    <div class="form-group mx-5">
                        <label for="password"></label>
                        <input type="password" class="form-control" id="mdp" name="password" placeholder="Mot de passe">
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