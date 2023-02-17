<?php
require_once("db.php");

class UsersService
{
  static function get_by_username($username)
  {
    global $db;
    $result = $db->query("SELECT * FROM utenti WHERE username=$username");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  static function create($username, $password, $cf, $first_name, $last_name, $birth_date, $email=NULL, $phone=NULL, $address=NULL)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("INSERT INTO utenti VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("sssssssss", $username, $password, $cf, $first_name, $last_name, $birth_date, $email, $phone, $address);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);

    return $username;
  }

  static function update($username, $password, $cf, $first_name, $last_name, $birth_date, $email=NULL, $phone=NULL, $address=NULL)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("UPDATE utenti SET password=?, cf=?, nome=?, cognome=?, dataN=?, email=?, cell=?, indirizzo=? WHERE username=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);
    
    // Bind
    $stmt->bind_param("sssssssss", $password, $cf, $first_name, $last_name, $birth_date, $email, $phone, $address, $username);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }

  static function delete($username)
  {
    global $db;
    // Prepare
    $stmt = $db->prepare("DELETE FROM utenti WHERE username=?");
    if ($stmt === false) trigger_error($db->error, E_USER_ERROR);

    // Bind
    $stmt->bind_param("s", $username);
    
    // Execute
    $status = $stmt->execute();
    if ($status === false) trigger_error($stmt->error, E_USER_ERROR);
  }
}
