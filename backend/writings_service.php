<?php
require_once("db.php");

// TODO

class DataService
{
  static function get_by_id($id)
  {
    global $db;
    $result = $db->query("SELECT * FROM dati_titoli WHERE id=$id");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_title($id_titolo)
  {
    global $db;
    $result = $db->query("SELECT * FROM dati_titoli WHERE id_titolo=$id_titolo");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function get_by_title_by_date($title_id, $begin, $end)
  {
    global $db;
    $result = $db->query(
      "SELECT D.*
      FROM titoli, dati_titoli AS D
      WHERE titoli.id_titolo=D.id_titolo AND D.id_titolo=$title_id AND D.date BETWEEN \"$begin\" AND \"$end\""
    );
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function create($date, $open, $high, $low, $close, $adj_close, $volume, $title_id)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("INSERT INTO dati_titoli VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sdddddii", $date, $open, $high, $low, $close, $adj_close, $volume, $title_id);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
    
    return $db->insert_id;
  }

  static function update($id, $date, $open, $high, $low, $close, $adj_close, $volume, $title_id)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("UPDATE dati_titoli SET date=?, open=?, high=?, low=?, close=?, adj_close=?, volume=?, id_titolo=? WHERE id=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sdddddiii", $date, $open, $high, $low, $close, $adj_close, $volume, $title_id, $id);

    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete($id)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("DELETE FROM dati_titoli WHERE id=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("i", $id);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete_by_title($title_id)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("DELETE FROM dati_titoli WHERE id_titolo=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("i", $title_id);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }
}
