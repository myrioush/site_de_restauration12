<?php
  include"menu.php";
  require '../database.php';

   function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>resto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1"> <!--bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet"><!--pour le fichier css de bootstrap-->
	<link rel="stylesheet" type="text/css" href="../css/style.css"> <!--le fichier css-->
</head>
<body>
      
      <?php

          	
		     <div class="row" style="padding-top:25px;">
		                <div class="col-md-4">
		                    <div class="card">
		                        <div class="card-body">
		                            <h4 style="text-align:center;">Mangue</h4>
		                            <img src="img/mangue.jpg" width="100%" height="200px">
		                            <p class="card-text"></p>
		                        </div>
		                    </div>
		                </div>
		                           
		     </div>
	?>
</body>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script> <!--fichier jquery-->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</html>