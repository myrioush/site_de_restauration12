<?php
session_start();
  require"../database.php";

  extract($_POST);
  if (isset($_POST['submit'])) 
  {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO client (nom_cl,prenom_cl,num_cl,email_cl,mdp_cl) VALUES(?, ?, ?, ?, ?)");
            $statement->execute(array($nom_cl,$prenom_cl,$num_cl,$email_cl,$mdp_cl));
            $item = $statement->fetch();
            Database::disconnect();
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
<form method="POST" action="">
		 <div class="row">
               <div class="col-sm-6">
                    <h1><strong>client</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom:</label>
                        <input type="text" name="nom_cl" id="nom_cl" required="">
                      </div>
                      <div class="form-group">
                        <label>prénom:</label>
                        <input type="text" name="prenom_cl" id="prenom_cl">
                      </div>
                      <div class="form-group">
                        <label>email</label>
                        <input type="email" name="email_cl" id="email_cl">
                      </div>
                       <div class="form-group">
                        <label>mot de passe</label>
                        <input type="password" name="mdp_cl" id="mdp_cl">
                      </div>
                      <div class="form-group">
                        <label>numéro de télephone</label>
                        <input type="tel" name="num_cl" id="num_cl">
                      </div>
                      <button type="submit" name="submit">soumettre</button>
        </div>
 </form>
 <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>