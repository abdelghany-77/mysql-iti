<?php
session_start();

function checkLogin()
{
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
  }
}

function getConnection()
{
  if (!isset($_SESSION['db_user']) || !isset($_SESSION['db_pass'])) {
    header("Location: index.php");
    exit();
  }

  $conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass']);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}

function getConnectionWithDB($database)
{
  if (!isset($_SESSION['db_user']) || !isset($_SESSION['db_pass'])) {
    header("Location: index.php");
    exit();
  }

  $conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}

function checkspil($data)
{
  return htmlspecialchars(strip_tags(trim($data)));
}