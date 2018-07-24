<?php
  $DB['server'] = '163.44.196.236';
  $DB['user'] = 'fsctonli_it3';
  $DB['pass'] = 'fsctit';
  $DB['dbname'] = 'fsctonli_web';

  $conn = mysqli_connect($DB['server'], $DB['user'], $DB['pass'], $DB['dbname']);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      return '99';
  }else{
    mysqli_query($conn, 'SET NAMES UTF8');
  }
?>
