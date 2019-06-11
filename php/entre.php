<?php
   include"menu.php";
   require"../database.php";

   if (isset($_GET['id']) && !empty($_GET['id'])) 
    {
    	$db = Database::connect();
    	$id=(int) $_GET['id'];
    	$statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id =1");
        $statement->execute(array($id));
        
       
     }
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

	<table class="row" style="margin-left:50px;">
		<thead class="card"style="width: 18rem;">
                      <?php
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'.'<img style="width:18rem;" src=../image/'.$item['image'].'></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>'.$item['name'].'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>'.$item['description'].'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>'.number_format((float)$item['price'], 2, '.', ''). ' cfa'.'</th>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>'.'<button class="btn btn-primary">gosososo</button>'.'</td>';
                            echo '</tr>';
                           
                        } 
                        Database::disconnect();
                      ?>
        </thead>


	</table>
	

  
 
</body>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script> <!--fichier jquery-->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</html>