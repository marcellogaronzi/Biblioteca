<?php
require "db.php";

// TODO

class TitleService
{
  static function get_all()
  {
    global $db;
    $sql = "SELECT * FROM titoli";
    $result = $db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_id($id)
  {
    global $db;
    $result = $db->query("SELECT * FROM titoli WHERE id_titolo=$id");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function create($ticker, $name, $description, $start, $end)
  {
    global $db;
    // Check if prepare succeeded
    $stmt = $db->prepare("INSERT INTO titoli VALUES (0, ?, ?, ?, ?, ?)");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sssss", $ticker, $name, $description, $start, $end);
    
    // Check if execution succeeded
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);

    return $db->insert_id;
  }

  static function update($id, $ticker, $name, $description = NULL, $start, $end)
  {
    global $db;
    // Check if prepare succeeded
    $stmt = $db->prepare("UPDATE titoli SET ticker=?, nome=?, descrizione=?, inizio=?, fine=? WHERE id_titolo=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);
    
    // Bind
    $stmt->bind_param("sssssi", $ticker, $name, $description, $start, $end, $id);
    
    // Check if execution succeeded
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete($id)
  {
    global $db;
    // Check if prepare succeeded
    $stmt = $db->prepare("DELETE FROM titoli WHERE id_titolo=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("i", $id);
    
    // Check if execution succeeded
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }
}
