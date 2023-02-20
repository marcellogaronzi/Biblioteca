<?php
require_once("db.php");

class BooksService
{
  static function get_all()
  {
    global $db;
    $result = $db->query(
      "SELECT L.*, CONCAT(A.nome, ' ', A.cognome) autore
      FROM libri L, scritture S, autori A
      WHERE L.isbn=S.isbn AND S.idAutore=A.idAutore");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_isbn($isbn)
  {
    global $db;
    $result = $db->query(
      "SELECT L.*, CONCAT(A.nome, ' ', A.cognome) autore
      FROM libri L, scritture S, autori A
      WHERE L.isbn=S.isbn AND S.idAutore=A.idAutore AND L.isbn LIKE '%$isbn%'");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_title($titolo)
  {
    global $db;
    $result = $db->query(
      "SELECT L.*, CONCAT(A.nome, ' ', A.cognome) autore
      FROM libri L, scritture S, autori A
      WHERE L.isbn=S.isbn AND S.idAutore=A.idAutore AND L.titolo LIKE '%$titolo%'");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_author($author)
  {
    global $db;
    $result = $db->query(
      "SELECT L.*, CONCAT(A.nome, ' ', A.cognome) autore
      FROM libri L, scritture S, autori A
      WHERE L.isbn=S.isbn AND S.idAutore=A.idAutore AND CONCAT(A.nome, ' ', A.cognome) LIKE '%$author%'"
    );
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function create($isbn, $title, $n_pages, $price, $publishing_house)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("INSERT INTO libri VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("ssids", $isbn, $title, $n_pages, $price, $publishing_house);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);

    return $isbn;
  }

  static function update($isbn, $title, $n_pages, $price, $publishing_house)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare(
      "UPDATE libri 
      SET titolo=?, nPag=?, prezzo=?, casaEd=? 
      WHERE isbn=?"
    );
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sidss", $title, $n_pages, $price, $publishing_house, $isbn);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete($isbn)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("DELETE FROM libri WHERE isbn=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("s", $isbn);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }
}
