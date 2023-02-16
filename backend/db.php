<?php

if (!isset($db)) {
  function connect()
  {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "biblioteca";

    // Connect
    $db = new mysqli($servername, $username, $password);

    // Check if database exists
    try {
      $db->select_db($dbname);
    } catch (mysqli_sql_exception $e) {
      // Preliminar controls on files
      $DB_STRUCTURE = __DIR__ . "\\db_structure.sql";
      $DB_DATA = __DIR__ . "\\db_data.sql";
      if (!file_exists($DB_STRUCTURE) || !file_exists($DB_DATA))
        die("Corrupted software, dowload files again");

      // Database doesn't exist: create it
      $sql = "CREATE DATABASE $dbname";
      if (!$db->query($sql)) die("Connection error");
      $db->select_db($dbname);

      // Create tables
      $db_sql = file_get_contents($DB_STRUCTURE);
      $db_instructions = array_map(function ($s) {
        return trim($s);
      }, explode(";", $db_sql));

      foreach ($db_instructions as $sql) {
        if ($sql) if (!$db->query($sql)) die("Invalid SQL instruction syntax");
      }

      // Fill tables
      $db_sql = file_get_contents($DB_DATA);
      $db_instructions = array_map(function ($s) {
        return trim($s);
      }, explode(";", $db_sql));

      foreach ($db_instructions as $sql) {
        if ($sql) if (!$db->query($sql)) die("Invalid SQL instruction syntax");
      }
    }

    return $db;
  }

  // Connection to the main db
  $db = connect();
}
