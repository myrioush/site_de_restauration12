<?php

    require_once "../Models/database.php";
    require_once "../Models/Client.php";
    session_start();
    extract($_POST);
     function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }try {
       extract($_POST);
      if (empty($_POST)) {
        $message = "Veuillez remplir tous les champs svp !";
      }
      else {

        $_SESSION["client"] = New Client($username,$password);


          header('Location:menu.php ');

      }
    } catch (PDOException $e) {
      echo $e->getMessage(); die;
    }


    

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>resto</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	
</head>
<body>

	<form method="post" action="">
		<label for="username">PSEUDO</label>
		<input id="username" type="text" name="username" required="">
		<label for="password">mot de passe</label>
		<input id="password" type="password" name="password" required="">
		<input type="submit" name="submit">

		
	</form>


<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>

