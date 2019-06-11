
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
          require "../database.php";
          echo '<nav><ul class="nav nav-tabs">;'

          $db = Database::connect();
          $statement = $db->query("SELECT * FROM categories");
          $categories=$statement->fetchAll();
          foreach ($categories as $category)
         {
            if ($category['id']=='1')
            {
              echo '<li class="active"><a class="nav-link" href="entre.php'.$category['id'].'"data-toogle="tab"'.$category['name']'</a></li>;'
            }
            else
            {
              echo '<li class="nav-item"><a class="nav-link "href="entre.php".$category['id'].'data-toogle="tab"'.$category['name']>Entrée</a></li>";' 
            }
        }
        echo "</ul></nav>";
 
      ?>
      
  
  <li class="nav-item">
    <a class="nav-link" href="plat.php?id=2">Plat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="dessert.php?id=3">Déssert</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="boisson.php?id=4">Boissons</a>
  </li>
</ul>	

</body>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script> <!--fichier jquery-->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</html>