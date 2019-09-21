<?php
include_once('dbcon.php');

if (isset($_SESSION['id'])) {
  session_destroy();
  unset($_SESSION['id']);
  unset($_SESSION['full_name']);
  unset($_SESSION['email']);
  header("location: login.php");
  eixt();
}