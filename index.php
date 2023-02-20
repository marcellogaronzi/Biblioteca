<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca</title>

  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>
  <?php
  // Init database
  require "backend/db.php";
  ?>

  <div class="background"></div>

  <div class="content">
    <span class="logo"></span>
    <div class="main-content">
      <h1>Biblioteca</h1>
      <p>
        Ciao, e benvenuto in questa biblioteca online. Procedi al login se sei
        in possesso di un account. Altrimenti registrati.
      </p>
      <div class="buttons-container">
        <a href="login.php"><button>Accedi</button></a>
        <a href="register.php"><button>Registrati</button></a>
      </div>
    </div>
  </div>
</body>

</html>