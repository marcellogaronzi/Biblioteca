<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca</title>

  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/browse.css" />

  <script src="js/global.js" defer></script>
</head>

<body>
  <?php
  session_start();

  // If user not authenticated redirect
  if (!isset($_SESSION["session_id"])) {
    header("Location: login.php");
    exit;
  }
  ?>
  <div class="background"></div>

  <div class="content">
    <a href="./index.php">
      <button class="home-button"></button>
    </a>

    <span class="logo"></span>

    <div class="main-content">
      <h1>Naviga</h1>

      <form method="post" class="search">
        <select name="mode" id="modeSelector">
          <option value="title" <?php if (isset($_POST["mode"]) && $_POST["mode"] === "title") echo "selected" ?>>Cerca per titolo</option>
          <option value="author" <?php if (isset($_POST["mode"]) && $_POST["mode"] === "author") echo "selected" ?>>Cerca per autore</option>
          <option value="isbn" <?php if (isset($_POST["mode"]) && $_POST["mode"] === "isbn") echo "selected" ?>>Cerca per isbn</option>
        </select>
        <input type="search" placeholder="Cerca" name="search" autocomplete="none" value="<?php if (isset($_POST["search"])) echo $_POST["search"] ?>">
        <button type="submit" name="submit">
          <i class="search-icon"></i>
        </button>
      </form>

      <div class="table">
        <table>
          <tr>
            <th>Titolo</th>
            <th>Autore</th>
            <th>ISBN</th>
            <th>Editore</th>
          </tr>

          <?php
          require_once("backend/books_service.php");

          $mode = "all";
          if (isset($_POST["submit"])) {  // If user searched something
            $mode = $_POST["mode"];
            $search = trim($_POST["search"]);
          }

          // Get books based on selected search mode
          switch ($mode) {
            case 'title':
              $books = BooksService::get_by_title($search);
              break;
            case 'author':
              $books = BooksService::get_by_author($search);
              break;
            case 'isbn':
              $books = BooksService::get_by_isbn($search);
              break;
            default:
              $books = BooksService::get_all();
              break;
          }

          // Display data inside table
          foreach ($books as $book) {
            echo "<tr>" .
              "<td>" . $book["titolo"] . "</td>" .
              "<td>" . $book["autore"] . "</td>" .
              "<td>" . $book["isbn"] . "</td>" .
              "<td>" . $book["casaEd"] . "</td>" .
              "</tr>";
          }
          ?>
        </table>
      </div>

    </div>
  </div>
</body>

</html>