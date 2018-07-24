<?php
  require_once 'config.php';

  $qa = $_POST['QUESTION'];
  $as = "<pre>".$_POST['ANSWER']."</pre>";

  $sql = "INSERT INTO fsct_bot(question, answer)
          VALUES('$qa', '$as')";
  $result = mysqli_query($conn, $sql);
  if($result){
    //echo '<script type="text/javascript">alert("hello!");</script>';
    header('Location: index.php?status=1');
  }else{
    exit("insert sql error");
  }
  mysqli_close($conn);
?>
