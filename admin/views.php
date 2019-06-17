<?php
    require '../database.php';

    if(!empty($_GET['id'])) 
    {
        $id= checkInput($_GET['id']);
    }
     
    $db = Database::connect();
    $statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
<head>
   <title>resto</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../js/jquery.min.js"></script>
        <link rel="../css/bootstrap.min.css">
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
   <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> resto <span class="glyphicon glyphicon-cutlery"></span></h1>
         <div class="container admin">
            <div class="row">
               <div class="col-sm-6">
                    <h1><strong>Voir un element</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$item['name'];?>
                      </div>
                      <div class="form-group">
                        <label>Description:</label><?php echo '  '.$item['description'];?>
                      </div>
                      <div class="form-group">
                        <label>Prix:</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' cfa';?>
                      </div>
                      <div class="form-group">
                        <label>Catégorie:</label><?php echo '  '.$item['category'];?>
                      </div>
                      <div class="form-group">
                        <label>Image:</label><?php echo '<img style="width:18rem;" src="../image/'.$item['image'].'"> ';?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="affichage.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
               
            </div>
        </div>   
    </body>
</html>

