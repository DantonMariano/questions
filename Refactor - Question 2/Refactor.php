<?php

//Original
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  header("Location: http://www.google.com");
  exit();
} elseif (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true) {
  header("Location: http://www.google.com");
  exit();
}

//Refactor
if (isset($_SESSION['loggedin']) || isset($_COOKIE['Loggedin'])){
  if ($_SESSION['loggedin'] == true || $_COOKIE['Loggedin'] == true) {
    header("Location: http://www.google.com");
    exit();
  } 
}