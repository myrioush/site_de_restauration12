<?php

    require"../database.php";
    session_start();
    extract($_POST);
     function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

        
       try {
      extract($_POST);
      $db = Database::connect();
     
      if (empty($_POST)) {
        $message = "Veuillez remplir tous les champs svp !";
      } 
      else {
        
        $statement = $db->prepare('SELECT * FROM client WHERE nom_cl = ? AND mdp_cl = ?');
        $statement->execute(array($username, $password));
        
        
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
		<label>PSEUDO</label>
		<input type="text" name="username" required="">
		<label>mot de passe</label>
		<input type="password" name="password" required="">
		<input type="submit" name="submit">

		
	</form>


<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>

