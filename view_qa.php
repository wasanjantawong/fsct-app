<?php
  require_once 'config.php';

  $sql = "SELECT * FROM fsct_bot";

  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add Bot</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
  </head>
  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">สอนบอทไลน์</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">สอนบอทไลน์ FSCT</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class=""><a href="index.php">เพิ่มคำถาม</a></li>
              <li><a href="view_qa.php">คำถามที่มีอยู่</a></li>
    <!--            <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
        <!--      <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>-->
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron container text-center">
        <h2>คำถาม - คำตอบที่มีอยู่</h2>
        <table class="table table-striped" id="TABLE_VIEW">
          <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">คำถาม</th>
              <th class="text-center">คำตอบ</th>
            </tr>
          </thead>
          <tbody>
<?php while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
            <tr>
              <td><?= $data['id'] ?></td>
              <td><?= $data['question'] ?></td>
              <td><?= $data['answer'] ?></td>
            </tr>
<?php endwhile; ?>
          </tbody>
        </table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#TABLE_VIEW').DataTable();
          } );
        </script>
      </div>

    </div> <!-- /container -->



  </body>
</html>
