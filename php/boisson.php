<?php
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
          echo '<nav><ul class="nav nav-tabs">';

          $db =Database::connect();
          $statement = $db->query("SELECT * FROM categories WHERE id=4");
          $categories=$statement->fetchAll();
              foreach ($categories as $category)
              {
                if ($category['id']=='1')
                {
                  echo '<li class="active"><a class="nav-link" href="#'.$category['id'].'"data-toogle="tab">'.$category['name'].'</a></li>';
                }
                else
                {
                  echo '<li class="nav-item"><a class="nav-link" href="#'.$category['id'].'"data-toogle="tab">'.$category['name'].'</a></li>';
                }
              }
             echo "</ul></nav>";
             
             
             foreach ($categories as $category)
             {
                   if ($category['id']=='1')
                   {
                       echo '<div class="active" id="'.$category['id'].'">';
                   }
                   else
                   {
                       echo '<div class="" id="'.$category['id'].'">';
                   }
                 
                   $statement = $db->prepare('SELECT*FROM items WHERE items.category');
                   $statement->execute(array($category['id']));
                    while($item = $statement->fetch())
                    {
                       echo '  <div class="card" style="width: 18rem;">
                                  <img style="width:18rem;" src="../image/'.$item['image'].'">
                                  <div class="card" style="width: 18rem;">
                                   <h4>'.$item['name'].'</h4>
                                    <p>'.$item['description'].'</p>
                                    <div>'.number_format((float)$item['price'], 2, '.', ''). ' cfa'.'</div>
                                     <a href="#" class="btn btn-primary">Go somewhere</a>
                                  </div>
                                  </div>';
                              

                    }
                    echo '</div>
                          </div>';
             }
              Database::disconnect();
 
      ?>
</body>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script> <!--fichier jquery-->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</html>