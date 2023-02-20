<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca</title>

  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/login.css" />

  <script src="js/global.js" defer></script>
</head>

<body>
  <?php
  session_start();

  if (isset($_SESSION["session_id"])) {
    header("Location: browse.php");
    exit;
  }

  require_once "backend/users_service.php";

  // Validate user
  $error = "";
  if (isset($_POST["submit"])) {
    // Get inputs
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Get user from database
    $user = UsersService::get_by_username($username);
    $user = reset($user);

    if (!$user || password_verify($password, $user['password']) === false) {
      // Invalid credentials
      $error = "Nome utente o password errati.";
    } else {
      // Init session and redirect to reserved area
      session_regenerate_id();
      $_SESSION['session_id'] = session_id();
      $_SESSION['session_user'] = $user['username'];

      header('Location: browse.php');
      exit;
    }
  }
  ?>

  <div class="background"></div>

  <div class="content">
    <a href="./index.php">
      <button class="home-button"></button>
    </a>

    <span class="logo"></span>

    <div class="main-content">
      <h1>Accedi</h1>
      <form method="post">
        <div class="group">
          <input required type="text" class="input" name="username">
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Username</label>
        </div>
        <div class="group">
          <input required type="password" class="input" name="password">
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Password</label>
        </div>
        <div class="error-msg" style="width: 100%"><?php echo $error ?></div>
        <button type="submit" name="submit">Accedi</button>
      </form>
    </div>
  </div>
</body>

</html>