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
  <a href="./index.html">
    <button class="home-button"></button>
  </a>

  <div class="content">
    <span class="logo"></span>
    <div class="main-content">
      <h1>Registrazione</h1>

      <form method="post">
        <div class="input-group">
          <div class="group">
            <input required type="text" class="input" name="lastName">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Cognome</label>
          </div>
          <div class="group">
            <input required type="text" class="input" name="firstName">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Nome</label>
          </div>
          <div class="group">
            <input required type="text" class="input" name="fiscalCode">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Codice fiscale</label>
          </div>
          <div class="group">
            <input required type="date" class="input" name="birthDate">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Data di nascita</label>
          </div>
          <div class="group">
            <input type="text" class="input" name="address">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Indirizzo</label>
          </div>
          <div class="group">
            <input type="tel" pattern="\d{10}" class="input" name="phone">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Telefono</label>
          </div>
        </div>
        <div class="input-group">
          <div class="group">
            <input type="email" class="input" name="email">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Email</label>
          </div>
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
          <div class="group">
            <input required type="password" class="input" name="confirmPassword">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Conferma password</label>
          </div>
        </div>
        <button type="submit">Registrati</button>
      </form>
    </div>
  </div>
</body>

</html>