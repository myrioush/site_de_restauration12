<?php
 require "../database.php";
     
    
    if (isset($_POST)) {        
        try {
            extract($_POST);
            

            if (empty($_POST)) {
                $message = "Veuillez remplir tous les champs svp !";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Donner une email correcte !";
            } elseif(!is_numeric($numero) && count($numero) < 9) {
                $message = "Donner un numero valide svp !";
            }

            else {

                $db = Database::connect();
                $statement = $db->prepare('INSERT INTO reservation(nom_reser,prenom_reser,nombre_p,email,numero,date_reser,heure_reser) VALUES (?,?,?,?,?,?,?)');
                $item = $statement->execute(array($nom_reser, $prenom_reser,$nombre_p, $email, $numero,$date_reser,$heure_reser));

                if (!$item) {
                    $message = "Utilisateur bien enregistre";
                } else {
                    $message = "Ressaie mon petit ! ";
                }
                
            }

            
        } catch (PDOException $e) {
            echo $e->getMessage(); die;
        }
    }
    Database::disconnect();


  
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>reservation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
   
</head>
<body>
    <form method="post" >
        <label>nom</label>
        <input type="text" name="nom_reser" id="nom_reser" required="">
        <label>prénom</label>
        <input type="text" name="prenom_reser" id="prenom_reser" required="">
        <label>nombre de personnes</label>
        <input type="text" name="nombre_p" id="nombre_p" required="">
        <label>email</label>
        <input type="email" name="email" id="email" required="">
        <label>numero</label>
        <input type="tel" name="numero" id="numero" required="">
        
        <label>date reservation</label>
        <input type="date" name="date_reser" required="">
        <label>heure reservation</label>
        <input type="time" name="heure_reser" required="">
        <?php
        $num_reser=random(1,50);
        ?>
        <input type="submit" value="connexion">
    </form>
 <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>