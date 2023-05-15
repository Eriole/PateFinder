<?php
$player = new Player();
$registration = new Player();
$errors = [];
$connexionErrors = [];

// Log in :
if (isset($_POST['connection'])) {
  $player = new Player($_POST);
  $connexionErrors = $player->validate(isCreate: false);

  //Check if Username is set in Database
  $checkUsername = "SELECT * FROM player WHERE player_username LIKE :username";
  $queryUsername = $connection->prepare($checkUsername);
  $queryUsername->bindValue(':username', $player->getUsername(), PDO::PARAM_STR);
  //PDO create an object $dataBaseUsername based on Player class
  $queryUsername->setFetchMode(PDO::FETCH_CLASS, Player::class);
  $queryUsername->execute();
  $dataBaseUsername = $queryUsername->fetch();

  if (empty($dataBaseUsername)) {
    $connexionErrors['usernameUnknown'] = true;
  } elseif (!password_verify($player->getPassword(), $dataBaseUsername->getPassword())) {
    $connexionErrors['passwordWrong'] = true;
  }

  //If everything is ok open session and head to Dashboard
  if (empty($connexionErrors)) {
    $_SESSION['user'] = $dataBaseUsername;

    // @TODO Heading to User Dashboard
    header('location: ?page=characters_list&login=true');
  }
}

// Sign in:
if (isset($_POST['registration'])) {
  $registration = new Player($_POST);
  $errors = $registration->validate(isCreate: true);

  //Check if Username is set in Database
  $checkUsername = "SELECT * FROM player WHERE player_username LIKE :username";
  $statmentCheckUsername = $connection->prepare($checkUsername);
  $statmentCheckUsername->bindValue(':username', $registration->getUsername(), PDO::PARAM_STR);
  $statmentCheckUsername->execute();
  $resultCheckUsername = $statmentCheckUsername->fetchAll();

  if (!empty($resultCheckUsername)) {
    $errors['usernameTaken'] = true;
  }

  //Check if Email is set in Database
  $checkEmail = "SELECT * FROM player WHERE player_mail LIKE :email";
  $statmentCheckEmail = $connection->prepare($checkEmail);
  $statmentCheckEmail->bindValue(':email', $registration->getMail(), PDO::PARAM_STR);
  $statmentCheckEmail->execute();
  $resultCheckEmail = $statmentCheckEmail->fetchAll();

  if (!empty($resultCheckEmail)) {
    $errors['emailTaken'] = true;
  }

  //If everything is ok Insert into Database
  if (empty($errors)) {
    // INSERT INTO Player
    $insertPlayer = "INSERT INTO player(player_username, player_mail, player_password) 
    VALUES (:username, :mail, :password )";
    $password = password_hash($registration->getPassword(), PASSWORD_DEFAULT);
    $statmentInsertPlay = $connection->prepare($insertPlayer);
    $statmentInsertPlay->bindValue(':username', $registration->getUsername(), PDO::PARAM_STR);
    $statmentInsertPlay->bindValue(':mail', $registration->getMail(), PDO::PARAM_STR);
    $statmentInsertPlay->bindValue(':password', $password, PDO::PARAM_STR);
    $statmentInsertPlay->execute();
    $registration->setId($connection->lastInsertId());
    //Opening Session with new username
    $registration->setPassword($password);

    //Heading after Sign in
    header('location: ?signin=true');
  }
}
?>

<div class="container">
  <section class="row mt-5">


    <!-- connexion form -->

    <article class="col-5 text-center">
      <h2>Me Connecter</h2>
      <form action="" method="post" class="">
        <ul class="list-unstyled">
          <li class="text-start mt-3">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" placeholder="Pseudo"
              value="<?php echo $player->getUsername(); ?>">
            <?php
            if (!empty($connexionErrors['username'])) {
              echo '<p class="badge text-bg-danger">Renseignez un pseudo</p>';
            } elseif (!empty($connexionErrors['usernameUnknown'])) {
              echo '<p class="badge text-bg-danger">Utilisateur inconnu</p>';
            }
            ?>
          </li>
          <li class="text-start mt-3">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" placeholder="Mot de passe">
            <?php
            if (!empty($connexionErrors['password'])) {
              echo '<p class="badge m-0"><i class="fa-solid fa-triangle-exclamation fa-lg text-danger"></i></p>';
            } elseif (!empty($connexionErrors['passwordWrong'])) {
              echo '<p class="badge text-bg-danger">Mot de passe invalide</p>';
            }

            ?>
          </li>
          <small><a href="#">Mot de passe oublié ?</a></small>
        </ul>
        <button type="submit" class="btn btn-primary" href="?page=" name="connection">SE CONNECTER</button>
      </form>
    </article>

    <!-- registration  form -->

    <article class="col-5 offset-2 text-center">
      <h2>Créer un compte</h2>
      <form action="" method="post" class="">
        <ul class="list-unstyled">
          <li class="text-start mt-3">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" placeholder="Pseudo"
              value="<?php echo $registration->getUsername(); ?>">
            <?php
            if (!empty($errors['username'])) {
              echo '<p class="badge text-bg-danger">Renseignez un pseudo</p>';
            }
            if (!empty($errors['usernameTaken'])) {
              echo '<p class="badge text-bg-danger">Pseudo déjà pris</p>';
            }
            ?>
          </li>
          <li class="text-start mt-3">
            <label for="email">Adresse e-mail :</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" name="email"
              placeholder="Votre adresse mail" value="<?php echo $registration->getMail(); ?>">
            <?php
            if (!empty($errors['email'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mail</p>';
            }
            if (!empty($errors['emailTaken'])) {
              echo '<p class="badge text-bg-danger">Un compte avec cette adresse existe déjà</p>';
            }
            ?>
          </li>
          <li class="text-start mt-3">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" placeholder="Mot de passe">
            <?php
            if (!empty($errors['password'])) {
              echo '<p class="badge text-bg-danger">Renseignez un mot de passe</p>';
            }
            ?>
          </li>
        </ul>
        <button type="submit" class="btn btn-primary" name="registration">CRÉER UN COMPTE</button>
      </form>
    </article>

  </section>
</div>