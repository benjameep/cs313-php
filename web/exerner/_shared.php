<?php

  function safe_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  function safe_get($key, $default = '') {
      return safe_input(isset($_GET[$key]) ? $_GET[$key] : $default);
  }

  function safe_post($key, $default = '') {
      return safe_input(isset($_POST[$key]) ? $_POST[$key] : $default);
  }

  $current_page = htmlspecialchars($_SERVER["PHP_SELF"]);

  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
    $dbUrl = "postgres://fhtpdujbrnegmq:5b7d0196b882f4f833208b469f66affff3314a511fb3a84c74f4d3f2f588bd29@ec2-54-83-204-230.compute-1.amazonaws.com:5432/d5ugpkepuq2kse";
  }
  $dbopts = parse_url($dbUrl);
  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');

  try {
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex) {
    print "<p>error: {$ex->getMessage()} </p>\n\n";
    die();
  }
?>
