<?php

$errors = [];
// Account Creation PART:

if (isset($_POST['mailuser'])) {
  $username = trim(($_POST['pseudonyme']));
  $password = trim($_POST['password']);
  $email = ($_POST['mailuser']);
  // $userconnect = [$username, $password,];
  $userinfo = [$email, $username, $password,];


  if (empty($username)) {

    $errors['username'] = true;
  }

  if (!filter_var(value: $email, filter: FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = true;
  }

  if (empty($password)) {
    $errors['password'] = true;
  }
}
?>

<body>

  <section class="row text-center d-flex justify-content-around mt-5">

    <!-- connexion form -->

    <article class="col-5">
      <h2>Me Connecter</h2>

      <div>
        <form action="" method="post" class="d-flex justify-content-center flex-column">
          <div class="form-group mx-5">
            <label for="pseudonyme"></label>
            <input type="text" class="form-control" id="pseudonyme" name="pseudonyme" placeholder="Pseudo">
          </div>

          <div class="form-group mx-5">
            <label for="password"></label>
            <input type="password" class="form-control" id="mdp" name="password" placeholder="Mot de passe">
          </div>
          <small><a href="#">mot de passe oublié ?</a></small>

          <div class="form-check text-center p-3">

            <button type="submit" class="btn btn-primary">SE CONNECTER</button>
          </div>
        </form>
      </div>
    </article>



    <!--  inscription  form -->

    <article class="col-5">
      <h2>Créer un compte</h2>
      <div>

        <form action="" method="post" class="d-flex justify-content-center flex-column">
          <div class="form-group mx-5">
            <label for="pseudonyme"></label>
            <input type="text" class="form-control" id="pseudonyme" name="pseudonyme" placeholder="Pseudo">
            <?php

            if (!empty($errors['username'])) {
              echo '<p class="badge text-bg-danger">vous devez renseignez un pseudo !</p>';
            }
            ?>
          </div>

          <div class="form-group mx-5">
            <label for="mailuser"></label>
            <input type="text" class="form-control" id="mailuser" aria-describedby="emailHelp" name="mailuser"
              placeholder="Votre Adresse Mail">
            <?php
            if (!empty($errors['email'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mail!</p>';
            }
            ?>
          </div>

          <div class="form-group mx-5">
            <label for="password"></label>
            <input type="password" class="form-control" id="mdp" name="password" placeholder="Mot de Passe">

            <?php
            if (!empty($errors['password'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mot de passe !</p>';
            }
            ?>

          </div>
          <div class="form-check text-center p-3">

            <button type="submit" class="btn btn-primary">CRÉER UN COMPTE</button>
          </div>
        </form>
      </div>
    </article>
  </section>

</body>

</html>