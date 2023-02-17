<?php
require_once("db.php");

// TODO

class AuthorsService
{
  static function get_all()
  {
    global $db;
    $result = $db->query("SELECT * FROM autori");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_id($id)
  {
    global $db;
    $result = $db->query("SELECT * FROM autori WHERE idAutore=$id");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function create($first_name, $last_name, $nationality, $birthYear)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("INSERT INTO autori VALUES (0, ?, ?, ?, ?)");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sssi", $first_name, $last_name, $nationality, $birthYear);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
    
    return $db->insert_id;
  }

  static function update($id, $first_name, $last_name, $nationality, $birthYear)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("UPDATE autori SET nome=?, cognome=?, nazionalita=?, annoN=? WHERE idAutore=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sssii", $first_name, $last_name, $nationality, $birthYear, $id);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete($id)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("DELETE FROM autori WHERE idAutore=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("i", $id);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }
}
