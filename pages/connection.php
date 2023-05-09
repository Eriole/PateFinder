<?php
$player = new Player();
$errors = [];
$connexionErrors = [];

// Log in :
/*
$usernameCorrect = 'ID';
$passwordCorrect = 'toto';

if (isset($_POST['username'])) {
  $player = new Player($_POST);
  $connexionErrors = $player->validate();
  $username = ($_POST['username']);
  $password = ($_POST['password']);

  if (empty($username)) {
    $errors['username'] = 'ID non remplie';
    } elseif ($pseudonyme != $pseudonymeCorrect) {
        $errors['pseudonyme'] = 'ID incorrect!';
    }
    if (empty($password)) {
        $errors['passwordConnection'] = 'Password non remplie';

    } elseif ($password != $passwordCorrect) {
        $errors['passwordConnection'] = 'Mot de passe incorrect!';
    }

  } elseif ($username != $usernameCorrect) {
    $errors['username'] = 'ID incorrect!';
  }
  if (empty($password)) {
    $errors['password'] = 'Password non remplie';

  } elseif ($password != $passwordCorrect) {
    $errors['password'] = 'Mot de passe incorrect!';
  }

  if (empty($errors)) {
    $_SESSION['username'] = $_POST['username'];

    header('location: ?login=success');
  }
*/

// Sign in:

if (isset($_POST['email'])) {
  $player = new Player($_POST);
  $errors = $player->validate(isCreate: true);

  //Check if Username is set in Database
  $checkUsername = "SELECT * FROM player WHERE player_username LIKE :username";
  $statmentCheckUsername = $connection->prepare($checkUsername);
  $statmentCheckUsername->bindValue(':username', $player->getUsername(), PDO::PARAM_STR);
  $statmentCheckUsername->execute();
  $resultCheckUsername = $statmentCheckUsername->fetchAll();

  if(!empty($resultCheckUsername)){
    $errors['usernametaken'] = true;
  }

  //Check if Email is set in Database
  $checkEmail = "SELECT * FROM player WHERE player_mail LIKE :email";
  $statmentCheckEmail = $connection->prepare($checkEmail);
  $statmentCheckEmail->bindValue(':email', $player->getMail(), PDO::PARAM_STR);
  $statmentCheckEmail->execute();
  $resultCheckEmail = $statmentCheckEmail->fetchAll();

  if(!empty($resultCheckEmail)){
    $errors['emailtaken'] = true;
  }

  //If everything is ok Insert into Database
  if (empty($errors)) {
    // INSERT INTO Player
    $insertPlayer = "INSERT INTO player(player_username, player_mail, player_password) 
    VALUES (:username, :mail, :password )";

    $statmentInsertPlay = $connection->prepare($insertPlayer);
    $statmentInsertPlay->bindValue(':username', $player->getUsername(), PDO::PARAM_STR);
    $statmentInsertPlay->bindValue(':mail', $player->getMail(), PDO::PARAM_STR);
    $statmentInsertPlay->bindValue(':password', $player->getPassword(), PDO::PARAM_STR);
    $statmentInsertPlay->execute();

    // @TODO Heading after Sign in
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
            <label for="username"></label>
            <input type="text" class="form-control" name="username" placeholder="Pseudo">
            <?php
            if (!empty($errors['username'])) {
              echo '<p class="badge text-bg-danger">' . $errors['username'] . '</p>';
            }
            ?>
          </div>

          <div class="form-group mx-5">
            <label for="password"></label>
            <input type="password" class="form-control" name="password" placeholder="Mot de passe">
            <?php
            if (!empty($errors['password'])) {
              echo '<p class="badge text-bg-danger">' . $errors['password'] . '</p>';
            }
            ?>
          </div>
          <small><a href="#">Mot de passe oublié ?</a></small>

          <div class="form-check text-center p-3">

            <button type="submit" class="btn btn-primary" href="?page=">SE CONNECTER</button>
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
            <label for="username"></label>
            <input type="text" class="form-control" name="username" placeholder="Pseudo" value="<?php echo $player->getUsername(); ?>">
            <?php
            if (!empty($errors['username'])) {
              echo '<p class="badge text-bg-danger">Renseignez un pseudo</p>';
            }
            if (!empty($errors['usernametaken'])) {
              echo '<p class="badge text-bg-danger">Pseudo déjà pris</p>';
            }
            ?>
          </div>

          <div class="form-group mx-5">
            <label for="email"></label>
            <input type="email" class="form-control" aria-describedby="emailHelp" name="email"
              placeholder="Votre Adresse Mail" value="<?php echo $player->getMail(); ?>">
            <?php
            if (!empty($errors['email'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mail</p>';
            }
            if (!empty($errors['emailtaken'])) {
              echo '<p class="badge text-bg-danger">Un compte avec cette adresse existe déjà</p>';
            }
            ?>
          </div>

          <div class="form-group mx-5">
            <label for="password"></label>
            <input type="password" class="form-control" name="password" placeholder="Mot de Passe">
            <?php
            if (!empty($errors['password'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mot de passe</p>';
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