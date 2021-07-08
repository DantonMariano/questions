<?php

//Original
class MyUserClass
{
  public function getUserList()
  {
    $dbconn = new DatabaseConnection('localhost', 'user', 'password');
    $results = $dbconn->query('select name from user');
    sort($results);
    return $results;
  }
}

//Refactor
class MyUserClass
{
  public function getUsers()
  {
    $query = "
      SELECT nome
      FROM user
      ORDER BY ASC
    ";

    $db = new DatabaseConnection('localhost', 'user', 'password');
    $rs = $db->query($query);
    
    return $rs;
  }
}