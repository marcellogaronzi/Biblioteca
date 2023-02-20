<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca</title>

  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/register.css" />

  <script src="js/global.js" defer></script>
</head>

<body>
  <div class="background"></div>

  <div class="content">
    <a href="./index.php">
      <button class="home-button"></button>
    </a>

    <span class="logo"></span>

    <div class="main-content">
      <?php
      // Import
      require_once("backend/users_service.php");

      // Init error control array
      $inputs = ["firstName", "lastName", "fiscalCode", "birthDate", "address", "phone", "email", "username", "password", "confirmPassword"];
      $errors = array_fill_keys($inputs, false);
      $error = false;
      $display_form = true;

      if (isset($_POST["submit"])) {
        // Get input
        $firstName = trim($_POST["firstName"]);
        $lastName = trim($_POST["lastName"]);
        $fiscalCode = strtoupper($_POST["fiscalCode"]);
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"] ?? null;
        $phone = $_POST["phone"] ?? null;
        $email = $_POST["email"] ?? null;
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        // Validate input
        if (!preg_match("/^(?=.{1,64}$)[A-Z][a-z'-]*( [A-Z][a-z'-]*)*$/", $lastName))
          $errors["lastName"] = "Il cognome può contenere solo lettere, numeri o <i>spazio</i> e deve essere di lunghezza compresa tra 1 e 64 caratteri";
        if (!preg_match("/^(?=.{1,64}$)[A-Z][a-z'-]*( [A-Z][a-z'-]*)*$/", $firstName))
          $errors["firstName"] = "Il nome può contenere solo lettere, numeri o <i>spazio</i> e deve essere di lunghezza compresa tra 1 e 64 caratteri";
        if (!preg_match("/^[A-Z0-9]{16}$/", $fiscalCode))
          $errors["fiscalCode"] = "Il codice fiscale deve essere lungo 16 caratteri";
        if (strtotime($birthDate) > strtotime(date("Y-m-d")))
          $errors["birthDate"] = "La data di nascita non pò essere una data futura";
        if (strlen($address) > 64 || !preg_match("/^[a-zA-Zòàùèì' ]{1,64}, \d+, \d{5} [a-zA-Zòàùèì' ]{1,64}$/", $address))
          $errors["address"] = "L'indirizzo deve essere nella forma: [via], [numero civico], [cap] [comune]";
        if (!preg_match("/^\d{10}$/", $phone))
          $errors["phone"] = "Il numero di telefono deve essere composto di soli numeri e composto di 10 cifre";
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))
          $errors["email"] = "Il nome può contenere solo lettere, numeri o '_'";
        if (!preg_match("/^[a-zA-Z0-9_]{1,64}$/", $username))
          $errors["username"] = "Il nome può contenere solo lettere, numeri o '_' e deve essere di lunghezza compresa tra 1 e 64 caratteri";
        if (UsersService::get_by_username($username)) {
          $errors["username"] = "Username già in uso";
        }
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
          $errors["password"] = "La password deve contenere almeno 1 lettera minuscola, 1 maiuscola, 1 numero, 1 simbolo tra '@$!%*?&' ed essere di lunghezza superiore a 8 caratteri";
        } else if ($password !== $confirmPassword) {
          $errors["confirmPassword"] = "Le password non corrispondono";
          $errors["password"] = "Le password non corrispondono";
        }

        $error = count(array_filter($errors)) > 0;
        $display_form = $error;
      }

      // The form is displayed only if it hasn't been submitted
      // or there is some error in some field
      if ($display_form) {
      ?>
        <h1>Registrazione</h1>

        <?php
        if ($error) echo "<p>Si è verificato un errore! Ricontrolla i dati immessi.</p>";
        ?>

        <form method="post">
          <h5>Dati anagrafici</h5>
          <div class="input-group">
            <div class="group<?php if ($errors['lastName']) echo ' error' ?>">
              <input required type="text" class="input<?php if (isset($_POST["lastName"]) && $_POST["lastName"]) echo " compiled" ?>" name="lastName" value="<?php if (isset($_POST["lastName"])) echo $_POST["lastName"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Cognome</label>
              <span class="error-msg"><?php echo $errors["lastName"] ?></span>
            </div>
            <div class="group<?php if ($errors['firstName']) echo ' error' ?>">
              <input required type="text" class="input<?php if (isset($_POST["firstName"]) && $_POST["firstName"]) echo " compiled" ?>" name="firstName" value="<?php if (isset($_POST["firstName"])) echo $_POST["firstName"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Nome</label>
              <span class="error-msg"><?php echo $errors["firstName"] ?></span>
            </div>
            <div class="group<?php if ($errors['fiscalCode']) echo ' error' ?>">
              <input required type="text" class="input<?php if (isset($_POST["fiscalCode"]) && $_POST["fiscalCode"]) echo " compiled" ?>" name="fiscalCode" value="<?php if (isset($_POST["fiscalCode"])) echo $_POST["fiscalCode"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Codice fiscale</label>
              <span class="error-msg"><?php echo $errors["fiscalCode"] ?></span>
            </div>
            <div class="group<?php if ($errors['birthDate']) echo ' error' ?>">
              <input required type="date" class="input<?php if (isset($_POST["birthDate"]) && $_POST["birthDate"]) echo " compiled" ?>" name="birthDate" value="<?php if (isset($_POST["birthDate"])) echo $_POST["birthDate"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Data di nascita</label>
              <span class="error-msg"><?php echo $errors["birthDate"] ?></span>
            </div>
            <div class="group<?php if ($errors['address']) echo ' error' ?>">
              <input type="text" class="input<?php if (isset($_POST["address"]) && $_POST["address"]) echo " compiled" ?>" name="address" value="<?php if (isset($_POST["address"])) echo $_POST["address"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Indirizzo</label>
              <span class="error-msg"><?php echo $errors["address"] ?></span>
            </div>
            <div class="group<?php if ($errors['phone']) echo ' error' ?>">
              <input type="tel" pattern="\d{10}" class="input<?php if (isset($_POST["phone"]) && $_POST["phone"]) echo " compiled" ?>" name="phone" value="<?php if (isset($_POST["phone"])) echo $_POST["phone"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Telefono</label>
              <span class="error-msg"><?php echo $errors["phone"] ?></span>
            </div>
          </div>
          <h5>Credenziali</h5>
          <div class="input-group">
            <div class="group<?php if ($errors['email']) echo ' error' ?>">
              <input type="email" class="input<?php if (isset($_POST["email"]) && $_POST["email"]) echo " compiled" ?>" name="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Email</label>
              <span class="error-msg"><?php echo $errors["email"] ?></span>
            </div>
            <div class="group<?php if ($errors['username']) echo ' error' ?>">
              <input required type="text" class="input<?php if (isset($_POST["username"]) && $_POST["username"]) echo " compiled" ?>" name="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Username</label>
              <span class="error-msg"><?php echo $errors["username"] ?></span>
            </div>
            <div class="group<?php if ($errors['password']) echo ' error' ?>">
              <input required type="password" class="input<?php if (isset($_POST["password"]) && $_POST["password"]) echo " compiled" ?>" name="password" value="<?php if (isset($_POST["password"])) echo $_POST["password"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Password</label>
              <span class="error-msg"><?php echo $errors["password"] ?></span>
            </div>
            <div class="group<?php if ($errors['confirmPassword']) echo ' error' ?>">
              <input required type="password" class="input<?php if (isset($_POST["confirmPassword"]) && $_POST["confirmPassword"]) echo " compiled" ?>" name="confirmPassword" value="<?php if (isset($_POST["confirmPassword"])) echo $_POST["confirmPassword"] ?>">
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Conferma password</label>
              <span class="error-msg"><?php echo $errors["confirmPassword"] ?></span>
            </div>
          </div>
          <button type="submit" name="submit">Registrati</button>
        </form>
        <?php
      } else {
        // Data from the form contains no errors
        // Proceed to register user
        try {
          UsersService::create($username, password_hash($password, PASSWORD_BCRYPT), $fiscalCode, $firstName, $lastName, $birthDate, $email, $phone, $address);
        ?>
          <h1>Successo!</h1>

          <p>Complimenti, sei riuscito a registrarti con successo. Procedi pure con l'accesso all'area riservata.</p>

          <a href="login.php"><button style="margin-top: 2.5rem;">Accedi</button></a>
        <?php
        } catch (mysqli_sql_exception $e) {
        ?>
          <h1>Errore!</h1>

          <p>Ops! Qualcosa è andato storto durante la registrazione</p>

          <a href="register.php"><button style="margin-top: 2.5rem;">Registrati</button></a>
      <?php
          echo $e;
        }
      }
      ?>       
    </div>
  </div>
</body>

</html>